SET FOREIGN_KEY_CHECKS = 0;
-- -----------------------------------------------------
-- Data for table `webext`.`estudios`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`estudios`;
INSERT INTO `webext`.`estudios` (`id`, `estudio`) VALUES (1, 'Sin Estudios o Estudios Elementales');
INSERT INTO `webext`.`estudios` (`id`, `estudio`) VALUES (2, 'Estudios Medios');
INSERT INTO `webext`.`estudios` (`id`, `estudio`) VALUES (3, 'Estudios Superiores');

COMMIT;

-- -----------------------------------------------------
-- Data for table `webext`.`colaboradores_tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`colaboradores_tipos`;
INSERT INTO `webext`.`colaboradores_tipos` (`id`, `tipo`) VALUES (6, 'Asociacion');
INSERT INTO `webext`.`colaboradores_tipos` (`id`, `tipo`) VALUES (1, 'Ayuntamiento');
INSERT INTO `webext`.`colaboradores_tipos` (`id`, `tipo`) VALUES (2, 'Empresa');
INSERT INTO `webext`.`colaboradores_tipos` (`id`, `tipo`) VALUES (3, 'Entidad Publica');
INSERT INTO `webext`.`colaboradores_tipos` (`id`, `tipo`) VALUES (4, 'Orden Religiosa');
INSERT INTO `webext`.`colaboradores_tipos` (`id`, `tipo`) VALUES (5, 'Persona Fisica');
INSERT INTO `webext`.`colaboradores_tipos` (`id`, `tipo`) VALUES (7, 'Contacto');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`localizadores_tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`localizadores_tipos`;
INSERT INTO `webext`.`localizadores_tipos` (`id`, `tipo`) VALUES (1, 'Fijo');
INSERT INTO `webext`.`localizadores_tipos` (`id`, `tipo`) VALUES (2, 'Movil');
INSERT INTO `webext`.`localizadores_tipos` (`id`, `tipo`) VALUES (4, 'Email');
INSERT INTO `webext`.`localizadores_tipos` (`id`, `tipo`) VALUES (3, 'Fax');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`galardones`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`galardones`;
INSERT INTO `webext`.`galardones` (`id`, `galardon`) VALUES (1, 'Diploma');
INSERT INTO `webext`.`galardones` (`id`, `galardon`) VALUES (2, 'Placa');
INSERT INTO `webext`.`galardones` (`id`, `galardon`) VALUES (3, 'Premio');
INSERT INTO `webext`.`galardones` (`id`, `galardon`) VALUES (4, 'Condecoracion');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`islas`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`islas`;
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (1, 'Cabrera');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (2, 'Conejera');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (3, 'Formentera');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (4, 'Fuerteventura');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (5, 'Gran Canaria');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (6, 'La Gomera');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (7, 'La Graciosa');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (8, 'Hierro');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (9, 'Ibiza');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (10, 'Lanzarote');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (11, 'Mallorca');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (12, 'Menorca');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (13, 'La Palma');
INSERT INTO `webext`.`islas` (`id`, `isla`) VALUES (14, 'Tenerife');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`categorias`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`categorias`;
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (1, 'Categoria 1', 'Estaciones climatológicas completas, casi completas o especiales.\nEstaciones nivo-meteorológicas que realizan observaciones diarias de los parámetros\nnivológicos, además de los meteorológicos.', 880, '2008/11/01');
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (2, 'Categoria 2', 'Estaciones meteorológicas automáticas de las redes sinópticas y mesoescolar \"(SEAC y\nVAISALA, entre otras)\".\nEstaciones meteorológicas automáticas de la red secundaria climatológica (Thies, entre\notras) que midan viento o tengan instalado adicionalmente algún equipo de medida no\nautomático.', 610, '2008/11/01');
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (3, 'Categoria 3', 'Estaciones termopluviométricas, que tengan instalado al menos un equipo adicional a los de\nmedida de temperatura y precipitación (barógrafo, anemocinemógrafo, tanque\nevaporimétrico, heliógrafo, etc.)\nEstaciones meteorológicas automáticas de la red secundaria climatológica (Thies, entre\notras) no incluidas en la categoría segunda.\nRealización de observaciones marítimas, como temperatura del mar, estado de la mar y10\nrissagues.\nEn el caso de que concurriesen dos o más de estos supuestos la estación pasaría a\nconsiderarse de clase segunda.', 340, '2008/11/01');
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (4, 'Categoria 4', 'Comprende la atención a las restantes estaciones termopluviométricas.', 200, '2008/11/01');
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (5, 'Categoria 5', 'Comprende la atención a estaciones pluviométricas.', 150, '2008/11/01');
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (6, 'Categoria 6', 'Comprende la realización de observaciones fenológicas. Es acumulable con las otras 5 categorias.', 80, '2008/11/01');
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (7, 'Categoria 7', NULL, NULL, NULL);
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (8, 'Categoria 8', NULL, NULL, NULL);
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (9, 'Categoria 9', NULL, NULL, NULL);
INSERT INTO `webext`.`categorias` (`id`, `categoria`, `observaciones`, `limite`, `f_vigor`) VALUES (10, 'Tiempo Real', 'Con carácter general, a aquellos colaboradores de cualquier categoria que, a requerimiento\nde AEMET, remitan los datos de sus estaciones en tiempo real, se les asignará una\ngratificación adicional de 60,lO E.', 60.10, '2008/11/01');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`estaciones_tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`estaciones_tipos`;
INSERT INTO `webext`.`estaciones_tipos` (`id`, `tipo`, `observaciones`) VALUES (1, 'Automatica', NULL);
INSERT INTO `webext`.`estaciones_tipos` (`id`, `tipo`, `observaciones`) VALUES (2, 'Pluviometrica', NULL);
INSERT INTO `webext`.`estaciones_tipos` (`id`, `tipo`, `observaciones`) VALUES (3, 'Termometrica', NULL);
INSERT INTO `webext`.`estaciones_tipos` (`id`, `tipo`, `observaciones`) VALUES (4, 'Fenologica', NULL);
INSERT INTO `webext`.`estaciones_tipos` (`id`, `tipo`, `observaciones`) VALUES (5, 'Termopluviometrica', NULL);
INSERT INTO `webext`.`estaciones_tipos` (`id`, `tipo`, `observaciones`) VALUES (6, 'Otro', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`propietarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`propietarios`;
INSERT INTO `webext`.`propietarios` (`id`, `propietario`) VALUES (1, 'Ajeno al INM');
INSERT INTO `webext`.`propietarios` (`id`, `propietario`) VALUES (2, 'Propio del INM');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`cuencas`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`cuencas`;
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('0', 'Pirineo Oriental');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('1', 'Norte');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('2', 'Duero');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('3', 'Tajo');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('4', 'Guadiana');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('5', 'Guadalquivir');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('6', 'Sur');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('7', 'Segura');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('8', 'Jucar');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('9', 'Ebro');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('10', 'Baleares');
INSERT INTO `webext`.`cuencas` (`cod`, `cuenca`) VALUES ('11', 'Canarias');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`incidencias`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`incidencias_tipos`;
INSERT INTO `webext`.`incidencias_tipos` (`id`, `tipo`) VALUES (1, 'Baja Definitiva');
INSERT INTO `webext`.`incidencias_tipos` (`id`, `tipo`) VALUES (2, 'Cambio de Colaborador');
INSERT INTO `webext`.`incidencias_tipos` (`id`, `tipo`) VALUES (3, 'Cambio de Desplazamiento');
INSERT INTO `webext`.`incidencias_tipos` (`id`, `tipo`) VALUES (4, 'Instalacion de Material');
INSERT INTO `webext`.`incidencias_tipos` (`id`, `tipo`) VALUES (5, 'Otras');
INSERT INTO `webext`.`incidencias_tipos` (`id`, `tipo`) VALUES (6, 'Revision');
INSERT INTO `webext`.`incidencias_tipos` (`id`, `tipo`) VALUES (7, 'Cambio de Tipo de Estacion');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`gratificaciones_estados`
-- -----------------------------------------------------

