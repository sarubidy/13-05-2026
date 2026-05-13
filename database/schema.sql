CREATE TABLE departement
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom CHAR(50),
    description TEXT
);

CREATE TABLE employes
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom CHAR(50),
    prenom CHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(100),
    role CHAR(20),
    departement_id INTEGER,
    date_embauche DATE,
    actif BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (departement_id) REFERENCES departement(id)
);

CREATE TABLE type_conge
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle VARCHAR(100),
    jours_annuels DECIMAL(5,2),
    deductible BOOLEAN DEFAULT TRUE
);

CREATE TABLE soldes
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id INTEGER,
    annee INTEGER,
    jours_attribues DECIMAL(5,2),
    jours_pris DECIMAL(5,2) DEFAULT 0,
    FOREIGN KEY (employe_id) REFERENCES employes(id) ON DELETE CASCADE
);

CREATE TABLE conges
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employe_id INTEGER,
    type_conge_id INTEGER,
    date_debut DATE,
    date_fin DATE,
    nb_jours DECIMAL(5,2),
    motif TEXT,
    status TEXT CHECK(status IN ('en_attente', 'approuve', 'refusee', 'annule')) DEFAULT 'en_attente',
    commentaire_rh TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    traite_par INTEGER NULL,
    FOREIGN KEY (employe_id) REFERENCES employes(id) ON DELETE CASCADE,
    FOREIGN KEY (type_conge_id) REFERENCES type_conge(id) ON DELETE RESTRICT,
    FOREIGN KEY (traite_par) REFERENCES employes(id) ON DELETE SET NULL
);