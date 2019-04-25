--
-- CREACIÓN DE BASE DE DATOS
--
CREATE DATABASE SIBW CHARACTER SET utf8 COLLATE utf8_general_ci;
USE SIBW;

--
-- CREACIÓN DE TABLAS
--
CREATE TABLE Palabras_Prohibidas (
  palabra VARCHAR(15),
  PRIMARY KEY (palabra)
);


CREATE TABLE Datos_Web (
  campo VARCHAR(15),
  valor VARCHAR(50),
  PRIMARY KEY(campo)
);


CREATE TABLE Usuarios (
  email           VARCHAR(25),
  nombre          VARCHAR(20) NOT NULL,
  contraseña      VARCHAR(20) NOT NULL,
  fecha_registro  DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (email)
);


CREATE TABLE Noticias (
  id        INT AUTO_INCREMENT,
  titular   VARCHAR(50),
  texto     VARCHAR(500),
  fecha     DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);


CREATE TABLE Imagenes (
  url VARCHAR(50),
  PRIMARY KEY (url)
);


CREATE TABLE Etiquetas (
  tema VARCHAR(15),
  PRIMARY KEY (tema)
);


--
-- CREACIÓN DE RELACIONES
--
CREATE TABLE Comentarios (
  fecha           DATETIME DEFAULT CURRENT_TIMESTAMP,
  ip              VARCHAR(15)  NOT NULL,
  texto           VARCHAR(140) NOT NULL,
  email_usuario   VARCHAR(25),
  id_noticia      INT,
  PRIMARY KEY (email_usuario, id_noticia, ip, fecha),
  FOREIGN KEY (email_usuario) REFERENCES Usuarios(email),
  FOREIGN KEY (id_noticia)    REFERENCES Noticias(id)
);


CREATE TABLE EtiquetasEnNoticia (
  id_noticia  INT AUTO_INCREMENT,
  tema        VARCHAR(15),
  PRIMARY KEY (id_noticia, tema),
  FOREIGN KEY (id_noticia) REFERENCES Noticias(id),
  FOREIGN KEY (tema)       REFERENCES Etiquetas(tema)
);


CREATE TABLE ImagenesEnNoticia (
  id_noticia  INT AUTO_INCREMENT,
  url         VARCHAR(50),
  PRIMARY KEY (id_noticia, url),
  FOREIGN KEY (id_noticia) REFERENCES Noticias(id),
  FOREIGN KEY (url)        REFERENCES Imagenes(url)
)
