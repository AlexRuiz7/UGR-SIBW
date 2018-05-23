/* Tipos de usuarios codificados por un atributo de tipo entero que define sus
	privilegios:
	
		* 0: "Anónimo"				-- sin privilegios
		* 1: "Usuario registrado"	-- escribir comentarios, cambiar sus datos
		* 2: "Moderador"			-- editar/borrar comentarios
		* 3: "Gestor"				-- editar/borrar/añadir obras
		* 4: "Superusuario"			-- todos
*/


INSERT INTO       Usuarios 
(nombre_usuario, email, password, privilegios) 

VALUES
("Admin", "admin@dominio.com", "admin", 4) ,
("Usuario", "usuario@dominio.com", "1234", 3) ,
("Moderador", "moderador@dominio.com", "1234", 2) ,
("Gestor", "gestor@dominio.com", "1234", 1) ,
("Anonimo", "anonimo@dominio.com", "1234", 0);