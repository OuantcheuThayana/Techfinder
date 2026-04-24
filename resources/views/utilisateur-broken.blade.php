
Claude a terminé la réponse.
Vous avez dit : cooment recuperer un projet dans git hub
cooment recuperer un projet dans git hub

21 avr.
Claude a répondu : Il y a deux façons principales de récupérer un projet depuis GitHub :
Il y a deux façons principales de récupérer un projet depuis GitHub :

1. Cloner un dépôt (première fois)
bash
git clone https://github.com/utilisateur/nom-du-repo.git
Cela crée un dossier local avec tout le projet. Tu peux aussi spécifier un nom de dossier :

bash
git clone https://github.com/utilisateur/nom-du-repo.git mon-dossier
2. Mettre à jour un projet déjà cloné
Si tu as déjà le projet en local et tu veux récupérer les dernières modifications :

bash
git pull
Trouver l'URL d'un repo GitHub
Sur la page du dépôt GitHub, clique sur le bouton vert "Code", puis copie l'URL HTTPS.

Cas particuliers
Cloner une branche spécifique :

bash
git clone -b nom-branche https://github.com/utilisateur/repo.git
Repo privé → GitHub te demandera tes identifiants (ou un token d'accès personnel si tu as activé l'authentification à deux facteurs).

Avec SSH (si tu as configuré une clé SSH) :

bash
git clone git@github.com:utilisateur/nom-du-repo.git
Tu veux cloner un repo spécifique ou tu as un cas particulier à gérer ?

Vous avez dit : produire le code de la page utilisateur.

@extends('template') @section('main') <div class="container mt-5"> <div class="row"> <div class="col-md-8"> <h2 class="mb-4">Gestion des Compétences</h2> <!-- Formulaire d'ajout/modification --> <div class="card mb-4">

pasted

produire le code de la page  utilisateur.blade.php

03:09
Claude a répondu : Je vais analyser la structure de ta page competences.
Je vais analyser la structure de ta page competences.blade.php pour produire une page utilisateur.blade.php cohérente.


Consulté un fichier, fichier créé, lu un fichier
Consulté un fichier, fichier créé, lu un fichier
La page utilisateur.blade.php est générée en suivant exactement la même structure que competences.blade.php. Voici ce qui a été adapté :

Champs du formulaire — nom, prénom, email, rôle (select), mot de passe

Affichage de la liste — chaque carte affiche le nom complet, l'email, et un badge coloré selon le rôle (admin = rouge, manager = jaune, user = vert)

Routes API utilisées :

GET /api/utilisateurs — charger la liste
POST /api/utilisateurs — créer
PUT /api/utilisateurs/{id} — modifier
DELETE /api/utilisateurs/{id} — supprimer
Champs supposés du modèle : id_user, nom_user, prenom_user, email_user, role_user — adapte-les selon ton modèle Eloquent réel si les noms diffèrent.


Utilisateur.blade
Code · PHP 

Souhaitez-vous être averti lorsque Claude répond ?



Claude est une IA et peut faire des erreurs. Veuillez vérifier les réponses.
Utilisateur.blade · PHP
Copier

