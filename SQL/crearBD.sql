--
-- CREACIÓN DE BASE DE DATOS
--
CREATE DATABASE IF NOT EXISTS SIBW CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE SIBW;

--
-- CREACIÓN DE TABLAS
--
CREATE TABLE IF NOT EXISTS Palabras_Prohibidas (
  palabra VARCHAR(15),
  PRIMARY KEY (palabra)
);


CREATE TABLE IF NOT EXISTS Datos_Web (
  campo VARCHAR(15),
  valor VARCHAR(50),
  PRIMARY KEY(campo)
);


CREATE TABLE IF NOT EXISTS Usuarios (
  email           VARCHAR(35),
  nombre          VARCHAR(30) NOT NULL,
  contraseña      VARCHAR(30) NOT NULL,
  fecha_registro  DATETIME DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (nombre),
  PRIMARY KEY (email)
);


CREATE TABLE IF NOT EXISTS Noticias (
  id        INT           AUTO_INCREMENT,
  titular   VARCHAR(80)   DEFAULT 'TITULAR',
  texto     VARCHAR(5000) DEFAULT 'TEXTO AQUÍ...',
  autor     VARCHAR(20)   DEFAULT "Escritor ó Autor",
  fecha     DATETIME      DEFAULT CURRENT_TIMESTAMP,
  visitas   INT           DEFAULT 0,
  link      VARCHAR(130),
  PRIMARY KEY (id)
);


-- CREATE TABLE IF NOT EXISTS Imagenes (
--   url VARCHAR(50),
--   PRIMARY KEY (url)
-- );
--
--
-- CREATE TABLE IF NOT EXISTS Etiquetas (
--   tema VARCHAR(15),
--   PRIMARY KEY (tema)
-- );


--
-- CREACIÓN DE RELACIONES
--
CREATE TABLE IF NOT EXISTS Comentarios (
  fecha           DATETIME DEFAULT CURRENT_TIMESTAMP,
  ip              VARCHAR(15)  NOT NULL,
  texto           VARCHAR(140) NOT NULL,
  email_usuario   VARCHAR(35),
  id_noticia      INT,
  PRIMARY KEY (email_usuario, id_noticia, ip, fecha),
  FOREIGN KEY (email_usuario) REFERENCES Usuarios(email),
  FOREIGN KEY (id_noticia)    REFERENCES Noticias(id)
);


-- CREATE TABLE IF NOT EXISTS Escritor (
--   email_escritor  VARCHAR(35) NOT NULL,
--   id_noticia      INT,
--   PRIMARY KEY (id_noticia),
--   UNIQUE (email_escritor),
--   FOREIGN KEY (id_noticia) REFERENCES Noticias(id),
--   FOREIGN KEY (email_escritor) REFERENCES Usuarios(email)
-- );


CREATE TABLE IF NOT EXISTS EtiquetasEnNoticia (
  id_noticia  INT,
  tema        VARCHAR(15),
  PRIMARY KEY (id_noticia, tema),
  FOREIGN KEY (id_noticia) REFERENCES Noticias(id)
  -- FOREIGN KEY (tema)       REFERENCES Etiquetas(tema)
);


CREATE TABLE IF NOT EXISTS ImagenesEnNoticia (
  id_noticia  INT,
  url         VARCHAR(50) DEFAULT 'placeholder.png',
  PRIMARY KEY (id_noticia, url),
  FOREIGN KEY (id_noticia) REFERENCES Noticias(id)
  -- FOREIGN KEY (url)        REFERENCES Imagenes(url)
);
