--
-- INSERCIÓN DE DATOS
--
USE SIBW;

--
INSERT IGNORE INTO Palabras_Prohibidas VALUES
  ('comechapas'), ('palurdo'), ('bocachancla'), ('cuerpoescombro'),
  ('cenutrio'), ('cabezabuque'), ('caraespatula'), ('carajaula'), ('puto'),
  ('puta'), ('mierda'), ('cabron')
;

--
INSERT IGNORE INTO Datos_Web (campo, valor) VALUES
  ('titulo'   , 'Informaniákos'                 ),
  ('direccion', 'Calle Desengaño, 21, Madrid'   ),
  ('telefono' , '9xx xxx xxx, 6xx xxx xxx'      ),
  ('email'    , 'vayase_señor_cuesta@gmail.com' ),
  ('mapa'     , 'media/imgs/madrid-map.gif'     ),
  ('logo'     , 'media/imgs/logo.png'           ),
  ('fb'       , 'media/icons/fb_ico.png'        ),
  ('tw'       , 'media/icons/tw_ico.png'        ),
  ('ig'       , 'media/icons/ig_ico.png'        ),
  ('print'    , 'media/icons/print_ico.png'     )
;

--
INSERT IGNORE INTO Usuarios (email, nombre, contraseña) VALUES
  ('cuenta_falsa_1@dominio.com',  'Juan Cuesta'   , 'junta_urgente'           ),
  ('cuenta_falsa_2@dominio.com',  'Emilio Delgado', 'un_poquito_de_por_favor' ),
  ('cuenta_falsa_3@dominio.com',  'Paloma Cuesta' , 'puff'                    )
;

--
INSERT IGNORE INTO Noticias (titular, texto) VALUES
  ('NVIDIA lleva el Ray Tracing a sus tarjetas gráficas GTX',
    'NVIDIA anunció a finales de 2018 sus tarjetas gráficas RTX, donde además
    de estrenar la arquitectura Turing de 12 nm y mejorar el rendimiento,
    incluían RT Cores y compatibilidad con Ray Tracing para una iluminación y
    reflejos más realistas en los videojuegos compatibles. Ahora, El Ray
    Tracing va a llegar a las tarjetas GTX que la compañía ya tenía en el
    mercado de la generación anterior.

    Entre estas tarjetas gráficas encontramos todas las de la serie GTX a
    partir de la 1060 de 6 GB. El cambio a RTX tenía que ver con la llegada del
    Ray Tracing, dejando de lado la gama GTX para las tarjetas no compatibles,
    pero finalmente la diferencia pareceser que será solo a nivel de hardware.

    Y es que, si NVIDIA quiere que haya un soporte más amplio por parte de los
    juegos para Ray Tracing, tiene que abrirlo a más tarjetas gráficas. Este es
    el motivo por el que han decidido llevar a la gama GTX un soporte algo más
    básico de Ray Tracing que el que ofrecen en las RTX.

    Así, ahora mismo encontramos dos gamas que soportarán DXR, o DirectX
    Raytracing, la API de DirectX 12. Esta API, teóricamente, hacía compatible
    con el trazado de rayos a cualquier tarjeta gráfica compatible con DirectX
    12.

    La gama más básica contará con efectos básicos de Ray Tracing, y un conteo
    bajo de rayos. Entre ellas encontramos la Titan XP, Titan X, GTX 1080 Ti,
    GTX 1080, GTX 1070 Ti, GTX 1070, GTX 1060 6GB (el de 3 GB no), así como las
    nuevas GTX 1660 Ti y GTX 1660.

    En cuanto al soporte completo de efectos de Ray Tracing y un conteo alto de
    rayos, encontramos el mismo soporte actual de la Titan RTX, RTX 2080 Ti,
    RTX 2080, RTX 2070 y RTX 2060.

    La compatibilidad llegará a estas tarjetas gráficas mediante un nuevo
    driver GeForce el próximo mes de abril, donde nuestros compañeros de
    HardZone recogerán las novedades al respecto, así como realizarán pruebas
    de este nuevo modo. Los desarrolladores no tendrán que hacer nada para que
    estas tarjetas sean compatibles. Si el juego ya soporta Ray Tracing, la
    tarjeta gráfica GTX ya podrá hacer uso de las funcionalidades que tenga
    compatibles.

    Esta apuesta de NVIDIA es muy interesante, teniendo en cuenta que hasta
    ahora se creía que eran necesarios tener núcleos específicos para hacer los
    cálculos relacionados con el Ray Tracing, y eso que incluso con ellos el
    rendimiento del juego cae a la mitad. Con GTX se creía que el rendimiento
    se quedaría por los suelos, así que habrá que ver cómo afecta esta
    implementación, e incluso si usar estos rayos en “calidad baja” es
    suficiente como para no tener que activar la implementación completa.

    Lo que no será compatible con las GTX será DLSS, o Deep Learning Super
    Sampling, donde la tarjeta gráfica usa los Tensor Cores para reescalar la
    imagen y mejorarla sin que el rendimiento se vea afectado.
    ')
;

--
INSERT IGNORE INTO Imagenes VALUES
  ('nvidia_gtx.jpg')
;

--
INSERT IGNORE INTO Etiquetas VALUES
  ('TECNOLOGÍA'), ('NVIDIA'), ('GRÁFICOS'), ('RAYTRACING'), ('AMD'), ('INTEL'),
  ('JUEGOS'), ('CONSOLAS')
;

--
INSERT IGNORE INTO Comentarios (ip, texto, email_usuario, id_noticia) VALUES
  ('localhost', 'Ciertamente una ventaja ante AMD, aunque sea más caro', 'cuenta_falsa_1@dominio.com', 1),
  ('localhost', 'Yo siempre he sido de AMD pero con estos avances seguramente mi próxima gráfica sea NVIDIA', 'cuenta_falsa_2@dominio.com', 1)
;

--
INSERT IGNORE INTO EtiquetasEnNoticia VALUES
  (1, 'NVIDIA'    ),
  (1, 'RAYTRACING'),
  (1, 'GRÁFICOS'  ),
  (1, 'TECNOLOGÍA')
;

--
INSERT IGNORE INTO ImagenesEnNoticia VALUES
  (1, 'nvidia_gtx.jpg')
;