START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`gratificaciones_estados`;
INSERT INTO `webext`.`gratificaciones_estados` (`id`, `estado`) VALUES (1, 'Anulada');
INSERT INTO `webext`.`gratificaciones_estados` (`id`, `estado`) VALUES (2, 'Devuelta');
INSERT INTO `webext`.`gratificaciones_estados` (`id`, `estado`) VALUES (3, 'Enviada al Banco');
INSERT INTO `webext`.`gratificaciones_estados` (`id`, `estado`) VALUES (4, 'Emitida');
INSERT INTO `webext`.`gratificaciones_estados` (`id`, `estado`) VALUES (5, 'Pagada');
INSERT INTO `webext`.`gratificaciones_estados` (`id`, `estado`) VALUES (6, 'Propuesta');

COMMIT;



-- -----------------------------------------------------
-- Data for table `webext`.`anotaciones_tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`anotaciones_tipos`;
INSERT INTO `webext`.`anotaciones_tipos` (`id`, `tipo`) VALUES (1, 'Baja por Fallecimiento');
INSERT INTO `webext`.`anotaciones_tipos` (`id`, `tipo`) VALUES (2, 'Baja Forzada por el Instituto');
INSERT INTO `webext`.`anotaciones_tipos` (`id`, `tipo`) VALUES (3, 'Baja Voluntaria');
INSERT INTO `webext`.`anotaciones_tipos` (`id`, `tipo`) VALUES (4, 'Anotacion');
INSERT INTO `webext`.`anotaciones_tipos` (`id`, `tipo`) VALUES (5, 'Actualizacion');

COMMIT;


-- -----------------------------------------------------
-- Data for table `webext`.`credenciales_tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `webext`;
TRUNCATE TABLE `webext`.`credenciales_tipos`;
INSERT INTO `webext`.`credenciales_tipos` (`id`, `tipo`) VALUES (1, 'Administrador');
INSERT INTO `webext`.`credenciales_tipos` (`id`, `tipo`) VALUES (2, 'Supervisor');
INSERT INTO `webext`.`credenciales_tipos` (`id`, `tipo`) VALUES (3, 'Lector');

COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
