- Un employer demende un conge depuis son espace 
- Le responsable RH la valide ou la refuse 
- Le solde se met a jour automatiquement 
- L'admin vue l'ensemble des absence via un tableau de bord 

# Fonctionnalite par role 
- sarobidy
    - Employe
    	- Connexion
            - Model : EmployeModel.php
            - controller : EmployerController.php
            - route  : 
                - page connexion : /
                - page action formulaire : /auth
            - view : 
                - Template p1
    	- Soummetre une demande de conge (type , date,motif)
            - 
    	- Consulter ses propres dmd et status 
    	- Voir son solde de conger restant par type 
    	- Annuler une demande encore en attente 
    	- Modifier son profil
    		- nom
    		- mot de passe 
- Responsable RH
	- Voir tout le demande en attente 
	- Approuver ou reffuser une demande (avec commentaire optionel)
	- M a j automatique du solde  a l'approbation 
	- Filtrer les dmd par departement ou statut 
	- voir le solde de chaque employer 

- Administrateur
	- CRUD employer
	- CRUD departement et type de conge 
	- Tableau de bord : absense du mois en cours 
	- Initialiser / ajuster le solde annuel d'un  employer 
	- Voir historique complet de tout le dmd
	
	
## Table 

- employes
    -  id (PK)
    - nom 
    - email (unique)
    - password 
    - role (rh,admin)
    - departements_if (FK)
    - date_embauche 
    - actif (0/1)
- departements
    - id (pk)
    - nom
    - description 
    - id_type_conge
    - libelle 
    - jours_annuels 
    - deductible (0/1)
- soldes 
    - id (pk)
    - employe_id (FK)
    - annee
    - ajours_attribues
    - jours_pris 
- conges 
    - id (PK)
    - employes_id (FK)
    - type_conge_id (FK)
    - date_debut
    - date_fin
    - nb_jours 
    - motif
    - status 
    - mommentaire_rh
    - created_ at 
    - traite_par (FK + employes)
    
- Status 
    - en_attente 
    - approuve
    - refusee
    - annule 


---
# workflow

## 👥 Répartition des tâches

| Rôle | Développeur |
|---|---|
| Filtre-Auth | **Tsinjo** |
| Employé | **Sarobidy** |
| Responsable RH | **Sarobidy** |
| Administrateur | **Tsinjo** |

---

## 🔐 AUTH — Partagé (les deux)

### Tsinjo : Connexion - filter
- [ ] **Model** : `app/Models/EmployeModel.php`
- [ ] **Controller** : `app/Controllers/AuthController.php`
- [ ] **Routes** :
  - `GET  /`        → formulaire de connexion
  - `POST /auth`    → traitement de la connexion
- [ ] **Views** :
  - `app/Views/auth/login.php` → Template **Page 1** du fichier HTML
- [ ] Redirection selon le rôle après connexion (`/employe`, `/rh`, `/admin`)
- [ ] Déconnexion : `GET /logout` → destruction de session
- [ ] **Filtre de rôle** : `app/Filters/AuthFilter.php`
  - [ ] Vérifier que la session est active
  - [ ] Vérifier que le rôle correspond au groupe de routes
  - [ ] Rediriger vers `/` si non autorisé
  - [ ] Enregistrer le filtre dans `app/Config/Filters.php` sur les 3 groupes

---

## 👤 EMPLOYÉ — Sarobidy

> Groupe de routes : `/employe`  
> Controller : `app/Controllers/Employe/EmployeController.php`  
> Model : `app/Models/EmployeModel.php`, `app/Models/SoldeModel.php`

### Tableau de bord employé

> **routes** : `/employe/dashboard`  
**View** : `app/Views/employe/dashboard.php` → Template **Page 2** 
    - Afficher les métriques : solde restant, demandes en cours, demandes approuvées
    - Afficher les demandes récentes de l'employé connecté

### Soumettre une demande de congé
- [ ] **Routes** :
  - `GET  /employe/demande`        → formulaire
  - `POST /employe/demande/store`  → traitement
- [ ] **View** : `app/Views/employe/demande_form.php` → Template **Page 3** 
    - [ ] Champs : type de congé, date début, date fin, motif (optionnel)
    - [ ] Calcul automatique du nombre de jours (PHP / JS)
    - [ ] Validation CI4 : champs requis, dates cohérentes, solde suffisant
    - [ ] Vérifier absence de chevauchement avec une demande existante
    - [ ] Insertion en base avec statut `en_attente`
    - [ ] Flash message de confirmation après soumission

### Consulter ses propres demandes
- [ ] **Route** : `GET /employe/mes-conges` → `CongeController::index`
- [ ] **View** : `app/Views/employe/mes_conges.php` → Template **Page 4** du fichier HTML
- [ ] Lister toutes les demandes de l'employé connecté
- [ ] Afficher le statut (en attente / approuvée / refusée / annulée) avec les badges du template
- [ ] Afficher le commentaire RH si refus

### Voir son solde restant par type
- [ ] Afficher les barres de solde par type de congé (annuel, maladie, spécial)
- [ ] Données récupérées depuis `SoldeModel` selon `id_employe`
- [ ] Intégrer dans le dashboard et le formulaire de demande