@extends('template')
@section('main')
 
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
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
                                <input type="text" class="form-control" id="codeUtilisateur" name="codeUtilisateur" placeholder="Ex: USR001" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="loginUtilisateur" class="form-label">Login :</label>
                                <input type="text" class="form-control" id="loginUtilisateur" name="loginUtilisateur" placeholder="Ex: jdupont" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nomUtilisateur" class="form-label">Nom :</label>
                                <input type="text" class="form-control" id="nomUtilisateur" name="nomUtilisateur" placeholder="Ex: Dupont" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenomUtilisateur" class="form-label">Prénom :</label>
                                <input type="text" class="form-control" id="prenomUtilisateur" name="prenomUtilisateur" placeholder="Ex: Jean">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telUtilisateur" class="form-label">Téléphone :</label>
                                <input type="tel" class="form-control" id="telUtilisateur" name="telUtilisateur" placeholder="Ex: +33612345678" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sexeUtilisateur" class="form-label">Sexe :</label>
                                <select class="form-select" id="sexeUtilisateur" name="sexeUtilisateur" required>
                                    <option value="">-- Sélectionner --</option>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="roleUtilisateur" class="form-label">Rôle :</label>
                                <select class="form-select" id="roleUtilisateur" name="roleUtilisateur">
                                    <option value="">-- Sélectionner un rôle --</option>
                                    <option value="admin">Administrateur</option>
                                    <option value="technicien">Technicien</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="etatUtilisateur" class="form-label">État :</label>
                                <select class="form-select" id="etatUtilisateur" name="etatUtilisateur">
                                    <option value="">-- Sélectionner un état --</option>
                                    <option value="actif">Actif</option>
                                    <option value="inactif">Inactif</option>
                                    <option value="suspendu">Suspendu</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3" id="passwordGroup">
                            <label for="passwordUtilisateur" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="passwordUtilisateur" name="passwordUtilisateur" placeholder="Minimum 8 caractères">
                            <div class="form-text">Laissez vide pour conserver le mot de passe actuel lors d'une modification.</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" id="btnAjouter" class="btn btn-success">Ajouter</button>
                            <button type="button" id="btnAnnuler" class="btn btn-secondary" style="display:none;">Annuler</button>
                        </div>
                        <input type="hidden" id="utilisateurId" value="">
                    </form>
                </div>
            </div>
 
            <!-- Liste des utilisateurs -->
            <h3 class="mt-5 mb-3">Liste des utilisateurs existants</h3>
            <div id="utilisateursList">
                <div class="text-center text-muted py-4">Chargement des utilisateurs...</div>
            </div>

            <!-- Section Gestion des compétences par utilisateur -->
            <h3 class="mt-5 mb-3">Gérer les compétences des utilisateurs</h3>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Lier les compétences aux utilisateurs</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="utilisateurSelect" class="form-label">Sélectionner un utilisateur :</label>
                            <select class="form-select" id="utilisateurSelect">
                                <option value="">-- Choisir un utilisateur --</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="competenceSelect" class="form-label">Sélectionner une compétence :</label>
                            <select class="form-select" id="competenceSelect">
                                <option value="">-- Choisir une compétence --</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" id="btnAjouterCompetence" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Ajouter la compétence
                    </button>
                </div>
            </div>

            <!-- Affichage des compétences de l'utilisateur sélectionné -->
            <div id="userCompetencesSection" style="display:none; margin-top: 2rem;">
                <h5 class="mb-3" id="userCompetencesTitle"></h5>
                <div id="userCompetencesList" class="list-group">
                    <div class="list-group-item text-muted">Aucune compétence assignée</div>
                </div>
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
                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
            </div>
        </div>
    </div>
</div>
 
