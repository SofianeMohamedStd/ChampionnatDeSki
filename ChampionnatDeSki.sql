CREATE TABLE `categories` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `profils` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nom_profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `epreuves` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `participants` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `profil_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_naissance` date NOT NULL,
  `photo` longblob NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  CONSTRAINT fk_categorie_id          -- On donne un nom à notre clé
        FOREIGN KEY (categorie_id)             -- Colonne sur laquelle on crée la clé
        REFERENCES Categories(id),        -- Colonne de référence
  CONSTRAINT fk_profil_id          -- On donne un nom à notre clé
        FOREIGN KEY (profil_id)             -- Colonne sur laquelle on crée la clé
        REFERENCES Profils(id)        -- Colonne de référence
) ENGINE=InnoDB;

CREATE TABLE `epreuves_participants` (
  `epreuves_id` int(11) NOT NULL,
  `participants_id` int(11) NOT NULL,
  PRIMARY KEY (`epreuves_id`,`participants_id`),
  CONSTRAINT fk_epreuves_id          -- On donne un nom à notre clé
        FOREIGN KEY (epreuves_id)             -- Colonne sur laquelle on crée la clé
        REFERENCES Epreuves(id),        -- Colonne de référence
  CONSTRAINT fk_participants_id          -- On donne un nom à notre clé
        FOREIGN KEY (participants_id)             -- Colonne sur laquelle on crée la clé
        REFERENCES Participants(id)        -- Colonne de référence
) ENGINE=InnoDB;

CREATE TABLE `passage` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `num_passage` int(11) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `passage_participants` (
  `passage_id` int(11) NOT NULL,
  `participants_id` int(11) NOT NULL,
  `temps` time NOT NULL,
  PRIMARY KEY (`passage_id`,`participants_id`),
  CONSTRAINT fk_passage_id          -- On donne un nom à notre clé
        FOREIGN KEY (passage_id)             -- Colonne sur laquelle on crée la clé
        REFERENCES Passage(id),        -- Colonne de référence
  CONSTRAINT fk_participants_id_id          -- On donne un nom à notre clé
        FOREIGN KEY (participants_id)             -- Colonne sur laquelle on crée la clé
        REFERENCES Participants(id)        -- Colonne de référence
) ENGINE=InnoDB;