### Annuler une demande en attente
- [ ] **Route** : `POST /employe/demande/annuler/{id}` → `CongeController::annuler`
- [ ] Vérifier que la demande appartient à l'employé connecté
- [ ] Vérifier que le statut est bien `en_attente`
- [ ] Mettre à jour le statut en `annulee`
- [ ] Flash message de confirmation

### Modifier son profil
- [ ] **Routes** :
  - `GET  /employe/profil`        → affichage
  - `POST /employe/profil/update` → traitement
- [ ] **View** : `app/Views/employe/profil.php` → Template **Page 5** du fichier HTML
- [ ] Modifier : nom, prénom
- [ ] Modifier : mot de passe (avec vérification de l'ancien)
- [ ] Validation CI4 + hash du nouveau mot de passe

---

## 🧑‍💼 RESPONSABLE RH — Sarobidy

> Groupe de routes : `/rh`  
> Controller : `app/Controllers/RH/DemandeController.php`  
> Model : `app/Models/CongeModel.php`, `app/Models/SoldeModel.php`

### Voir toutes les demandes en attente
- [ ] **Route** : `GET /rh` → `DemandeController::index`
- [ ] **View** : `app/Views/rh/dashboard.php` → Template **Page 6** du fichier HTML
- [ ] Lister les demandes avec statut `en_attente`
- [ ] Afficher : nom employé, type, dates, nombre de jours, motif

### Approuver ou refuser une demande
- [ ] **Routes** :
  - `POST /rh/demande/approuver/{id}` → `DemandeController::approuver`
  - `POST /rh/demande/refuser/{id}`   → `DemandeController::refuser`
- [ ] **View** : `app/Views/rh/detail_demande.php` → Template **Page 7** du fichier HTML
- [ ] Champ commentaire optionnel (visible par l'employé en cas de refus)
- [ ] Mise à jour du statut en `approuvee` ou `refusee`
- [ ] Flash message de confirmation

### Mise à jour automatique du solde à l'approbation
- [ ] À l'approbation, déduire le nombre de jours du solde correspondant dans `SoldeModel`
- [ ] Vérification que le solde est suffisant avant approbation
- [ ] Afficher une alerte si solde insuffisant

### Filtrer les demandes par département ou statut
- [ ] **Route** : `GET /rh/demandes?departement=IT&statut=en_attente`
- [ ] **View** : intégré dans `app/Views/rh/dashboard.php` → Template **Page 6** (filtres)
- [ ] Filtres : département, statut (`en_attente`, `approuvee`, `refusee`, `annulee`)
- [ ] Formulaire de filtre avec `<select>` (Bootstrap, style du template)
- [ ] Résultats mis à jour dynamiquement (rechargement GET)

### Voir le solde de chaque employé
- [ ] **Route** : `GET /rh/soldes` → `DemandeController::soldes`
- [ ] Tableau listant tous les employés avec leur solde par type de congé
- [ ] Filtrable par département

---

## 🛠️ ADMINISTRATEUR — Tsinjo

> Groupe de routes : `/admin`  
> Controllers : `app/Controllers/Admin/EmployeController.php`, `app/Controllers/Admin/DashboardController.php`

### CRUD Employés
- [ ] **Routes** :
  - `GET    /admin/employes`           → liste
  - `GET    /admin/employes/create`    → formulaire création
  - `POST   /admin/employes/store`     → enregistrement
  - `GET    /admin/employes/edit/{id}` → formulaire édition
  - `POST   /admin/employes/update/{id}` → mise à jour
  - `POST   /admin/employes/delete/{id}` → désactivation
- [ ] **View** : `app/Views/admin/employes.php` → Template **Page 9** du fichier HTML
- [ ] Champs : prénom, nom, email, département, rôle, date d'embauche, mot de passe initial
- [ ] Activation / désactivation d'un compte (pas de suppression définitive)
- [ ] Les soldes sont initialisés automatiquement à la création selon les types configurés

### CRUD Départements et Types de congé
- [ ] **Routes** :
  - `GET  /admin/departements`           → liste + formulaire
  - `POST /admin/departements/store`     → création
  - `POST /admin/departements/delete/{id}` → suppression
  - `GET  /admin/types-conge`            → liste + formulaire
  - `POST /admin/types-conge/store`      → création
  - `POST /admin/types-conge/delete/{id}` → suppression
- [ ] Champs type de congé : libellé, nombre de jours par défaut, déductible du solde (oui/non)

### Tableau de bord : absences du mois en cours
- [ ] **Route** : `GET /admin` → `DashboardController::index`
- [ ] **View** : `app/Views/admin/dashboard.php` → Template **Page 8** du fichier HTML
- [ ] Métriques : total demandes ce mois, approuvées, en attente, refusées
- [ ] Tableau des absences du mois en cours (tous employés)
- [ ] Filtrable par département

### Initialiser / ajuster le solde annuel d'un employé
- [ ] **Routes** :
  - `GET  /admin/soldes`              → liste des soldes
  - `POST /admin/soldes/ajuster/{id}` → modification
- [ ] Formulaire d'ajustement par employé et par type de congé
- [ ] Historique des modifications de solde

### Voir l'historique complet de toutes les demandes
- [ ] **Route** : `GET /admin/historique`
- [ ] Tableau paginé de toutes les demandes (tous employés, tous statuts)
- [ ] Filtres : employé, département, type, statut, période
- [ ] Export optionnel (CSV)

---