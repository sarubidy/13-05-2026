-- 1. Départements
INSERT INTO departement (nom, description) VALUES 
('Ressources Humaines', 'Gestion du personnel et des congés'),
('Informatique', 'Développement et support technique'),
('Commercial', 'Ventes et relations clients');

-- 2. Employés 
-- (Le mot de passe utilisé ici est 'password' en clair. N'oubliez pas qu'en production, avec CodeIgniter, vous utiliserez password_hash())
INSERT INTO employes (nom, prenom, email, password, role, departement_id, date_embauche, actif) VALUES 
('Dupont', 'Alice', 'alice.rh@techmada.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rh', 1, '2020-01-15', 1),
('Martin', 'Bob', 'bob.it@techmada.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'employe', 2, '2023-05-10', 1),
('Ravelojaona', 'Charlie', 'charlie.com@techmada.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'employe', 3, '2021-12-01', 1),
('Andria', 'David', 'david.admin@techmada.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 2, '2019-03-01', 1);

-- 3. Types de congés
INSERT INTO type_conge (libelle, jours_annuels, deductible) VALUES 
('Congés Payés', 30.00, 1),
('Congé Maladie', 0.00, 0),
('Congé Maternité / Paternité', 0.00, 0),
('Permission Exceptionnelle',  0.00, 0);

-- 4. Soldes de congés (Pour l'année 2026)
INSERT INTO soldes (employe_id, annee, jours_attribues, jours_pris) VALUES 
(1, 2026, 30.00, 5.00), -- Alice (RH) a pris 5 jours
(2, 2026, 30.00, 0.00), -- Bob (IT) n'a rien pris
(3, 2026, 30.00, 12.00);-- Charlie (Ventes) a pris 12 jours

-- 5. Demandes de congés (Historique et en cours)
INSERT INTO conges (employe_id, type_conge_id, date_debut, date_fin, nb_jours, motif, status, commentaire_rh, traite_par) VALUES 
-- Demande approuvée dans le passé
(3, 1, '2026-03-01', '2026-03-15', 12.00, 'Vacances annuelles', 'approuve', 'Bonnes vacances !', 1),
-- Demande en attente (Bob est malade)
(2, 2, '2026-05-12', '2026-05-14', 3.00, 'Grippe (certificat médical dispo)', 'en_attente', NULL, NULL),
-- Demande refusée
(2, 1, '2026-12-24', '2026-12-25', 2.00, 'Noël', 'refusee', 'Présence indispensable requise ces jours-là', 1);