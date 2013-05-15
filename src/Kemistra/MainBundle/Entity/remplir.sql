
-- Remplissage de la table TypeAnalyse
INSERT INTO TypeAnalyse (nom, dureeEstimee, nombreEmployeNecessaire, description, protocole)
VALUES ('Dosage du SO2 Libre', '00:15:00', 1, 'Dose la quantité de SO2 libre dans une solution alimentaire.', 'dosage_so2_libre.pdf'),
('Dosage du SO2 Total', '00:30:00', 1, 'Dosage du SO Total présent dans un échantillon alimentaire.', 'dosage_so2_total.pdf'),
('Dosage de l''acide tartrique par la méthode au vanadate', '01:20:00', 2, 'Dosage de la quantité d''acide tartrique dans une solution alimentaire.', 'dosage_acide_tartrique_methode_vanadate.pdf'),
('Analyse ADN', '04:00:00', 2, 'Analyse ADN d''un échantillon vivant.', 'dna_extraction.pdf'),
('Extraction de l''ADN d''un échantillon', '00:45:00', 1, 'Extraction des brins d''ADN à partir d''un échantillon', 'dna_extraction.pdf'),
('Dosage des nucléotides', '03:15:00', 2, 'Dosage des nucléotides d''un échantillon d''ADN extrait.', 'dna_extraction.pdf');



-- Remplissage de la table TypeResultat
INSERT INTO TypeResultat (typeAnalyse_id, unite, information)
VALUES (1, 'mg.L-1', 'Quantité de SO2 Libre'),
(2, 'mg.L-1', 'Quantité de SO2 Total'),
(3, 'g.L-1', 'Concetration d''acide tartrique'),
(4, 'mg.L-1', 'Quantité d''Adenine'),
(4, 'mg.L-1', 'Quantité de Cytosine'),
(4, 'mg.L-1', 'Quantité de Guamine'),
(4, 'mg.L-1', 'Quantité de Thymine'),
(6, 'mg.L-1', 'Quantité d''Adenine'),
(6, 'mg.L-1', 'Quantité de Cytosine'),
(6, 'mg.L-1', 'Quantité de Guamine'),
(6, 'mg.L-1', 'Quantité de Thymine');



-- Remplissage de la table TypeMateriel
INSERT INTO TypeMateriel (nom, description)
VALUES ('Burette graduée 20 mL', NULL),
('Burette graduée 20 mL', NULL),
('Burette graduée 50 mL', NULL),
('Bécher 20 mL', 'Le bécher permet de réaliser disverses analyses.'),
('Bécher 50 mL', 'Le bécher permet de réaliser disverses analyses.'),
('Bécher 100 mL', 'Le bécher permet de réaliser disverses analyses.'),
('Bécher 250 mL', 'Le bécher permet de réaliser disverses analyses.'),
('Bécher 500 mL', 'Le bécher permet de réaliser disverses analyses.'),
('Erlenmeyer 100 mL', NULL),
('Erlenmeyer 250 mL', NULL),
('Erlenmeyer 500 mL', NULL),
('Pipette simple', 'Pipette non graduée'),
('Pipette jaugée', 'Pour prélever une quantité précise de liquide.'),
('Pipette graduée', NULL),
('Entonoir de verre', NULL),
('Entonoir de plastique', NULL),
('Agitateur en verre', 'Petite baguette permettant d''agiter le contenu liquide d''un bécher.'),
('Poire d''aspiration', 'Permetant d''aspirer un liquide dans une pipette.'),
('Spatule en inox', 'Permettant de prélever une petite quantité de réactif solide (en poudre).'),
('Agitateur magnétique', 'Machine équipée d''un aimant pouvant être mis en rotation. Combiné à un barreau aimanté, il permet de maintenir un milieu liquide en agitation.'),
('Barreau aimanté', 'Petite barre aimantée étant utilisée avec un agitateur magnétique afin de maintenir un milieu liquide en agitation.'),
('Spectromètre de masse', 'Outils de haute technologie permettant d''identifier la présence de certaines molécules dans un échantillon.'),
('Fiole 100 mL', NULL),
('Tube à essais', 'Tube en verre permettant de réaliser des mélanges, des mesures au spectromètre, etc.');



-- Remplisage de la table StockMateriel
INSERT INTO StockMateriel (typeMateriel_id, quantite, dateAchat)
VALUES (9, 10, '2010-10-12'),
(9, 10, '2010-10-12'),
(2, 1, '2008-12-16'),
(2, 3, '2012-12-02'),
(15, 2, '2012-03-07'),
(4, 50, '2010-07-14'),
(18, 5, '2009-04-08'),
(12, 10, '2012-06-05'),
(22, 10, '2009-07-21'),
(21, 1, '2012-10-01'),
(23, 35, '2012-03-05');



