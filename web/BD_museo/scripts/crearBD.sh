#! /bin/bash

mysql -u usuario < crear.sql
mysql -u usuario museo < insertar_obras.sql
mysql -u usuario museo < insertar_comentarios.sql
mysql -u usuario museo < insertar_colecciones.sql
mysql -u usuario museo < insertar_datos_web.sql
mysql -u usuario museo < insertar_palabras_mal.sql
