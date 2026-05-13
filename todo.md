- Un employer demende un conge depuis son espace 
- Le responsable RH la valide ou la refuse 
- Le solde se met a jour automatiquement 
- L'admin vue l'ensemble des absence via un tableau de bord 

# Fonctionnalite par role 
- Employe
	- Connexion/ deconnexion 
	- Soummetre une demande de conge (type , date,motif)
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
    
Status 
    - en_attente 
    - approuve
    - refusee
    - annule 