-- Remplissage de la table Utilise
INSERT INTO Utilise (typeAnalyse_id, typeMateriel_id, quantite)
VALUES (1, 8, 1),
(1, 12, 1),
(1, 19, 1),
(1, 20, 1),
(2, 8, 1),
(2, 12, 1),
(3, 4, 1),
(3, 8, 1),
(3, 12, 1),
(3, 13, 1),
(3, 17, 1),
(3, 21, 1),
(3, 22, 1),
(3, 23, 1),
(4, 1, 1),
(4, 4, 1),
(4, 5, 1),
(4, 9, 1),
(4, 12, 1),
(4, 14, 1),
(4, 16, 1),
(4, 19, 1),
(4, 20, 1),
(4, 21, 1),
(4, 23, 1),
(5, 9, 1),
(5, 14, 1),
(5, 23, 14),
(6, 1, 1),
(6, 4, 1),
(6, 5, 1),
(6, 12, 1),
(6, 16, 1),
(6, 19, 1),
(6, 20, 1),
(6, 21, 1),
(6, 23, 1);



-- Remplissage de la table TypeConsommable
INSERT INTO TypeConsommable (nom, description, unite)
VALUES ('Seringue 20 mL', 'Seringue à usage unique pour faire des prélèvements de liquide.', 'Unité'),
('Acide sulfurique à 80 %', 'Acide sulfurique hautement concentré. A diluer avant d''utiliser.', 'mL'),
('Eau oxygénée', '', 'mL'),
('Diiode à 15 %', 'Solution de diiode (I2) dosée à 15 %.', 'mL'),
('Diiode à 0,02N', 'Solution de diiode (I2) dosée à 0,02N.', 'mL'),
('Thiosulfate de sodium à 0,01N', 'Solution de Thiosulfate de sodium (Na2S2O3) dosée à 0,01N.', 'mL'),
('Acide sulfurique à 1/3', 'Solution d''acide sulfurique très concentrée, à 1/3.', 'mL'),
('Soude à 1M', 'Solution de soude (NaOH) dosée à 1M.', 'mL'),
('Empois d''amidon à 1%', 'Solution d''empois d''amidon à 1%.', 'mL'),
('Solution de pipéridine', 'Solution de pipéridine (C5H11N) 10 %.', 'mL'),
('Solution nitroprussiate de sodium', 'Solution nitroprussiate de sodium à 0,4 %.', 'mL'),
('Charbon actif', 'Charbon actif.', 'g'),
('Acide chlorhydrique', 'Acide chlorhydrique (HCl) à 25 %.', 'mL'),
('Acide acétique à 30 %', NULL, 'mL'),
('Métavanadate d''ammonium (NH4VO3)', NULL, 'g'),
('Acétate de sodium (NaCH3COO) à 27 %', NULL, 'mL'),
('Chlorure d''ammonium (NH4Cl)', NULL, 'g'),
('Acide tartrique (H2T) à 5 g.L-1', NULL, 'mL');



-- Remplissage de la table StockConsommable
INSERT INTO StockConsommable (typeConsommable_id, numeroLot, quantiteAchetee, quantiteRestante, datePeremption)
VALUES (1, '4219-AXDSZ45', 20, 12, '2013-02-14'),
(2, '12554-20100806-AABD', 20000, 18040, '2014-09-29'),
(4, '2012-11-18', 1000, 1000, '2013-11-18'),
(4, '2012-04-21', 1000, 25, '2013-04-21'),
(5, '317-548-125-45-CE', 150, 100, '2013-05-30'),
(7, '12554-50786806-HRTD', 750, 740, '2012-10-03'),
(10, '54654fd645dvcd4', 60, 60, '2013-03-13'),
(11, '5456fgsg456-g5r6-0', 50, 50, '2013-04-10'),
(12, 'DEFHJ45', 3000, 2540, '2015-03-25'),
(13, '4514-52-95461-51', 5000, 3200, '2017-02-28');



