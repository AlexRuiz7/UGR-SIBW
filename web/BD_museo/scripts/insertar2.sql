INSERT INTO		Comentario
  (obraref, fechapublicacion, ip, username, email, comment)

  VALUES 
  (
    1, '2018-01-24 15:30', "192.168.1.1", "Manolo37", "manolo37@dominio.com",
    "Me encanta esta obra, me recuerda mucho a mi hermana."
  ),
  (
    1, '2018-01-24 18:42', "192.168.1.8", "Paquito42", "paquito42@dominio.com",
    "Es verdad, conozco a tu hermana, y se parece mucho.
     Un saludo, Manolo."
  ),
  (
    2, '2017-12-25 07:21', "192.168.6.66", "JoseAmbrosio54", "joseambrosio54@dominio.com",
    "Soy muy religioso y esta imagen me ofende gravemente.
     Por favor, quemen el cuadro."
  ),
  (
    3, '2018-2-14 19:45', "192.168.2.35", "Artista33", "artista33@dominio.com",
    "Se percibe muy bien el intento del autor por transmitir
     todo eso que quiere transmitirnos...
     Me gusta."
  ),
 (
    4, '2018-4-12 12:15', "192.168.2.91", "Extraviado17", "extraviado17@dominio.com",
    "Me gusta su peinado, favorece mucho sus ojos.
     ¿Alguien sabe quien le peina? Me gustaria que me
     peinase a mi también. ¡Gracias!"
  );


INSERT INTO 		PalabrasMalsonantes
  VALUES
("Pedo"),("Pis"),("Caca"),("Mierda"),("Puta"),("Puto"),
("Gilipollas"),("Pene"),("Picha"),("Polla"),("Teta"),
("Cabron"),("Caraculo"),("Capullo"),("Zorra"),("Perra"),
("Comechapas"),("Palurdo"),("Bocachancla"),("Cuerpoescombro"),
("Cenutrio"),("Cabezabuque"),("Caraespatula"),("Carajaula");


INSERT INTO		DatosWeb
 VALUES
("NombreMuseo","Museo de lo grotesco"),
("ImageBig","icn_big.png"),
("ImageSmall","icn_small.png"),
("ImageMedium","icn_medium.png"),
("Direccion", "Calle Desengraño 21, Madrid"),
("TelefonoFijo", "9xx xxx xxx"),
("TelefonoMovil", "6xx xxx xxx"),
("Correo", "vayase_señor_cuesta@gmail.com"),
("Facebook", "https://www.facebook.com/"),
("Instagram", "https://www.instagram.com/"),
("Twitter", "https://www.twitter.com/"),
("Navegador1", "/web_sibw/"),
("Navegador2", "#informacion");


INSERT INTO		Coleccion
  (tituloColeccion, descripcion)

  VALUES 
  (
    "Renacimiento grotesco", "Obras de la edad moderna y poco posteriores de temática sátira"
  ),
  (
    "Populares", "Las obras más populares del museo."
  );


INSERT INTO		EnColeccion

  VALUES 
  ( 1, 1), (1, 3),
  ( 2, 1), ( 2, 2), (2, 4);