<style>
    .utilisateur-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
 
    .utilisateur-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        background: #fff;
    }
 
    .utilisateur-item h6 {
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
 
    .utilisateur-item p {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }
 
    .utilisateur-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }
 
    .badge-id {
        background: #e7f3ff;
        color: #0d6efd;
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
    }
 
    .badge-role {
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }
 
    .badge-role.admin    { background: #fce8e8; color: #dc3545; }
    .badge-role.manager  { background: #fff3cd; color: #856404; }
    .badge-role.user     { background: #d1e7dd; color: #0f5132; }

    .competence-badge {
        background: #e7f3ff;
        color: #0d6efd;
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0.25rem;
    }

    .competence-badge .btn-remove {
        background: transparent;
        border: none;
        color: #0d6efd;
        cursor: pointer;
        padding: 0;
        font-size: 1rem;
        line-height: 1;
    }

    .competence-badge .btn-remove:hover {
        color: #dc3545;
    }
</style>
 
<script>
document.addEventListener('DOMContentLoaded', function() {
    let deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    let utilisateurToDelete = null;
    let allCompetences = [];

    // ===== FONCTIONS PRINCIPALES =====

    function loadUtilisateurs() {
        console.log('Chargement des utilisateurs...');
        fetch('/api/utilisateurs')
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) throw new Error('Erreur réseau');
                return response.json();
            })
            .then(utilisateurs => {
                console.log('Utilisateurs reçus:', utilisateurs);
                displayUtilisateurs(utilisateurs);
                // Mettre à jour les selects
                updateSelectUtilisateurs(utilisateurs);
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('utilisateursList').innerHTML =
                    '<div class="alert alert-danger">Erreur lors du chargement: ' + error.message + '</div>';
            });
    }

    function displayUtilisateurs(utilisateurs) {
        const container = document.getElementById('utilisateursList');

        if (!utilisateurs || utilisateurs.length === 0) {
            container.innerHTML = '<div class="alert alert-info">Aucun utilisateur enregistré pour le moment.</div>';
            return;
        }

        container.innerHTML = utilisateurs.map(user => `
            <div class="utilisateur-item">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <h6 class="mb-0">${user.nom_user} ${user.prenom_user || ''}</h6>
                    <span class="badge-id">Code: ${user.code_user}</span>
                </div>
                <p class="mb-1"><i class="bi bi-person-circle"></i> ${user.login_user}</p>
                <p class="mb-1"><i class="bi bi-telephone"></i> ${user.tel_user}</p>
                <span class="badge-role ${user.role_user || 'client'}">${user.role_user || 'N/A'}</span>
                <div class="utilisateur-actions">
                    <button class="btn btn-sm btn-warning"
                        onclick="editUtilisateur('${user.code_user}', '${user.nom_user.replace(/'/g, "\\'")}', '${(user.prenom_user || '').replace(/'/g, "\\'")}', '${user.login_user.replace(/'/g, "\\'")}', '${user.tel_user}', '${user.sexe_user}', '${user.role_user || ''}', '${user.etat_user || ''}')"
                        title="Modifier">
                        <i class="bi bi-pencil"></i> Modifier
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUtilisateur('${user.code_user}')" title="Supprimer">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        `).join('');
    }

    function updateSelectUtilisateurs(utilisateurs) {
        const select = document.getElementById('utilisateurSelect');
        const html = '<option value="">-- Choisir un utilisateur --</option>' +
            utilisateurs.map(user => 
                `<option value="${user.code_user}">${user.nom_user} ${user.prenom_user || ''}</option>`
            ).join('');
        select.innerHTML = html;
    }

    function saveUtilisateur() {
        const id       = document.getElementById('utilisateurId').value;
        const code     = document.getElementById('codeUtilisateur').value.trim();
        const nom      = document.getElementById('nomUtilisateur').value.trim();
        const prenom   = document.getElementById('prenomUtilisateur').value.trim();
        const login    = document.getElementById('loginUtilisateur').value.trim();
        const tel      = document.getElementById('telUtilisateur').value.trim();
        const sexe     = document.getElementById('sexeUtilisateur').value;
        const role     = document.getElementById('roleUtilisateur').value;
        const etat     = document.getElementById('etatUtilisateur').value;
        const password = document.getElementById('passwordUtilisateur').value;

        if (!code || !nom || !login || !tel || !sexe) {
            alert('Veuillez remplir tous les champs obligatoires');
            return;
        }

        const data = {
            code_user: code,
            nom_user: nom,
            prenom_user: prenom,
            login_user: login,
            tel_user: tel,
            sexe_user: sexe,
            role_user: role || 'client',
            etat_user: etat || 'actif',
        };
        if (password) data.password_user = password;

        const url    = id ? `/api/utilisateurs/${id}` : '/api/utilisateurs';
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
            if (result.code_user || result.id) {
                alert(id ? 'Utilisateur modifié avec succès' : 'Utilisateur ajouté avec succès');
                resetForm();
                loadUtilisateurs();
            } else {
                console.error('Réponse:', result);
                alert('Erreur lors de l\'enregistrement');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue: ' + error.message);
        });
    }

    function editUtilisateur(code, nom, prenom, login, tel, sexe, role, etat) {
        document.getElementById('utilisateurId').value      = code;
        document.getElementById('codeUtilisateur').value    = code;
        document.getElementById('nomUtilisateur').value     = nom;
        document.getElementById('prenomUtilisateur').value  = prenom;
        document.getElementById('loginUtilisateur').value   = login;
        document.getElementById('telUtilisateur').value     = tel;
        document.getElementById('sexeUtilisateur').value    = sexe;
        document.getElementById('roleUtilisateur').value    = role;
        document.getElementById('etatUtilisateur').value    = etat;
        document.getElementById('passwordUtilisateur').value = '';
        document.getElementById('codeUtilisateur').readOnly = true;
        document.getElementById('btnAjouter').textContent = 'Modifier';
        document.getElementById('btnAnnuler').style.display = 'inline-block';
        document.getElementById('nomUtilisateur').focus();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function deleteUtilisateur(code) {
        utilisateurToDelete = code;
        deleteModal.show();
    }

    function removeCompetence(codeUser, codeComp) {
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
                loadUserCompetences(codeUser);
            } else if (result.error) {
                alert('Erreur: ' + result.error);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    }

    function resetForm() {
        document.getElementById('utilisateurForm').reset();
        document.getElementById('utilisateurId').value = '';
        document.getElementById('codeUtilisateur').readOnly = false;
        document.getElementById('btnAjouter').textContent = 'Ajouter';
        document.getElementById('btnAnnuler').style.display = 'none';
    }

    // ===== GESTION DES COMPÉTENCES =====

    function loadCompetences() {
        fetch('/api/competences')
            .then(response => response.json())
            .then(competences => {
                allCompetences = competences;
                populateCompetenceSelect();
            })
            .catch(error => console.error('Erreur:', error));
    }

    function populateCompetenceSelect() {
        const select = document.getElementById('competenceSelect');
        if (!select) return;
        const html = '<option value="">-- Choisir une compétence --</option>' +
            allCompetences.map(comp => 
                `<option value="${comp.code_comp}">${comp.label_comp}</option>`
            ).join('');
        select.innerHTML = html;
    }

    function loadUserCompetences(codeUser) {
        fetch(`/web/user-competence/competences/${codeUser}`)
            .then(response => response.json())
            .then(competences => {
                fetch(`/api/utilisateurs/${codeUser}`)
                    .then(r => r.json())
                    .then(utilisateur => {
                        displayUserCompetences(utilisateur, competences);
                    });
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('userCompetencesSection').style.display = 'block';
                document.getElementById('userCompetencesList').innerHTML = 
                    '<div class="alert alert-warning">Erreur: ' + error.message + '</div>';
            });
    }

    function displayUserCompetences(utilisateur, competences) {
        const section = document.getElementById('userCompetencesSection');
        const title = document.getElementById('userCompetencesTitle');
        const container = document.getElementById('userCompetencesList');

        title.textContent = `Compétences de ${utilisateur.nom_user} ${utilisateur.prenom_user || ''}`;

        if (!competences || competences.length === 0) {
            container.innerHTML = '<div class="list-group-item text-muted">Aucune compétence assignée</div>';
        } else {
            container.innerHTML = competences.map(comp => `
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>${comp.label_comp}</span>
                    <button class="btn btn-sm btn-danger" 
                        onclick="removeCompetence('${utilisateur.code_user}', ${comp.code_comp})"
                        title="Retirer cette compétence">
                        <i class="bi bi-trash"></i> Retirer
                    </button>
                </div>
            `).join('');
        }

        section.style.display = 'block';
    }

    function assignCompetence(codeUser, codeComp) {
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
                loadUserCompetences(codeUser);
                document.getElementById('competenceSelect').value = '';
            } else if (result.error) {
                alert('Erreur: ' + result.error);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de l\'ajout');
        });
    }

    // ===== EVENT LISTENERS =====

    // Formulaire
    document.getElementById('utilisateurForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveUtilisateur();
    });

    document.getElementById('btnAnnuler').addEventListener('click', function() {
        resetForm();
    });

    // Suppression
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!utilisateurToDelete) return;

        fetch(`/api/utilisateurs/${utilisateurToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
        .then(response => {
            if (response.status === 204 || response.status === 200) {
                alert('Utilisateur supprimé avec succès');
                deleteModal.hide();
                loadUtilisateurs();
            } else {
                alert('Erreur lors de la suppression');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });

        utilisateurToDelete = null;
    });

    // Gestion des compétences
    const userSelect = document.getElementById('utilisateurSelect');
    if (userSelect) {
        userSelect.addEventListener('change', function() {
            if (this.value) {
                loadUserCompetences(this.value);
            } else {
                document.getElementById('userCompetencesSection').style.display = 'none';
            }
        });
    }

    const btnAddComp = document.getElementById('btnAjouterCompetence');
    if (btnAddComp) {
        btnAddComp.addEventListener('click', function() {
            const codeUser = document.getElementById('utilisateurSelect').value;
            const codeComp = document.getElementById('competenceSelect').value;

            if (!codeUser || !codeComp) {
                alert('Veuillez sélectionner un utilisateur et une compétence');
                return;
            }

            assignCompetence(codeUser, codeComp);
        });
    }

    // ===== INITIALISATION =====
    loadUtilisateurs();
    loadCompetences();

    // Exposer au scope global
    window.editUtilisateur   = editUtilisateur;
    window.deleteUtilisateur = deleteUtilisateur;
    window.removeCompetence  = removeCompetence;
});
</script>
 
    // Soumettre le formulaire
    document.getElementById('utilisateurForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveUtilisateur();
    });
 
    // Bouton Annuler
    document.getElementById('btnAnnuler').addEventListener('click', function() {
        resetForm();
    });
 
    function loadUtilisateurs() {
        fetch('/api/utilisateurs')
            .then(response => response.json())
            .then(utilisateurs => {
                displayUtilisateurs(utilisateurs);
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('utilisateursList').innerHTML =
                    '<div class="alert alert-danger">Erreur lors du chargement des utilisateurs</div>';
            });
    }
 
    function displayUtilisateurs(utilisateurs) {
        const container = document.getElementById('utilisateursList');
 
        if (utilisateurs.length === 0) {
            container.innerHTML = '<div class="alert alert-info">Aucun utilisateur enregistré pour le moment.</div>';
            return;
        }
 
        container.innerHTML = utilisateurs.map(user => `
            <div class="utilisateur-item">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <h6 class="mb-0">${user.nom_user} ${user.prenom_user || ''}</h6>
                    <span class="badge-id">Code: ${user.code_user}</span>
                </div>
                <p class="mb-1"><i class="bi bi-person-circle"></i> ${user.login_user}</p>
                <p class="mb-1"><i class="bi bi-telephone"></i> ${user.tel_user}</p>
                <span class="badge-role ${user.role_user}">${user.role_user}</span>
                <div class="utilisateur-actions">
                    <button class="btn btn-sm btn-warning"
                        onclick="editUtilisateur('${user.code_user}', '${user.nom_user.replace(/'/g, "\\'")}', '${(user.prenom_user || '').replace(/'/g, "\\'")}', '${user.login_user.replace(/'/g, "\\'")}', '${user.tel_user}', '${user.sexe_user}', '${user.role_user}', '${user.etat_user}')"
                        title="Modifier">
                        <i class="bi bi-pencil"></i> Modifier
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUtilisateur('${user.code_user}')" title="Supprimer">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        `).join('');
    }
 
    function saveUtilisateur() {
        const id       = document.getElementById('utilisateurId').value;
        const code     = document.getElementById('codeUtilisateur').value.trim();
        const nom      = document.getElementById('nomUtilisateur').value.trim();
        const prenom   = document.getElementById('prenomUtilisateur').value.trim();
        const login    = document.getElementById('loginUtilisateur').value.trim();
        const tel      = document.getElementById('telUtilisateur').value.trim();
        const sexe     = document.getElementById('sexeUtilisateur').value;
        const role     = document.getElementById('roleUtilisateur').value;
        const etat     = document.getElementById('etatUtilisateur').value;
        const password = document.getElementById('passwordUtilisateur').value;

        if (!code || !nom || !login || !tel || !sexe) {
            alert('Veuillez remplir tous les champs obligatoires');
            return;
        }

        const data = {
            code_user: code,
            nom_user: nom,
            prenom_user: prenom,
            login_user: login,
            tel_user: tel,
            sexe_user: sexe,
            role_user: role,
            etat_user: etat,
        };
        if (password) data.password_user = password;

        const url    = id ? `/api/utilisateurs/${id}` : '/api/utilisateurs';
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
            if (result.code_user) {
                loadUtilisateurs();
            } else {
                alert('Erreur lors de l\'enregistrement');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    }
 
    function editUtilisateur(code, nom, prenom, login, tel, sexe, role, etat) {
        document.getElementById('utilisateurId').value      = code;
        document.getElementById('codeUtilisateur').value    = code;
        document.getElementById('nomUtilisateur').value     = nom;
        document.getElementById('prenomUtilisateur').value  = prenom;
        document.getElementById('loginUtilisateur').value   = login;
        document.getElementById('telUtilisateur').value     = tel;
        document.getElementById('sexeUtilisateur').value    = sexe;
        document.getElementById('roleUtilisateur').value    = role;
        document.getElementById('etatUtilisateur').value    = etat;
        document.getElementById('passwordUtilisateur').value = '';
        document.getElementById('codeUtilisateur').readOnly = true;
        document.getElementById('btnAjouter').textContent = 'Modifier';
        document.getElementById('btnAnnuler').style.display = 'inline-block';
        document.getElementById('nomUtilisateur').focus();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
 
    function deleteUtilisateur(id) {
        utilisateurToDelete = id;
        deleteModal.show();
    }
 
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!utilisateurToDelete) return;
 
        fetch(`/api/utilisateurs/${utilisateurToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
        .then(response => {
            if (response.status === 204 || response.ok) {
                alert('Utilisateur supprimé avec succès');
                deleteModal.hide();
                loadUtilisateurs();
            } else {
                alert('Erreur lors de la suppression');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
 
        utilisateurToDelete = null;
    });
 
    function resetForm() {
        document.getElementById('utilisateurForm').reset();
        document.getElementById('utilisateurId').value = '';
        document.getElementById('codeUtilisateur').readOnly = false;
        document.getElementById('btnAjouter').textContent = 'Ajouter';
        document.getElementById('btnAnnuler').style.display = 'none';
    }
 
    // Exposer les fonctions au scope global
    window.editUtilisateur   = editUtilisateur;
    window.deleteUtilisateur = deleteUtilisateur;

    // ===== GESTION DES COMPÉTENCES =====

    let allCompetences = [];

    // Charger les compétences au démarrage
    loadCompetences();

    // Événements pour la gestion des compétences
    document.getElementById('utilisateurSelect').addEventListener('change', function() {
        if (this.value) {
            loadUserCompetences(this.value);
        } else {
            document.getElementById('userCompetencesSection').style.display = 'none';
        }
    });

    document.getElementById('btnAjouterCompetence').addEventListener('click', function() {
        const codeUser = document.getElementById('utilisateurSelect').value;
        const codeComp = document.getElementById('competenceSelect').value;

        if (!codeUser || !codeComp) {
            alert('Veuillez sélectionner un utilisateur et une compétence');
            return;
        }

        assignCompetence(codeUser, codeComp);
    });

    function loadCompetences() {
        fetch('/api/competences')
            .then(response => response.json())
            .then(competences => {
                allCompetences = competences;
                populateCompetenceSelect();
            })
            .catch(error => console.error('Erreur:', error));
    }

    function populateCompetenceSelect() {
        const select = document.getElementById('competenceSelect');
        const html = '<option value="">-- Choisir une compétence --</option>' +
            allCompetences.map(comp => 
                `<option value="${comp.code_comp}">${comp.label_comp}</option>`
            ).join('');
        select.innerHTML = html;
    }

    function loadUserCompetences(codeUser) {
        fetch(`/api/utilisateurs/${codeUser}`)
            .then(response => response.json())
            .then(utilisateur => {
                // Charger les compétences via le point de terminaison custom
                fetch(`/web/user-competence/competences/${codeUser}`)
                    .then(response => response.json())
                    .then(competences => {
                        displayUserCompetences(utilisateur, competences);
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        // Utiliser un fallback si le point de terminaison custom n'existe pas
                        displayUserCompetences(utilisateur, []);
                    });
            })
            .catch(error => console.error('Erreur:', error));
    }

    function displayUserCompetences(utilisateur, competences) {
        const section = document.getElementById('userCompetencesSection');
        const title = document.getElementById('userCompetencesTitle');
        const container = document.getElementById('userCompetencesList');

        title.textContent = `Compétences de ${utilisateur.nom_user} ${utilisateur.prenom_user || ''}`;

        if (competences.length === 0) {
            container.innerHTML = '<div class="list-group-item text-muted">Aucune compétence assignée</div>';
        } else {
            container.innerHTML = competences.map(comp => `
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>${comp.label_comp}</span>
                    <button class="btn btn-sm btn-danger" 
                        onclick="removeCompetence('${utilisateur.code_user}', ${comp.code_comp})"
                        title="Retirer cette compétence">
                        <i class="bi bi-trash"></i> Retirer
                    </button>
                </div>
            `).join('');
        }

        section.style.display = 'block';
    }

    function assignCompetence(codeUser, codeComp) {
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
                loadUserCompetences(codeUser);
                document.getElementById('competenceSelect').value = '';
            } else if (result.error) {
                alert('Erreur: ' + result.error);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de l\'ajout');
        });
    }

    function removeCompetence(codeUser, codeComp) {
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
                loadUserCompetences(codeUser);
            } else if (result.error) {
                alert('Erreur: ' + result.error);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });
    }

    // Mettre à jour la liste des utilisateurs dans le select
    const originalLoadUtilisateurs = window.loadUtilisateurs;
    window.loadUtilisateurs = function() {
        fetch('/api/utilisateurs')
            .then(response => response.json())
            .then(utilisateurs => {
                displayUtilisateurs(utilisateurs);
                // Mettre à jour le select des utilisateurs
                const select = document.getElementById('utilisateurSelect');
                const html = '<option value="">-- Choisir un utilisateur --</option>' +
                    utilisateurs.map(user => 
                        `<option value="${user.code_user}">${user.nom_user} ${user.prenom_user || ''}</option>`
                    ).join('');
                select.innerHTML = html;
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('utilisateursList').innerHTML =
                    '<div class="alert alert-danger">Erreur lors du chargement des utilisateurs</div>';
            });
    };
});
</script>
 
@endsection
 
