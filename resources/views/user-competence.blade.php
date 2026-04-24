@extends('template')
@section('main')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Gestion de la Liaison Utilisateur-Compétence</h2>

            <!-- Onglets de navigation -->
            <ul class="nav nav-tabs mb-4" id="competenceTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="userCompTab" data-bs-toggle="tab" data-bs-target="#userComp" type="button" role="tab">
                        <i class="bi bi-person-check"></i> Compétences par Utilisateur
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="competenceUserTab" data-bs-toggle="tab" data-bs-target="#competenceUser" type="button" role="tab">
                        <i class="bi bi-award"></i> Utilisateurs par Compétence
                    </button>
                </li>
            </ul>

            <!-- Contenu des onglets -->
            <div class="tab-content" id="competenceTabContent">
                <!-- Onglet 1: Compétences par Utilisateur -->
                <div class="tab-pane fade show active" id="userComp" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="utilisateurSelect2" class="form-label">Sélectionner un utilisateur :</label>
                            <select class="form-select" id="utilisateurSelect2">
                                <option value="">-- Choisir un utilisateur --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="competenceSelect2" class="form-label">Ajouter une compétence :</label>
                            <select class="form-select" id="competenceSelect2">
                                <option value="">-- Choisir une compétence --</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="btnAddComp" class="btn btn-success mb-4">
                        <i class="bi bi-plus-circle"></i> Ajouter la Compétence
                    </button>

                    <div id="userCompetencesDiv">
                        <div class="alert alert-info">Sélectionnez un utilisateur pour voir ses compétences</div>
                    </div>
                </div>

                <!-- Onglet 2: Utilisateurs par Compétence -->
                <div class="tab-pane fade" id="competenceUser" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="competenceSelect3" class="form-label">Sélectionner une compétence :</label>
                            <select class="form-select" id="competenceSelect3">
                                <option value="">-- Choisir une compétence --</option>
                            </select>
                        </div>
                    </div>

                    <div id="competenceUsersDiv">
                        <div class="alert alert-info">Sélectionnez une compétence pour voir les utilisateurs qui la possèdent</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .competence-card {
        background: #f8f9fa;
        border-left: 4px solid #0d6efd;
        padding: 1rem;
        margin-bottom: 0.75rem;
        border-radius: 0.375rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .competence-card:hover {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .competence-card h6 {
        color: #0d6efd;
        font-weight: 600;
        margin: 0;
    }

    .user-card {
        background: #f8f9fa;
        border-left: 4px solid #28a745;
        padding: 1rem;
        margin-bottom: 0.75rem;
        border-radius: 0.375rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .user-card:hover {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .user-card h6 {
        color: #28a745;
        font-weight: 600;
        margin: 0;
    }

    .badge-info {
        background: #e7f3ff;
        color: #0d6efd;
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
    }

    .btn-group-small {
        display: flex;
        gap: 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let allCompetences = [];
        let allUtilisateurs = [];

        // Charger les données au démarrage
        loadCompetences();
        loadUtilisateurs();

        // Événements pour l'onglet 1
        document.getElementById('utilisateurSelect2').addEventListener('change', function() {
            if (this.value) {
                loadUserCompetences(this.value);
            } else {
                document.getElementById('userCompetencesDiv').innerHTML =
                    '<div class="alert alert-info">Sélectionnez un utilisateur pour voir ses compétences</div>';
            }
        });

        document.getElementById('btnAddComp').addEventListener('click', function() {
            const codeUser = document.getElementById('utilisateurSelect2').value;
            const codeComp = document.getElementById('competenceSelect2').value;

            if (!codeUser || !codeComp) {
                alert('Veuillez sélectionner un utilisateur et une compétence');
                return;
            }

            assignCompetence(codeUser, codeComp, () => {
                loadUserCompetences(codeUser);
                document.getElementById('competenceSelect2').value = '';
            });
        });

        // Événements pour l'onglet 2
        document.getElementById('competenceSelect3').addEventListener('change', function() {
            if (this.value) {
                loadCompetenceUsers(this.value);
            } else {
                document.getElementById('competenceUsersDiv').innerHTML =
                    '<div class="alert alert-info">Sélectionnez une compétence pour voir les utilisateurs</div>';
            }
        });

        function loadCompetences() {
            fetch('/api/competences')
                .then(response => response.json())
                .then(competences => {
                    allCompetences = competences;
                    populateCompetenceSelects();
                })
                .catch(error => console.error('Erreur:', error));
        }

        function loadUtilisateurs() {
            fetch('/api/utilisateurs')
                .then(response => response.json())
                .then(utilisateurs => {
                    allUtilisateurs = utilisateurs;
                    populateUserSelect();
                })
                .catch(error => console.error('Erreur:', error));
        }

        function populateCompetenceSelects() {
            const html = '<option value="">-- Choisir une compétence --</option>' +
                allCompetences.map(comp => 
                    `<option value="${comp.code_comp}">${comp.label_comp}</option>`
                ).join('');
            document.getElementById('competenceSelect2').innerHTML = html;
            document.getElementById('competenceSelect3').innerHTML = html;
        }

        function populateUserSelect() {
            const html = '<option value="">-- Choisir un utilisateur --</option>' +
                allUtilisateurs.map(user => 
                    `<option value="${user.code_user}">${user.nom_user} ${user.prenom_user || ''}</option>`
                ).join('');
            document.getElementById('utilisateurSelect2').innerHTML = html;
        }

        function loadUserCompetences(codeUser) {
            const user = allUtilisateurs.find(u => u.code_user === codeUser);
            document.getElementById('userCompetencesDiv').innerHTML = 
                '<div class="text-center text-muted py-4">Chargement...</div>';

            fetch(`/web/user-competence/competences/${codeUser}`)
                .then(response => response.json())
                .then(competences => {
                    displayUserCompetences(competences, user);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    document.getElementById('userCompetencesDiv').innerHTML =
                        '<div class="alert alert-warning">Erreur lors du chargement des compétences</div>';
                });
        }

        function displayUserCompetences(competences, user) {
            const container = document.getElementById('userCompetencesDiv');
            
            if (competences.length === 0) {
                container.innerHTML = `<div class="alert alert-info">
                    ${user.nom_user} ${user.prenom_user || ''} n'a aucune compétence assignée
                </div>`;
                return;
            }

            container.innerHTML = `<h5>Compétences de ${user.nom_user} ${user.prenom_user || ''}</h5>` +
                competences.map(comp => `
                    <div class="competence-card">
                        <div>
                            <h6>${comp.label_comp}</h6>
                            <small class="text-muted">${comp.description_comp || 'Pas de description'}</small>
                        </div>
                        <button class="btn btn-sm btn-danger" 
                            onclick="removeCompetenceGlobal('${user.code_user}', ${comp.code_comp})"
                            title="Retirer cette compétence">
                            <i class="bi bi-trash"></i> Retirer
                        </button>
                    </div>
                `).join('');
        }

        function loadCompetenceUsers(codeComp) {
            const competence = allCompetences.find(c => c.code_comp == codeComp);
            document.getElementById('competenceUsersDiv').innerHTML = 
                '<div class="text-center text-muted py-4">Chargement...</div>';

            fetch(`/web/user-competence/utilisateurs/${codeComp}`)
                .then(response => response.json())
                .then(utilisateurs => {
                    displayCompetenceUsers(utilisateurs, competence);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    document.getElementById('competenceUsersDiv').innerHTML =
                        '<div class="alert alert-warning">Erreur lors du chargement des utilisateurs</div>';
                });
        }

        function displayCompetenceUsers(utilisateurs, competence) {
            const container = document.getElementById('competenceUsersDiv');
            
            if (utilisateurs.length === 0) {
                container.innerHTML = `<div class="alert alert-info">
                    Aucun utilisateur n'a la compétence "${competence.label_comp}"
                </div>`;
                return;
            }

            container.innerHTML = `<h5>Utilisateurs avec la compétence: ${competence.label_comp}</h5>` +
                utilisateurs.map(user => `
                    <div class="user-card">
                        <div>
                            <h6>${user.nom_user} ${user.prenom_user || ''}</h6>
                            <small class="text-muted">${user.login_user || 'N/A'}</small>
                        </div>
                        <button class="btn btn-sm btn-danger" 
                            onclick="removeCompetenceGlobal('${user.code_user}', ${competence.code_comp})"
                            title="Retirer cette compétence">
                            <i class="bi bi-trash"></i> Retirer
                        </button>
                    </div>
                `).join('');
        }

        function assignCompetence(codeUser, codeComp, callback) {
            fetch('/web/user-competence/assign', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    code_user: codeUser,
                    code_comp: parseInt(codeComp)
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.message) {
                    alert('Compétence ajoutée avec succès');
                    if (callback) callback();
                } else if (result.error) {
                    alert('Erreur: ' + result.error);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
            });
        }

        function removeCompetenceGlobal(codeUser, codeComp) {
            if (!confirm('Êtes-vous sûr de vouloir retirer cette compétence?')) {
                return;
            }

            fetch('/web/user-competence/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    code_user: codeUser,
                    code_comp: codeComp
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.message) {
                    alert('Compétence retirée avec succès');
                    // Rafraîchir les vues
                    const selectedUser = document.getElementById('utilisateurSelect2').value;
                    const selectedComp = document.getElementById('competenceSelect3').value;
                    if (selectedUser) loadUserCompetences(selectedUser);
                    if (selectedComp) loadCompetenceUsers(selectedComp);
                } else if (result.error) {
                    alert('Erreur: ' + result.error);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue');
            });
        }

        // Exposer la fonction au scope global
        window.removeCompetenceGlobal = removeCompetenceGlobal;
    });
</script>

@endsection
