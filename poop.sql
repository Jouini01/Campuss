CREATE TABLE Chambre (
  idChambre VARCHAR(16) NOT NULL,
  batiment VARCHAR(8) NOT NULL,
  etage INT(2) NOT NULL,
  PRIMARY KEY(idChambre)

);

CREATE TABLE Client(
  idClient int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY ,
  nom varchar(64) NOT NULL,
  prenom varchar(64) NOT NULL,
  adresse varchar(255) NOT NULL,
  codePostal int(10) NOT NULL,
  ville varchar(64) NOT NULL,
  pays varchar(64) NOT NULL,
  email varchar(64) NOT NULL,
  telephone varchar(64) NOT NULL,
  portable varchar(64) NOT NULL,
  categorie varchar(64) NOT NULL
);

CREATE TABLE Badge (
  idBadge int(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY ,
  UIDBadge varchar(16) NOT NULL,
  idClient int(11) NOT NULL,
  idChambre VARCHAR(16) NOT NULL,
  droits enum('admin','client','professeur','eleve') NOT NULL,
  dateEtHeureEntree datetime NOT NULL,
  dateEtHeureSortie datetime NOT NULL,

FOREIGN KEY (idChambre) REFERENCES Chambre(idChambre),
FOREIGN KEY (idClient) REFERENCES Client (idClient)


);

 
CREATE TABLE Reservation (
  idChambre VARCHAR(16) NOT NULL PRIMARY KEY,
  idClient int(11) NOT NULL,
  nbPersonne int(2) NOT NULL,
  etat enum('valide','en cours','relance','non payee') NOT NULL,
  nuitee int(2) NOT NULL,
  dateDebutReservation date NOT NULL,
  dateFinReservation date NOT NULL,
  modePaiement enum('ESP','CHQ','CB','Autre') NOT NULL,
  datePaiement date NOT NULL,
FOREIGN KEY (idClient) REFERENCES Client (idClient)

);

CREATE TABLE Occupation (
  idChambre VARCHAR(16) NOT NULL   PRIMARY KEY,
  idClient INT(11) NOT NULL,
  presence tinyint(1) NOT NULL,
  debutOccupation date NOT NULL,
  finOccupation date NOT NULL,
FOREIGN KEY (idChambre) REFERENCES Chambre(idChambre),
FOREIGN KEY (idClient) REFERENCES Client (idClient)
);

CREATE TABLE Demande (
  idDemande INT AUTO_INCREMENT PRIMARY KEY,
  idClient int(11) NOT NULL ,
  nbPersonne int(2) NOT NULL,
  nuitee int(2) NOT NULL,
  dateDebutReservation date NOT NULL,
  dateFinReservation date NOT NULL,
  FOREIGN KEY (idClient) REFERENCES Client (idClient)

);

INSERT INTO Chambre VALUES ('105','C',1),('106','C',1),('110','C',1);
