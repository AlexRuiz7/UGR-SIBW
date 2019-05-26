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
INSERT IGNORE INTO Usuarios (email, nombre, contraseña, tipo) VALUES
  ('cuenta_falsa_1@dominio.com',  'Juan Cuesta'   , 'junta_urgente'          , 'admin'),
  ('cuenta_falsa_2@dominio.com',  'Emilio Delgado', 'un_poquito_de_por_favor', 'moderador'),
  ('cuenta_falsa_3@dominio.com',  'Paloma Cuesta' , 'puff'                   , 'gestor'),
  ('cuenta_falsa_4@dominio.com',  'Belén'         , 'del_monton_bueno'       , 'registrado')
;

--
INSERT IGNORE INTO Noticias (titular, texto, autor, fecha, visitas, link) VALUES
  ('NVIDIA lleva el Ray Tracing a sus tarjetas gráficas GTX',
    'NVIDIA anunció a finales de 2018 sus tarjetas gráficas RTX, donde además
    de estrenar la arquitectura Turing de 12 nm y mejorar el rendimiento,
    incluían RT Cores y compatibilidad con Ray Tracing para una iluminación y
    reflejos más realistas en los videojuegos compatibles. Ahora, El Ray
    Tracing va a llegar a las tarjetas GTX que la compañía ya tenía en el
    mercado de la generación anterior.
    ##
    Entre estas tarjetas gráficas encontramos todas las de la serie GTX a
    partir de la 1060 de 6 GB. El cambio a RTX tenía que ver con la llegada del
    Ray Tracing, dejando de lado la gama GTX para las tarjetas no compatibles,
    pero finalmente la diferencia pareceser que será solo a nivel de hardware.
    ##
    Y es que, si NVIDIA quiere que haya un soporte más amplio por parte de los
    juegos para Ray Tracing, tiene que abrirlo a más tarjetas gráficas. Este es
    el motivo por el que han decidido llevar a la gama GTX un soporte algo más
    básico de Ray Tracing que el que ofrecen en las RTX.
    ##
    Así, ahora mismo encontramos dos gamas que soportarán DXR, o DirectX
    Raytracing, la API de DirectX 12. Esta API, teóricamente, hacía compatible
    con el trazado de rayos a cualquier tarjeta gráfica compatible con DirectX
    12.
    ##
    La gama más básica contará con efectos básicos de Ray Tracing, y un conteo
    bajo de rayos. Entre ellas encontramos la Titan XP, Titan X, GTX 1080 Ti,
    GTX 1080, GTX 1070 Ti, GTX 1070, GTX 1060 6GB (el de 3 GB no), así como las
    nuevas GTX 1660 Ti y GTX 1660.
    ##
    En cuanto al soporte completo de efectos de Ray Tracing y un conteo alto de
    rayos, encontramos el mismo soporte actual de la Titan RTX, RTX 2080 Ti,
    RTX 2080, RTX 2070 y RTX 2060.
    ##
    La compatibilidad llegará a estas tarjetas gráficas mediante un nuevo
    driver GeForce el próximo mes de abril, donde nuestros compañeros de
    HardZone recogerán las novedades al respecto, así como realizarán pruebas
    de este nuevo modo. Los desarrolladores no tendrán que hacer nada para que
    estas tarjetas sean compatibles. Si el juego ya soporta Ray Tracing, la
    tarjeta gráfica GTX ya podrá hacer uso de las funcionalidades que tenga
    compatibles.
    ##
    Esta apuesta de NVIDIA es muy interesante, teniendo en cuenta que hasta
    ahora se creía que eran necesarios tener núcleos específicos para hacer los
    cálculos relacionados con el Ray Tracing, y eso que incluso con ellos el
    rendimiento del juego cae a la mitad. Con GTX se creía que el rendimiento
    se quedaría por los suelos, así que habrá que ver cómo afecta esta
    implementación, e incluso si usar estos rayos en “calidad baja” es
    suficiente como para no tener que activar la implementación completa.
    ##
    Lo que no será compatible con las GTX será DLSS, o Deep Learning Super
    Sampling, donde la tarjeta gráfica usa los Tensor Cores para reescalar la
    imagen y mejorarla sin que el rendimiento se vea afectado.',
    'Alberto García', '2019-03-19 09:41:00', 628,
    'https://www.adslzone.net/2019/03/19/nvidia-gtx-ray-tracing/amp/')
