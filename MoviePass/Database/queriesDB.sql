USE moviepass;

#CREACION DE TABLAS

CREATE TABLE Countries(
    countryId INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    CONSTRAINT pk_countryId PRIMARY KEY(countryId)
);

CREATE TABLE Provinces(
    provinceId INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    countryId INT,
    CONSTRAINT pk_provinceId PRIMARY KEY(provinceId),
    CONSTRAINT fk_countryId FOREIGN KEY(countryId) REFERENCES Countries(countryId) ON DELETE CASCADE
);

CREATE TABLE Cities(
    zipCodes INT NOT NULL,
    name VARCHAR(30) NOT NULL,
    provinceId INT,
    CONSTRAINT pk_zipCode PRIMARY KEY(zipCode),
    CONSTRAINT fk_provinceId FOREIGN KEY(provinceId) REFERENCES Provinces(provinceId) ON DELETE CASCADE
);

CREATE TABLE Adresses(
    adressId INT NOT NULL AUTO_INCREMENT,
    street VARCHAR(30) NOT NULL,
    number INT NOT NULL,
    floor INT,
    zipCode INT,
    CONSTRAINT pk_adressId PRIMARY KEY(adressId),
    CONSTRAINT fk_zipCode FOREIGN KEY(zipCode) REFERENCES Cities(zipCode) ON DELETE CASCADE
);

CREATE TABLE Theatres(
    theatreID INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(30), 
    email VARCHAR(30), 
    phoneNumber VARCHAR(15), 
    adressId INT,
    active BOOLEAN, 
    CONSTRAINT pk_theatreId PRIMARY KEY(theatreId),
    CONSTRAINT fk_adressId FOREIGN KEY(adressId) REFERENCES adresses(adressId) ON DELETE CASCADE
);

CREATE TABLE Cinemas(
    cinemaId INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(30), 
    price INT, 
    capacity INT,
    type VARCHAR(5),
    CONSTRAINT pk_cinemaId PRIMARY KEY(cinemaId) ON DELETE CASCADE
);

CREATE TABLE Billboard(
    billboardId INT NOT NULL AUTO_INCREMENT,
    startDate date NOT NULL,
    endDate date NOT NULL,
    active BOOLEAN NOT NULL,
    CONSTRAINT pk_billboardId PRIMARY KEY(billboardId)
);

CREATE TABLE carteleraXfuncion(
    billboardId INT,
    showtimeId INT,
    CONSTRAINT fk_billboardId FOREIGN KEY(billboardId) REFERENCES Billboard(billboardId) ON DELETE CASCADE,
    CONSTRAINT fk_showtimeId FOREIGN KEY(showtimeId) REFERENCES Showtimes(showtimeId) ON DELETE CASCADE
);

CREATE TABLE Showtimes(
    showtimeId INT NOT NULL AUTO_INCREMENT,
    startTime VARCHAR(30) NOT NULL,
    endTime VARCHAR(30) NOT NULL,
    movieId INT,
    active BOOLEAN,
    CONSTRAINT pk_showtimeId PRIMARY KEY(showtimeId) ON DELETE CASCADE
);

CREATE TABLE showtimesXcinemas(
    showtimeId INT,
    cinemaId INT,
    CONSTRAINT fk_showtimeId FOREIGN KEY(showtimeId) REFERENCES Cinemas(showtimeId),
    CONSTRAINT fk_showtimeId FOREIGN KEY(showtimeId) REFERENCES Showtimes(showtimeId)
);

CREATE TABLE cinemasXtheatres(
    cinemaId INT,
    theatreId INT,
    CONSTRAINT pk_cinemaId FOREIGN KEY(cinemaId) REFERENCES cinemas(cinemaId),
    CONSTRAINT pk_theatreId FOREIGN KEY(theatreId) REFERENCES thatres(theatreId)
);

CREATE TABLE members(
    idMember INT NOT NULL AUTO_INCREMENT,
    DNI INT NOT NULL,
    email varchar(30) NOT NULL,
    password varchar(30) NOT NULL,
    firstName varchar(30) NOT NULL,
    lastName varchar(30) NOT NULL,
    creditCardNumber INT,
    CONSTRAINT pk_idMember PRIMARY KEY(idMember)
);



#########OTRAS QUERIES#########

#AGREGANDO PAIES
INSERT INTO COUNTRIES(NAME) VALUES('Argentina'),('Brasil'),('Chile'),('Uruguay');

#AGREGANDO PROVINCIAS
INSERT INTO Provinces(name, countryId) VALUES('Buenos Aires',1),
                                                            ('Santa Fe',1),
                                                            ('Cordoba',1),
                                                            ('Paysandu',4),
                                                            ('Salta',1),
                                                            ('Valdivia',3),
                                                            ('San Felipe',3),
                                                            ('Santa Catarina',2),
                                                            ('Rio Grande del Sur',2);

#AGREGANDO CIUDADES
INSERT INTO Cities(zipCode, name, provinceId) VALUES(7600,'Mar del Plata',1),
                                                                            (1016,'Ciudad Autonoma de Buenos Aires',1),
                                                                            (4555,'Santa Fe',2),
                                                                            (5468,'Caros Paz',3);