USE moviepass;

#CREACION DE TABLAS

CREATE TABLE Paises(
    idPais INT NOT NULL AUTO_INCREMENT,
    namePais VARCHAR(30),
    CONSTRAINT pk_idPais PRIMARY KEY(idPais)
);

CREATE TABLE Provincias(
    idProvincia INT NOT NULL AUTO_INCREMENT,
    nameProvincia VARCHAR(30) NOT NULL,
    idPais INT,
    CONSTRAINT pk_idProvincia PRIMARY KEY(idProvincia),
    CONSTRAINT fk_idPais FOREIGN KEY(idPais) REFERENCES Paises(idPais)
);

CREATE TABLE Ciudades(
    codigoPostal INT NOT NULL,
    nameCiudad VARCHAR(30) NOT NULL,
    idProvincia INT,
    CONSTRAINT pk_codigoPostal PRIMARY KEY(codigoPostal),
    CONSTRAINT fk_idProvincia FOREIGN KEY(idProvincia) REFERENCES Provincias(idProvincia)
);

CREATE TABLE Direcciones(
    idDireccion INT NOT NULL AUTO_INCREMENT,
    calle VARCHAR(30) NOT NULL,
    numero INT NOT NULL,
    piso INT,
    codigoPostal INT,
    CONSTRAINT pk_idDireccion PRIMARY KEY(idDireccion),
    CONSTRAINT fk_codigoPostal FOREIGN KEY(codigoPostal) REFERENCES Ciudades(codigoPostal)
);

CREATE TABLE Cines(
    idCine INT NOT NULL AUTO_INCREMENT, 
    nombre VARCHAR(30), 
    email VARCHAR(30), 
    numeroDeContacto VARCHAR(15), 
    idDireccion INT,
    active BOOLEAN, 
    CONSTRAINT pk_idCine PRIMARY KEY(idCine),
    CONSTRAINT fk_idDirecionn FOREIGN KEY(idDireccion) REFERENCES direcciones(idDireccion)
);

CREATE TABLE Salas(
    idSala INT NOT NULL AUTO_INCREMENT, 
    nombre VARCHAR(30), 
    precio INT, 
    capacidad INT,
    tipo VARCHAR(5),
    CONSTRAINT pk_idSala PRIMARY KEY(idSala)
);

CREATE TABLE Funciones(
    idFuncion INT NOT NULL AUTO_INCREMENT,
    horaInicio VARCHAR(30) NOT NULL,
    horaFin VARCHAR(30) NOT NULL,
    idPelicula INT,
    active BOOLEAN,
    CONSTRAINT pk_idFuncion PRIMARY KEY(idFuncion)
);

CREATE TABLE salaXfunciones(
    idSala INT,
    idFuncion INT,
    CONSTRAINT fk_idSala FOREIGN KEY(idSala) REFERENCES Salas(idSala),
    CONSTRAINT fk_idFuncion FOREIGN KEY(idFuncion) REFERENCES Funciones(idFuncion)
);

CREATE TABLE salaXcine(
    idSala INT,
    idCine INT,
    CONSTRAINT pk_idSala FOREIGN KEY(idSala) REFERENCES salas(idSala),
    CONSTRAINT pk_idCine FOREIGN KEY(idCine) REFERENCES cines(idCine)
);

CREATE TABLE members(
    idMember INT NOT NULL AUTO_INCREMENT,
    DNI INT NOT NULL,
    email varchar(30) NOT NULL,
    password varchar(30) NOT NULL,
    firstName varchar(30) NOT NULL,
    lastName varchar(30) NOT NULL,
    numeroTarjetaDeCredito INT,
    CONSTRAINT pk_idMember PRIMARY KEY(idMember)
);

#########OTRAS QUERIES#########

#AGREGANDO PAIES
INSERT INTO Paises(namePais) VALUES('Argentina'),('Brasil'),('Chile'),('Uruguay');

#AGREGANDO PROVINCIAS
INSERT INTO Provincias(nameProvincia, idPais) VALUES('Buenos Aires',1),
                                                            ('Santa Fe',1),
                                                            ('Cordoba',1),
                                                            ('Paysandu',4),
                                                            ('Salta',1),
                                                            ('Valdivia',3),
                                                            ('San Felipe',3),
                                                            ('Santa Catarina',2),
                                                            ('Rio Grande del Sur',2);

#AGREGANDO CIUDADES
INSERT INTO Ciudades(codigoPostal, nameCiudad, idProvincia) VALUES(7600,'Mar del Plata',1),
                                                                            (1016,'Ciudad Autonoma de Buenos Aires',1),
                                                                            (4555,'Santa Fe',2),
                                                                            (5468,'Caros Paz',3);