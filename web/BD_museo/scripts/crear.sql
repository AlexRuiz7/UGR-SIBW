CREATE DATABASE museo;
USE museo;

CREATE TABLE		Obra
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	fechaobra VARCHAR(5) NOT NULL,
	fechapublicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
	fechamodificacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 	description TEXT NOT NULL,
	titulo VARCHAR(30) NOT NULL,
	autor VARCHAR(50) NOT NULL,
 	imagen VARCHAR(100) NOT NULL,
	vermas VARCHAR(120)
);


CREATE TABLE		Comentario
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	obraref INT NOT NULL,
	fechapublicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
	ip VARCHAR(16) NOT NULL,
 	nombreusuario VARCHAR(60) NOT NULL,
	email VARCHAR(80) NOT NULL,
 	comentario TEXT NOT NULL,
	FOREIGN KEY (obraref) REFERENCES Obra(id)
);


CREATE TABLE		PalabrasMalsonantes
(
	palabra VARCHAR(20) PRIMARY KEY
);


CREATE TABLE		DatosWeb
(
	nombreDato VARCHAR(60) PRIMARY KEY,
	valorDato  VARCHAR(120) NOT NULL
);


CREATE TABLE		Coleccion
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	tituloColeccion	VARCHAR(50) NOT NULL, 
	descripcion VARCHAR(250) NOT NULL
);


CREATE TABLE		EnColeccion
(
	idColeccion INT	NOT NULL,
	idObra INT NOT NULL,
	FOREIGN KEY (idColeccion) REFERENCES Coleccion(id),
	FOREIGN KEY (idObra) REFERENCES Obra(id)
);
	
