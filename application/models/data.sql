create database takalo;
use takalo;
create table if not EXISTS  Admnistrateur (
    idAdmin int  primary key not null auto_increment,
    nom varchar (50),
    email varchar(50),
    psswd varchar(10)
);
create table if not EXISTS Users (
    idUser int primary key not null auto_increment,
    nom varchar (50),
    email varchar (50),
    psswd varchar(50)
);
create table if not EXISTS Categorie(
    idCategorie int primary key not null auto_increment,
    nom varchar(50)
);
create table if not EXISTS Objets (
    idObjet int PRIMARY key not null auto_increment,
    idUser int not null REFERENCES Users(idUser),
    Titre varchar(50),
    Descriptions varchar(200),
    Prix decimal (10,2),
    idCategorie int not null REFERENCES Categorie(idCategorie),
    photos varchar(100)
);
create table if not EXISTS Historique (
    idObjet int not null REFERENCES Objets (idObjet),
    idObjetnatakalo int not null REFERENCES Objets (idObjet),
    idUser int not null REFERENCES Users(idUser),
    idUser1 int not null REFERENCES Users(idUser),
    dates datetime not null    
);
create table if not EXISTS Propositions (
    idObjetako int not null REFERENCES Objets (idObjet),
    idObjetcontre int not null REFERENCES Objets (idObjet),
    idUserza int not null REFERENCES Users(idUser),
    idUseroul int not null REFERENCES Users(idUser),
    idprop INT PRIMARY KEY AUTO_INCREMENT
);
-----admin------
insert into Admnistrateur values (null,'admin','admin@gmail.com','admin01');
-----Users------
insert into Users values (null,'Lili','lili@gmail.com','lili'),(null,'Herve','herve@gmail.com','herve'),(null,'Elisa','elisa@gmail.com','elisa'),(null,'Andre','andre@gmail.com','andre'),(null,'Rakoto','rakoto@gmail.com','rakoto');
----CAtegorie----
insert into Categorie values(null,'Vetements'),(null,'Chaussures'),(null,'Technologie'),(null,'Livres');
------Objets-----
insert into Objets values (null,1,'telephone','Rom(16go),Ram(2g),marque=LG',1000000,3,'3.jpg'), (null,2,'tee-shirt','taille:S,couleur:intact,marque:nike',5000,1,'3.jpg'), (null,3,'escarpin','couleur:intact,marque:dior,pt:36',60000,2,'3.jpg'), (null,1,'Livre','edition:1990,ecrivain:jeanLuke',25000,4,'3.jpg');
-----Historiques------


create view getmyobject as (select*from propositions join objets on propositions.idObjetako=Objets.idObjet);
create view getmyobwithother as(select idObjetako,idObjetcontre,idUserza,idUseroul,objets.idObjet,getmyobject.idUser,getmyobject.Titre,getmyobject.Descriptions,getmyobject.Prix,getmyobject.idCategorie,getmyobject.photos,objets.Descriptions,objets.Prix,objets.idCategorie,objets.photos from getmyobject join objets on getmyobject.idObjetcontre=Objets.idObjet);