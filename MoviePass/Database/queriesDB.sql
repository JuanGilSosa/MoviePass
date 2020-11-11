USE moviepass;

#CREACION DE TABLAS

CREATE TABLE if not exists Countries(
    countryId INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30),
    CONSTRAINT pk_countryId PRIMARY KEY(countryId)
);

CREATE TABLE if not exists  Provinces(
    provinceId INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    countryId INT,
    CONSTRAINT pk_provinceId PRIMARY KEY(provinceId),
    CONSTRAINT fk_countryId FOREIGN KEY(countryId) REFERENCES Countries(countryId) ON DELETE CASCADE
);

CREATE TABLE if not exists  Cities(
    zipCode INT NOT NULL,
    name VARCHAR(30) NOT NULL,
    provinceId INT,
    CONSTRAINT pk_zipCode PRIMARY KEY(zipCode),
    CONSTRAINT fk_provinceId FOREIGN KEY(provinceId) REFERENCES Provinces(provinceId) ON DELETE CASCADE
);

CREATE TABLE if not exists  Adresses(
    adressId INT NOT NULL AUTO_INCREMENT,
    street VARCHAR(30) NOT NULL,
    number INT NOT NULL,
    floor INT,
    zipCode INT,
    CONSTRAINT pk_adressId PRIMARY KEY(adressId),
    CONSTRAINT fk_zipCode FOREIGN KEY(zipCode) REFERENCES Cities(zipCode) ON DELETE CASCADE
);

CREATE TABLE if not exists  Theatres(
    theatreID INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(30), 
    email VARCHAR(30), 
    phoneNumber VARCHAR(15), 
    adressId INT,
    active BOOLEAN, 
    CONSTRAINT pk_theatreId PRIMARY KEY(theatreId),
    CONSTRAINT fk_adressId FOREIGN KEY(adressId) REFERENCES adresses(adressId) ON DELETE CASCADE
);

CREATE TABLE if not exists  Cinemas(
    cinemaId INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(30), 
    price INT, 
    capacity INT,
    type VARCHAR(5),
    active BOOLEAN,
    CONSTRAINT pk_cinemaId PRIMARY KEY(cinemaId)
);

CREATE TABLE if not exists  Showtimes(
    showtimeId INT NOT NULL AUTO_INCREMENT,
    startTime VARCHAR(30) NOT NULL,
    endTime VARCHAR(30) NOT NULL,
    movieId INT,
    releaseDate date,
    active BOOLEAN,
    CONSTRAINT pk_showtimeId PRIMARY KEY(showtimeId)
);

CREATE TABLE if not exists showtimesXcinemas(
    showtimeId INT,
    cinemaId INT,
    CONSTRAINT fk_showtimeId FOREIGN KEY(showtimeId) REFERENCES Showtimes(showtimeId),
    CONSTRAINT fk_cinemaId FOREIGN KEY(cinemaId) REFERENCES Cinemas(cinemaId)
);

CREATE TABLE if not exists cinemasXtheatres(
    cinemaId INT,
    theatreId INT,
    CONSTRAINT pk_cinemaId FOREIGN KEY(cinemaId) REFERENCES cinemas(cinemaId),
    CONSTRAINT pk_theatreId FOREIGN KEY(theatreId) REFERENCES theatres(theatreId)
);

CREATE TABLE if not exists  movies(
    movieId INT NOT NULL,
    poster_path varchar(100) NOT NULL,
    backdrop_path varchar(100) NOT NULL,
    adult boolean NOT NULL,
    original_language varchar(2) NOT NULL,
    title varchar(100) NOT NULL,
    vote_average INT not null,
    overview text not null,
    release_date date not null,
    active boolean not null,
    CONSTRAINT pk_movieId PRIMARY KEY(movieId)
);

CREATE TABLE if not exists genres(
    genreId INT NOT NULL,
    genre varchar(50) NOT NULL,
    CONSTRAINT pk_genreId PRIMARY KEY (genreId)
);

CREATE TABLE if not exists genreXmovies(
    movieId INT,
    genreId INT,
    CONSTRAINT pk_movieId FOREIGN KEY(movieId) REFERENCES movies(movieId),
    CONSTRAINT pk_genreId FOREIGN KEY(genreId) REFERENCES genres(genreId)
);

CREATE TABLE if not exists  members(
    idMember INT NOT NULL AUTO_INCREMENT,
    DNI INT NOT NULL,
    email varchar(30) NOT NULL,
    password varchar(30) NOT NULL,
    firstName varchar(30) NOT NULL,
    lastName varchar(30) NOT NULL,
    creditCardNumber INT,
    CONSTRAINT pk_idMember PRIMARY KEY(idMember)
);

CREATE TABLE if not exists Tickets(
    numberTicket INT NOT NULL AUTO_INCREMENT,
    showtimeId INT,
    numbersOfTickets INT,
    CONSTRAINT pk_numberTicket PRIMARY KEY(numberTicket),
    CONSTRAINT fk_showTimeId_ FOREIGN KEY(showtimeId) REFERENCES Showtimes(showtimeId)
);

CREATE TABLE if not exists ticketsXshowtimes(
    numberTicket INT,
    showtimeId INT,
    CONSTRAINT pk_numberTicket FOREIGN KEY(numberTicket) REFERENCES Tickets(numberTicket),
    CONSTRAINT fk_showTimeId__ FOREIGN KEY(showtimeId) REFERENCES Showtimes(showtimeId) 
);

CREATE TABLE ticketXmember(
    idMember INT,
    numberTicket INT,
    CONSTRAINT fk_idMember FOREIGn KEY(idMember) REFERENCES members(idMember),
    CONSTRAINT fk_numberTicket FOREIGN KEY(numberTicket) REFERENCES Tickets(numberTicket)
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
                                                    (1016,'CABA',1),
                                                    (4555,'Santa Fe',2),
                                                    (5468,'Carlos Paz',3);

#AGREGANDO GENEROS
INSERT INTO genres(genreId, genre) VALUES(28,'Action'),
                                         (12,'Adventure'),
                                         (16,'Animation'),
                                         (35,'Comedy'),
                                         (80,'Crime'),
                                         (99,'Documentary'),
                                         (18,'Drama'),
                                         (10751,'Family'),
                                         (14,'Fantasy'),
                                         (36,'History'),
                                         (53,'Thriller'),
                                         (27,'Horror'),
                                         (10402,'Music'),
                                         (9648,'Mystery'),
                                         (10749,'Romance'),
                                         (878,'Science Fiction'),
                                         (10770,'TV Movie'),
                                         (10752,'War'),
                                         (37,'Western');