-- Remplissage de la table Consomme
INSERT INTO Consomme (typeAnalyse_id, typeConsommable_id)
VALUES (4, 1),
(5, 1),
(4, 3),
(5, 3),
(6, 3),
(1, 5),
(2, 5),
(1, 7),
(2, 7),
(4, 7),
(6, 7),
(2, 8),
(3, 8),
(4, 8),
(6, 8),
(1, 9),
(2, 9),
(4, 9),
(5, 9),
(6, 9),
(4, 13),
(5, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(4, 17),
(6, 17),
(3, 18);



-- Remplissage de la table Ville
INSERT INTO Ville (nom, codePostal)
VALUES ('Orsay', 91400),
('Palaiseau', 91300),
('Paris', 75000),
('Livry-Gargan', 93190),
('Laon', 02000),
('Saint-Martin les Béziers', 84250),
('Montcuq', 46800);



-- Remplissage de la table Client
INSERT INTO Client (nom, prenom, adresse, ville_id, telephone, email)
VALUES ('Cayla', 'Bertrand', '24 allée Lucien Michard', 4, '06.65.09.51.51', 'b.cayla@hotmail.com'),
('Albin', 'Bernardo', '77 avenue du Chandelier à trois bras', 5, '06.10.56.32.09', 'bernardo.albin@email.com'),
('Lamotte', 'Martine', '111 allée des Lillas', 3, '01.44.40.02.75', 'm.lamotte@outlook.fr'),
('Dupin', 'Baptiste', '56 impasse des Acrobates de cirque', 2, '03.25.10.42.25', 'baptiste_dupin@icloud.com'),
('Chilibou', 'Delphine', '4 Boulevard Marc Trapèze', 1, '01.56.33.99.11', 'delphine-chilibou@live.com'),
('Les Petits Poneys', NULL, '74 chemin des Landes', 5, '01.55.36.95.13', 'entreprise.poney@mailpro.com'),
('Hopital de Paris', NULL, '45 avenue de Pontoise', 3, '01.43.23.65.02', 'hopital_paris@free.fr'),
('Police Nationale', NULL, '17 rue de la Gendarmerie', 2, '01.99.17.21.20', 'police.nationale@hadopi.gouv'),
('Tibou', 'Monique', '2 rue de la Gendarmerie', 2, '01.22.56.35.42', 'monique-tibou@wanadoo.fr'),
('Auchan', NULL, '45 boulevard de Galapagos', 4, '08.43.33.33.33', 'auchan@auchan.com'),
('Leclerc', NULL, '68 rue de la Martinique', 3, '01.25.99.99.99', 'Leclerc@delune.com'),
('Hollande', 'François', '55 rue du Faubourg-Saint-Honoré ', 3, '01.02.36.48.75', 'president@elysee.fr'),
('Cabrel', 'Francis', '44 route de la cabane au fond du jardin', 5, '01.75.65.44.23', 'francis.cabrel@jaimelaguitare.com'),
('Maison du médicament', NULL, '235 boulevard Saint Antoine', 1, '01.72.63.58.32', 'maison_du_medicament@orange.fr'),
('David', 'Jean-Louis', '35 avenue de la Coupe', 3, '01.23.56.85.20', 'loulou.david@coupeaubol.com');



-- Remplissage de la table Employe
INSERT INTO Employe (nom, prenom, adresse, ville_id, telephone, email)
VALUES ('Bonnot', 'Nicolas', '11 avenue des Jambons', 1, '01.50.98.66.02', 'bonnit.bonnot@gmail.com'),
('Martin', 'Martin', '5 rue des Cerises', 1, '06.48.09.71.22', 'double_martin@gal.com'),
('Anemark', 'Sylvi-Aude', '48 boulevard Jean Claude Duss', 4, '02.11.02.02.50', 'cestcool@hotmail.fr'),
('Bonnot', 'Jean', '215 avenue Mouton', 2, '03.44.14.42.36', 'lefreredebonnot@gmail.fr'),
('Chanel', 'Coco', '9 rue du Bonheur', 3, '01.48.10.88.09', 'noix-de-coco@me.com'),
('Pérais', 'Kévin', '12 avenue Tictac', 4, '01.45.10.23.99', 'kevin_perais@linux.fr'),
('Roseau', 'Faustine', '66 rue du Bois', 1, '04.91.05.17.33', 'faustine.roseau@outlook.fr');



-- Remplissage de la table Analyse
INSERT INTO Analyse (typeAnalyse_id, client_id, `date`)
VALUES (1, 11, '2001-01-12'),
(1, 11, '2001-01-12'),
(4, 5, '2001-01-12'),
(5, 5, '2001-01-12'),
(6, 5, '2001-01-12'),
(3, 8, '2001-01-12'),
(2, 12, '2001-01-12'),
(1, 11, '2001-01-12'),
(1, 7, '2001-01-12');



-- Remplissage de la table Realise
INSERT INTO Realise (analyse_id, employe_id)
VALUES (6, 1),
(3, 2),
(5, 2),
(3, 3),
(4, 3),
(5, 3),
(7, 4),
(1, 5),
(2, 5),
(8, 5),
(9, 5),
(6, 7);



-- Remplissage de la table Realise
INSERT INTO Resultat (analyse_id, typeResultat_id, resultat)
VALUES (1, 1, 12.30),
(2, 1, 16.25),
(3, 4, 12.50),
(3, 5, 27.40),
(3, 6, 32.1),
(3, 7, 28),
(5, 8, 12.5),
(5, 9, 27.40),
(5, 10, 32.1),
(5, 11, 28.0),
(6, 3, 42.265),
(7, 2, 19.250),
(8, 1, 4.50),
(9, 1, 7.10);


