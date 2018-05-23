#! /bin/bash



mysql -u root < crear.sql

mysql -u root museo < insertar_obras.sql
mysql -u root museo < insertar_comentarios.sql

mysql -u root museo < insertar_colecciones.sql

mysql -u root museo < insertar_datos_web.sql

mysql -u root museo < insertar_palabras_mal.sql

mysql -u root museo < insertar_usuarios.sql