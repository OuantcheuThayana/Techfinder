@extends('template')
@section('main')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10">
            <h2 class="mb-4">Gestion des Utilisateurs</h2>

            <!-- Formulaire d'ajout/modification -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Ajouter un nouvel utilisateur</h5>
                </div>
                <div class="card-body">
                    <form id="utilisateurForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="codeUtilisateur" class="form-label">Code Utilisateur :</label>
                                <input type="text" class="form-control" id="codeUtilisateur" placeholder="Ex: USR001" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="loginUtilisateur" class="form-label">Login :</label>
                                <input type="text" class="form-control" id="loginUtilisateur" placeholder="Ex: jdupont" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nomUtilisateur" class="form-label">Nom :</label>
                                <input type="text" class="form-control" id="nomUtilisateur" placeholder="Ex: Dupont" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenomUtilisateur" class="form-label">Prénom :</label>
                                <input type="text" class="form-control" id="prenomUtilisateur" placeholder="Ex: Jean">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telUtilisateur" class="form-label">Téléphone :</label>
                                <input type="tel" class="form-control" id="telUtilisateur" placeholder="Ex: +33612345678" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sexeUtilisateur" class="form-label">Sexe :</label>
                                <select class="form-select" id="sexeUtilisateur" required>
                                    <option value="">-- Sélectionner --</option>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="roleUtilisateur" class="form-label">Rôle :</label>
                                <select class="form-select" id="roleUtilisateur">
                                    <option value="client">Client</option>
                                    <option value="technicien">Technicien</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etatUtilisateur" class="form-label">État :</label>
                                <select class="form-select" id="etatUtilisateur">
                                    <option value="actif">Actif</option>
                                    <option value="inactif">Inactif</option>
                                    <option value="suspendu">Suspendu</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="passwordUtilisateur" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="passwordUtilisateur" placeholder="Minimum 8 caractères">
                            <small class="text-muted">Laissez vide pour conserver le mot de passe actuel.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Ajouter</button>
                            <button type="button" id="btnAnnuler" class="btn btn-secondary" style="display:none;">Annuler</button>
                        </div>
                        <input type="hidden" id="utilisateurId">
                    </form>
                </div>
            </div>

            <!-- Liste des utilisateurs -->
            <h3 class="mt-5 mb-3">Utilisateurs enregistrés</h3>
            <div id="utilisateursList" class="row">
                <div class="col-12 text-center text-muted py-4">Chargement des utilisateurs...</div>
            </div>

            <!-- Gestion des compétences -->
            <h3 class="mt-5 mb-3">Gérer les Compétences des Utilisateurs</h3>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Assigner des compétences</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="utilisateurSelect" class="form-label">Utilisateur :</label>
                            <select class="form-select" id="utilisateurSelect">
                                <option value="">-- Sélectionner --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="competenceSelect" class="form-label">Compétence :</label>
                            <select class="form-select" id="competenceSelect">
                                <option value="">-- Sélectionner --</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="btnAjouterCompetence" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Ajouter
                    </button>
                </div>
            </div>

            <div id="userCompetencesSection" style="display:none; margin-top: 2rem;">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0" id="userCompetencesTitle"></h5>
                    </div>
                    <div class="card-body" id="userCompetencesList">
                        Aucune compétence
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">Êtes-vous sûr ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<style>
    .utilisateur-card {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: all 0.3s;
    }
    .utilisateur-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        background: #fff;
    }
    .utilisateur-card h6 {
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .utilisateur-card p {
        margin: 0.25rem 0;
        color: #666;
        font-size: 0.95rem;
    }
    .badge-role {
        display: inline-block;
        padding: 0.35rem 0.65rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-top: 0.5rem;
    }
    .badge-role.admin { background: #f8d7da; color: #721c24; }
    .badge-role.technicien { background: #fff3cd; color: #856404; }
    .badge-role.client { background: #d1ecf1; color: #0c5460; }
    .btn-group-sm { display: flex; gap: 0.5rem; margin-top: 0.75rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    let userToDelete = null;
    let allUsers = [];
    let allCompetences = [];

    // ===== INITIALISATION =====
    loadUsers();
    loadCompetences();

    // ===== CHARGEMENT DES DONNÉES =====
    function loadUsers() {
        console.log('Chargement des utilisateurs...');
        fetch('/api/utilisateurs')
            .then(r => {
                if (!r.ok) throw new Error(`HTTP ${r.status}`);
                return r.json();
            })
            .then(users => {
                console.log('Utilisateurs:', users);
                allUsers = users;
                displayUsers(users);
                updateUserSelects(users);
            })
            .catch(e => {
                console.error('Erreur:', e);
                document.getElementById('utilisateursList').innerHTML =
                    `<div class="col-12"><div class="alert alert-danger">Erreur: ${e.message}</div></div>`;
            });
    }

    function loadCompetences() {
        fetch('/api/competences')
            .then(r => r.json())
            .then(comps => {
                allCompetences = comps;
                updateCompetenceSelect();
            })
            .catch(e => console.error('Erreur compétences:', e));
    }

    // ===== AFFICHAGE =====
  function displayUsers(users) {
    const container = document.getElementById('utilisateursList');
    
    if (!users || users.length === 0) {
        container.innerHTML = '<div class="col-12"><div class="alert alert-info">Aucun utilisateur</div></div>';
        return;
    }

    container.innerHTML = `
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Login</th>
                            <th>Téléphone</th>
                            <th>Sexe</th>
                            <th>Rôle</th>
                            <th>État</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${users.map(u => `
                            <tr>
                                <td><code>${u.code_user}</code></td>
                                <td>${u.nom_user}</td>
                                <td>${u.prenom_user || '-'}</td>
                                <td>${u.login_user}</td>
                                <td>${u.tel_user}</td>
                                <td>${u.sexe_user === 'M' ? 'Masculin' : u.sexe_user === 'F' ? 'Féminin' : '-'}</td>
                                <td><span class="badge-role ${u.role_user || 'client'}">${u.role_user || 'N/A'}</span></td>
                                <td>
                                    <span class="badge ${u.etat_user === 'actif' ? 'bg-success' : u.etat_user === 'suspendu' ? 'bg-warning text-dark' : 'bg-secondary'}">
                                        ${u.etat_user || 'N/A'}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button class="btn btn-sm btn-warning" onclick="editUser('${u.code_user}', '${u.nom_user}', '${u.prenom_user||''}', '${u.login_user}', '${u.tel_user}', '${u.sexe_user}', '${u.role_user||''}', '${u.etat_user||''}')">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="deleteUser('${u.code_user}')">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        </div>
    `;
}

    function updateUserSelects(users) {
        const sel = document.getElementById('utilisateurSelect');
        sel.innerHTML = '<option value="">-- Sélectionner --</option>' +
            users.map(u => `<option value="${u.code_user}">${u.nom_user} ${u.prenom_user||''}</option>`).join('');
    }

    function updateCompetenceSelect() {
        const sel = document.getElementById('competenceSelect');
        sel.innerHTML = '<option value="">-- Sélectionner --</option>' +
            allCompetences.map(c => `<option value="${c.code_comp}">${c.label_comp}</option>`).join('');
    }

    // ===== FORMULAIRE =====
    document.getElementById('utilisateurForm').addEventListener('submit', e => {
        e.preventDefault();
        const id = document.getElementById('utilisateurId').value;
        const data = {
            code_user: document.getElementById('codeUtilisateur').value,
            nom_user: document.getElementById('nomUtilisateur').value,
            prenom_user: document.getElementById('prenomUtilisateur').value,
            login_user: document.getElementById('loginUtilisateur').value,
            tel_user: document.getElementById('telUtilisateur').value,
            sexe_user: document.getElementById('sexeUtilisateur').value,
            role_user: document.getElementById('roleUtilisateur').value || 'client',
            etat_user: document.getElementById('etatUtilisateur').value || 'actif'
        };
        
        const pwd = document.getElementById('passwordUtilisateur').value;
        if (pwd) data.password_user = pwd;

        const method = id ? 'PUT' : 'POST';
        const url = id ? `/api/utilisateurs/${id}` : '/api/utilisateurs';

        fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            },
            body: JSON.stringify(data)
        })
        .then(r => r.json())
        .then(res => {
            if (res.code_user) {
                resetForm();
                loadUsers();
            } else {
                alert('Erreur: ' + (res.error || 'Erreur inconnue'));
            }
        })
        .catch(e => alert('Erreur: ' + e.message));
    });

    document.getElementById('btnAnnuler').addEventListener('click', resetForm);

    // ===== ÉDITION/SUPPRESSION =====
    window.editUser = (code, nom, prenom, login, tel, sexe, role, etat) => {
        document.getElementById('utilisateurId').value = code;
        document.getElementById('codeUtilisateur').value = code;
        document.getElementById('codeUtilisateur').readOnly = true;
        document.getElementById('nomUtilisateur').value = nom;
        document.getElementById('prenomUtilisateur').value = prenom;
        document.getElementById('loginUtilisateur').value = login;
        document.getElementById('telUtilisateur').value = tel;
        document.getElementById('sexeUtilisateur').value = sexe;
        document.getElementById('roleUtilisateur').value = role;
        document.getElementById('etatUtilisateur').value = etat;
        document.getElementById('passwordUtilisateur').value = '';
        window.scrollTo({top:0, behavior:'smooth'});
    };

    window.deleteUser = (code) => {
        userToDelete = code;
        deleteModal.show();
    };

    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        if (!userToDelete) return;
        
        fetch(`/api/utilisateurs/${userToDelete}`, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content}
        })
        .then(r => {
            if (r.ok || r.status === 200 || r.status === 204) {
                deleteModal.hide();
                loadUsers();
            } else alert('Erreur suppression');
        })
        .catch(e => alert('Erreur: ' + e.message));
        
        userToDelete = null;
    });

    function resetForm() {
        document.getElementById('utilisateurForm').reset();
        document.getElementById('utilisateurId').value = '';
        document.getElementById('codeUtilisateur').readOnly = false;
    }

    // ===== COMPÉTENCES =====
    document.getElementById('utilisateurSelect').addEventListener('change', function() {
        if (this.value) loadUserCompetences(this.value);
        else document.getElementById('userCompetencesSection').style.display = 'none';
    });

    document.getElementById('btnAjouterCompetence').addEventListener('click', () => {
        const user = document.getElementById('utilisateurSelect').value;
        const comp = document.getElementById('competenceSelect').value;
        if (!user || !comp) {
            alert('Sélectionnez un utilisateur et une compétence');
            return;
        }

        fetch('/web/user-competence/assign', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            },
            body: JSON.stringify({code_user: user, code_comp: parseInt(comp)})
        })
        .then(r => r.json())
        .then(res => {
            if (res.message) {
                document.getElementById('competenceSelect').value = '';
                loadUserCompetences(user);
            } else alert('Erreur: ' + res.error);
        })
        .catch(e => alert('Erreur: ' + e.message));
    });

    function loadUserCompetences(code) {
        fetch(`/web/user-competence/competences/${code}`)
            .then(r => r.json())
            .then(comps => {
                const user = allUsers.find(u => u.code_user === code);
                displayUserCompetences(user, comps);
            })
            .catch(e => console.error(e));
    }

    function displayUserCompetences(user, comps) {
        const sec = document.getElementById('userCompetencesSection');
        const title = document.getElementById('userCompetencesTitle');
        const cont = document.getElementById('userCompetencesList');

        title.textContent = `Compétences de ${user.nom_user} ${user.prenom_user||''}`;

        if (!comps || comps.length === 0) {
            cont.innerHTML = '<p class="text-muted">Aucune compétence assignée</p>';
        } else {
            cont.innerHTML = comps.map(c => `
                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                    <span>${c.label_comp}</span>
                    <button class="btn btn-sm btn-danger" onclick="removeCompetence('${user.code_user}', ${c.code_comp})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `).join('');
        }
        sec.style.display = 'block';
    }

    window.removeCompetence = (user, comp) => {
        if (!confirm('Retirer cette compétence ?')) return;
        
        fetch('/web/user-competence/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
            },
            body: JSON.stringify({code_user: user, code_comp: comp})
        })
        .then(r => r.json())
        .then(res => {
            if (res.message) loadUserCompetences(user);
            else alert('Erreur: ' + res.error);
        })
        .catch(e => alert('Erreur: ' + e.message));
    };
});
</script>

@endsection
