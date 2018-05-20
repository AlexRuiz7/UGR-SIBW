CREATE DATABASE museo CHARACTER SET utf8 COLLATE utf8_general_ci;
USE museo;


CREATE TABLE		Obra
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	fechaobra VARCHAR(5) NOT NULL,
	fechapublicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
	fechamodificacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 	descripcion TEXT NOT NULL,
	titulo VARCHAR(30) NOT NULL,
	autor VARCHAR(50) NOT NULL,
 	imagen VARCHAR(100) NOT NULL,
	vermas VARCHAR(120)
);


CREATE TABLE		Comentario
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	obraref INT NOT NULL,
	fechapublicacion VARCHAR(20) NOT NULL,
	ip VARCHAR(16) NOT NULL,
 	usuario VARCHAR(60) NOT NULL,
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


CREATE TABLE        Usuarios
(
	fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
 	nombre_usuario VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL,
	password VARCHAR(10) NOT NULL,
	privilegios INT NOT NULL DEFAULT 0,
	PRIMARY KEY (nombre_usuario)
);

/* Tipos de usuarios codificados por un atributo de tipo entero que define sus
	privilegios:
	
		* 0: "Anónimo"				-- sin privilegios
		* 1: "Usuario registrado"	-- escribir comentarios, cambiar sus datos
		* 2: "Moderador"			-- editar/borrar comentarios
		* 3: "Gestor"				-- editar/borrar/añadir obras
		* 4: "Superusuario"			-- todos
*/

-- Crea el usuario por defecto "Superusuario"
insert into Usuarios (nombre_usuario, email, password, privilegios) 
values ("Admin", "admin@dominio.com", "admin", 4);