;


--
INSERT IGNORE INTO Noticias (titular, texto, autor, fecha, visitas, link) VALUES
  ('En 2019 las ventas de discos duros caeran a la mitad',
   'Durante años, las ventas de discos duros han ido en declive. Esta tendencia
    se comenzó a apreciar con más fuerza a partir del año 2015, que se podría
    tomar como el año de partida en el que se comenzó a ser más popular el
    empleo de los SSD en los equipos de los usuarios. Especialmente, este dato
    es importante por su impacto en los ordenadores portátiles. Este tipo de
    ordenadores comenzaron a descartar el empleo de los discos duros a cambio
    del extra de autonomía y rendimiento que eran capaces de proporcionar los
    SSD en este tipo de equipos.
    ##
    Aparte del auge de los SSD, también podemos encontrar otro culpable del
    descenso de ventas de discos duros durante estos años. Este “culpable”
    radica en el incremento del tamaño de las unidades de almacenamiento
    mecánico, que hace que los usuarios no necesiten más de un disco duro en
    su equipo para almacenar datos. Si en el pasado era común encontrar
    sistemas con varios HDD de 1 o 2 TB, hoy en día es más corriente encontrar
    sistemas que cuentan con un HDD de 2 o 3 TB, que son más que suficientes
    para cubrir nuestras necesidades de almacenamiento.
    ##
    También cuenta el hecho que muchos usuarios opten por guardar sus datos
    en la nube, en lugar de en su propio PC. De hecho, si nos fijamos en los
    datos de ventas de discos duros para Data Centers, podemos ver que sus
    ventas han seguido una tendencia ascendente desde los 43 milones de
    unidades vendidas en el 2016 hasta los 54 millones de unidades que se
    espera vender durante el 2019.',
    'Juan Diego de Usera', '2019-05-03 20:02:00', 541,
    'https://hardzone.es/2019/05/03/ventas-discos-duros-mitad-ssd-sustituirlos/'
  ),

  ('Placas base Intel B365: primeros modelos y características',
    'El chipset B360 ha sido durante bastante tiempo uno de los preferidos por
    los gamers con menos presupuesto, donde se daba la curiosidad de que también
    era usado para PCs modestos. Su muerte prematura y sustitución por el nuevo
    B365 ha dejado muchas críticas, pero ¿son justificadas? Hoy veremos los tres
    modelos de placas base gaming que han sido presentados y podremos discernir
    sobre el controvertido paso de Intel.
    ##
    Hace ya más de medio año desde que escuchamos los primeros cantos de sirena
    sobre un chipset que llegaría para sustituir a otro de forma prematura. B360
    cumplía perfectamente con su cometido, pero es cierto que era un chipset
    menos completo que su predecesor B365. Además, estuvo la controversia de los
    22 nm frente a los 14 nm, por lo que este nuevo chipset llegaría al mercado
    siendo visto por mil ojos.
    ##
    Por suerte, aunque con algo de retraso, las primeras placas base ya están
    entre nosotros, donde por ahora solo tenemos tres modelos disponibles: dos
    de ASRock y uno de ASUS.
    ##
    Las dos placas base de ASRock parten del mismo modelo, donde apenas hay
    cambios más allá del tamaño entre ambas y con las consecuentes reducciones
    de algunas de sus prestaciones.
    ##
    En cualquier caso, nos encontraremos con unas placas base que portan USB 3.1
    Gen 2, Power Choke 50A Premium, capacitadores Nichicon 12 Black, E/S Armor,
    Shaped PCB en color negro y con alta densidad de tejido de vidrio.
    ##
    Sin olvidar la cobertura total para los M.2 o el llamado ASRock Full Spike
    Protection para todos los puertos USB, Audio y LAN. El sistema de fases es
    igual entre las dos placas, ya que tendremos un 7+2 con un sistema de VRM
    parcialmente refrigerado (solo CPU).
    ##
    El tamaño imposibilita a la versión B365M la inclusión de un M.2 para Wi-Fi
    y de otro M.2 adicional para SSD con dicha interfaz.
    ##
    Además, esta versión recortada en tamaño pierde un PCIe 3.0 X1 por su menor
    longitud vertical. Comparte eso sí, su soporte de memoria DDR4 2666 MHz, 2
    PCIe 3.0 X16 (uno con protección contra dobleces), soporte para AMD
    CrossFireX, salidas HDMI y Display Port, Audio 7.1 HD y seis SATA 3 6 GB/s,
    aparte de una tarjeta de red Intel LAN I219V.',
    'Javier Lopez', '2019-05-02 16:16:00', 774,
    'https://hardzone.es/2019/05/02/placas-gaming-b365-2019/'
  ),

  ('Google I/O: el evento del año del gigante tecnológico',
    'El evento se realizará, como pudimos saber ya en enero, desde el 7 de mayo
    y durará un par de días más, hasta el 9. Aunque en esencia siempre se ha
    tratado de un evento para desarrolladores como aún parece mostrar la web
    oficial, con el tiempo el gigante tecnológico ha aprovechado también para
    presentar dispositivos, así que no está de más que veamos qué se espera para
    la edición de este año.
    ##
    Una de las estrellas del evento será Android Q, la versión del sistema
    operativo de Google que se espera para este año y que ya está disponible en
    forma de beta desde hace algo más de un mes. Aunque suele lanzarse la versión
    oficial y completa más adelante, pasado ya el verano (quizás ya con el anuncio
    de los esperados herederos directos de los Google Pixel 3 y 3 XL), en ese
    evento solemos recibir un buen avance en lo referente a las novedades de la
    iteración de software.
    ##
    Suena fuerte también Google Stadia, que ya fue presentado en la Game Developers
    Conference 2019 (GDC) y esperamos saber más sobre ello. Se trata de una nueva
    plataforma de Google en forma de un nuevo servicio que permitirá jugar en
    streaming desde cualquier lado y en cualquier dispositivo, ya sea smartphone
    u ordenador.
    ##
    Lo lógico es que también veamos novedades de Google Assistant, sobre todo
    viendo que Bixby, Alexa, Siri y el resto de asistentes de voz también van
    incrementando sus funciones. Por otro lado, quizás se diga algo más de
    Fuchsia, el sistema operativo que unificaría Chrome OS y Android en unos
    años, pero no se espera su lanzamiento para esta edición.
    ##
    Esperamos que también se diga algo de Wear OS, el sistema operativo para
    smartwatches que de hecho se actualizaba la semana pasada, así como de
    Chrome OS, pero no se ha comentado al respecto. Tendremos que esperar unos
    días para saber las novedades de estos sistemas operativos.',
    'Anna Martí', '2019-05-03 17:12:00', 212,
    'https://www.xataka.com/eventos/google-i-android-q-nuevos-dispositivos-todo-que-esperamos-ver-evento-ano-gigante-tecnologico/amp')
