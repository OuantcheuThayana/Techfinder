@extends('template')
@section('main')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4">Gestion des Compétences</h2>
            
            <!-- Formulaire d'ajout/modification -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ajouter une nouvelle compétence</h5>
                </div>
                <div class="card-body">
                    <form id="competenceForm">
                        <div class="mb-3">
                            <label for="nomCompetence" class="form-label">Nom de la compétence :</label>
                            <input type="text" class="form-control" id="nomCompetence" name="nomCompetence" placeholder="Ex: Développement Web" required>
                        </div>

                        <div class="mb-3">
                            <label for="descriptionCompetence" class="form-label">Description :</label>
                            <textarea class="form-control" id="descriptionCompetence" name="descriptionCompetence" placeholder="Décrivez votre compétence ici..." rows="3"></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" id="btnAjouter" class="btn btn-success">Ajouter</button>
                            <button type="button" id="btnAnnuler" class="btn btn-secondary" style="display:none;">Annuler</button>
                        </div>
                        <input type="hidden" id="competenceId" value="">
                    </form>
                </div>
            </div>

            <!-- Liste des compétences -->
            <h3 class="mt-5 mb-3">Liste des compétences existantes</h3>
            <div id="competencesList">
                <div class="text-center text-muted py-4">Chargement des compétences...</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour confirmer la suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cette compétence ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<style>
    .competence-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .competence-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        background: #fff;
    }

    .competence-item h6 {
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .competence-item p {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .competence-actions {
        display: flex;
        gap: 0.5rem;
    }

    .badge-code {
        background: #e7f3ff;
        color: #0d6efd;
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    let competenceToDelete = null;

    // Charger les compétences au démarrage
    loadCompetences();

    // Soumettre le formulaire
    document.getElementById('competenceForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveCompetence();
    });

    // Bouton Annuler
    document.getElementById('btnAnnuler').addEventListener('click', function() {
        resetForm();
    });

    function loadCompetences() {
        fetch('/api/competences')
            .then(response => response.json())
            .then(competences => {
                displayCompetences(competences);
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('competencesList').innerHTML = 
                    '<div class="alert alert-danger">Erreur lors du chargement des compétences</div>';
            });
    }

    function displayCompetences(competences) {
        const container = document.getElementById('competencesList');
        
        if (competences.length === 0) {
            container.innerHTML = '<div class="alert alert-info">Aucune compétence enregistrée pour le moment.</div>';
            return;
        }

        container.innerHTML = competences.map(comp => `
            <div class="competence-item">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="mb-0">${comp.label_comp}</h6>
                    <span class="badge-code">Code: ${comp.code_comp}</span>
                </div>
                <p class="mb-2">${comp.description_comp || 'Pas de description'}</p>
                <div class="competence-actions">
                    <button class="btn btn-sm btn-warning" onclick="editCompetence(${comp.code_comp}, '${comp.label_comp.replace(/'/g, "\\'")}', '${(comp.description_comp || '').replace(/'/g, "\\'")}')" title="Modifier">
                        <i class="bi bi-pencil"></i> Modifier
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteCompetence(${comp.code_comp})" title="Vider">
                        <i class="bi bi-trash"></i> Vider
                    </button>
                </div>
            </div>
        `).join('');
    }

    function saveCompetence() {
        const id = document.getElementById('competenceId').value;
        const label = document.getElementById('nomCompetence').value.trim();
        const description = document.getElementById('descriptionCompetence').value.trim();

        if (!label) {
            alert('Veuillez entrer un nom de compétence');
            return;
        }

        const data = {
            label_comp: label,
            description_comp: description
        };

        const url = id ? `/api/competences/${id}` : '/api/competences';
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.code_comp) {
                alert(id ? 'Compétence modifiée avec succès' : 'Compétence ajoutée avec succès');
                resetForm();
                loadCompetences();
            } else {
                alert('Erreur lors de l\'enregistrement');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    }

    function editCompetence(id, label, description) {
        document.getElementById('competenceId').value = id;
        document.getElementById('nomCompetence').value = label;
        document.getElementById('descriptionCompetence').value = description;
        document.getElementById('btnAjouter').textContent = 'Modifier';
        document.getElementById('btnAnnuler').style.display = 'inline-block';
        document.getElementById('nomCompetence').focus();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function deleteCompetence(id) {
        competenceToDelete = id;
        deleteModal.show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!competenceToDelete) return;

        fetch(`/api/competences/${competenceToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
        .then(response => {
            if (response.status === 204 || response.ok) {
                alert('Compétence supprimée avec succès');
                deleteModal.hide();
                loadCompetences();
            } else {
                alert('Erreur lors de la suppression');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    });

    function resetForm() {
        document.getElementById('competenceForm').reset();
        document.getElementById('competenceId').value = '';
        document.getElementById('btnAjouter').textContent = 'Ajouter';
        document.getElementById('btnAnnuler').style.display = 'none';
    }

    // Exposer les fonctions au scope global
    window.editCompetence = editCompetence;
    window.deleteCompetence = deleteCompetence;
});
</script>

@endsection