;

--
-- INSERT IGNORE INTO Imagenes VALUES
--   ('nvidia_gtx.jpg')
-- ;

--
-- INSERT IGNORE INTO Etiquetas VALUES
--   ('TECNOLOGÍA'), ('NVIDIA'), ('GRÁFICOS'), ('RAYTRACING'), ('AMD'), ('INTEL'),
--   ('JUEGOS'), ('CONSOLAS'), ('ALMACENAMIENTO'), ('GOOGLE'), ('EVENTOS')
-- ;

--
INSERT IGNORE INTO Comentarios (ip, texto, email_usuario, id_noticia) VALUES
  ('localhost',
    'Ciertamente una ventaja ante AMD, aunque sea más caro',
    'cuenta_falsa_1@dominio.com', 1),
  ('localhost',
    'Yo siempre he sido de AMD pero con estos avances seguramente mi próxima gráfica sea NVIDIA',
    'cuenta_falsa_2@dominio.com', 1)
;

--
INSERT IGNORE INTO EtiquetasEnNoticia VALUES
  (1, 'NVIDIA'),          (1, 'RAYTRACING'), (1, 'GRÁFICOS'), (1, 'TECNOLOGÍA'),
  (2, 'ALMACENAMIENTO'),  (2, 'SSD'),
  (3, 'ASUS'),            (3, 'PLACAS BASE'),
  (4, 'GOOGLE'),          (4, 'EVENTOS')
;

--
INSERT IGNORE INTO ImagenesEnNoticia VALUES
  (1, 'nvidia_gtx.jpg'),
  (2, 'discos-duros.jpg'),
  (3, 'asus-rog-strix.jpg'),
  (4, 'google_i_o.jpg')
;
