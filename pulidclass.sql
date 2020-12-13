-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pulidclass
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asesor`
--

DROP TABLE IF EXISTS `asesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asesor` (
  `Id_Asesor` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Usuario` varchar(30) NOT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Grado_Estudios` varchar(40) DEFAULT NULL,
  `Nombres` varchar(50) DEFAULT NULL,
  `A_Paterno` varchar(30) DEFAULT NULL,
  `A_Materno` varchar(30) DEFAULT NULL,
  `Ocupacion` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(250) DEFAULT NULL,
  `Correo` varchar(70) DEFAULT NULL,
  `Telefono` varchar(16) DEFAULT NULL,
  `Foto` text,
  PRIMARY KEY (`Id_Asesor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesor`
--

LOCK TABLES `asesor` WRITE;
/*!40000 ALTER TABLE `asesor` DISABLE KEYS */;
INSERT INTO `asesor` VALUES (9,'Danca15',25,'Universidad','Profesor','Valdez','Cuevas','Estudiante','Breve Descripcion De El Asesor','prueba1@gmai.com','12345678','fotoasesores/face2.jpg');
/*!40000 ALTER TABLE `asesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bitacora` (
  `Id_Bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `Accion_Realizada` varchar(250) DEFAULT NULL,
  `TablaAfectada` varchar(250) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `usuario_Correo` varchar(70) NOT NULL,
  PRIMARY KEY (`Id_Bitacora`),
  KEY `fk_bitacora_usuario1_idx` (`usuario_Correo`),
  CONSTRAINT `fk_bitacora_usuario1` FOREIGN KEY (`usuario_Correo`) REFERENCES `usuario` (`Correo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cita` (
  `Folio` int(11) NOT NULL AUTO_INCREMENT,
  `N_De_Usuario` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora_Inicial` varchar(15) DEFAULT NULL,
  `Hora_Final` varchar(15) DEFAULT NULL,
  `N_De_Horas` int(11) DEFAULT NULL,
  `usuario_info_N_De_Usuario` int(11) NOT NULL,
  `asesor_Id_Asesor` int(11) NOT NULL,
  `direccion_Id_Direccion` int(11) NOT NULL,
  `precio_Id_Precio` int(11) NOT NULL,
  PRIMARY KEY (`Folio`),
  KEY `cita_ibfk_1` (`N_De_Usuario`),
  KEY `fk_cita_usuario_info1_idx` (`usuario_info_N_De_Usuario`),
  KEY `fk_cita_asesor1_idx` (`asesor_Id_Asesor`),
  KEY `fk_cita_direccion1_idx` (`direccion_Id_Direccion`),
  KEY `fk_cita_precio1_idx` (`precio_Id_Precio`),
  CONSTRAINT `fk_cita_asesor1` FOREIGN KEY (`asesor_Id_Asesor`) REFERENCES `asesor` (`Id_Asesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cita_direccion1` FOREIGN KEY (`direccion_Id_Direccion`) REFERENCES `direccion` (`Id_Direccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cita_precio1` FOREIGN KEY (`precio_Id_Precio`) REFERENCES `precio` (`Id_Precio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cita_usuario_info1` FOREIGN KEY (`usuario_info_N_De_Usuario`) REFERENCES `usuario_info` (`N_De_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direccion` (
  `Id_Direccion` int(11) NOT NULL AUTO_INCREMENT,
  `Pais` varchar(30) DEFAULT NULL,
  `Estado` varchar(30) DEFAULT NULL,
  `Ciudad` varchar(30) DEFAULT NULL,
  `Colonia` varchar(50) DEFAULT NULL,
  `Calle` varchar(50) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Codigo_Postal` int(11) DEFAULT NULL,
  `Descripcion` varchar(250) DEFAULT NULL,
  `usuario_info_N_De_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`Id_Direccion`),
  KEY `fk_direccion_usuario_info1_idx` (`usuario_info_N_De_Usuario`),
  CONSTRAINT `fk_direccion_usuario_info1` FOREIGN KEY (`usuario_info_N_De_Usuario`) REFERENCES `usuario_info` (`N_De_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` VALUES (3,'MÃ©xico','Durango','Gomez Palacio','Hortenciasasdasda','Hector Espino',185,35043,'Fachada Verde, Porton Azul',2);
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materia` (
  `Id_Materia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) NOT NULL,
  `Area_Conocimiento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Materia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,'Fisica','Universidad'),(2,'Matematicas','Universidad'),(3,'Programacion','Universidad');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiacategoria`
--

DROP TABLE IF EXISTS `materiacategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiacategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_asesor` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_asesor` (`id_asesor`),
  KEY `id_materia` (`id_materia`),
  CONSTRAINT `materiacategoria_ibfk_1` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`Id_Asesor`),
  CONSTRAINT `materiacategoria_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`Id_Materia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiacategoria`
--

LOCK TABLES `materiacategoria` WRITE;
/*!40000 ALTER TABLE `materiacategoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `materiacategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material` (
  `Id_Material` int(11) NOT NULL AUTO_INCREMENT,
  `Correo` varchar(70) DEFAULT NULL,
  `Titulo` varchar(50) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Materia` varchar(70) DEFAULT NULL,
  `Documento` text,
  `asesor_Id_Asesor` int(11) NOT NULL,
  PRIMARY KEY (`Id_Material`),
  KEY `material_ibfk_1` (`Correo`),
  KEY `fk_material_asesor1_idx` (`asesor_Id_Asesor`),
  CONSTRAINT `fk_material_asesor1` FOREIGN KEY (`asesor_Id_Asesor`) REFERENCES `asesor` (`Id_Asesor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticia` (
  `Id_Noticia` int(11) NOT NULL AUTO_INCREMENT,
  `Correo` varchar(70) DEFAULT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Subtitulo` varchar(150) NOT NULL,
  `Fecha` date NOT NULL,
  `Fuentes` text NOT NULL,
  `Informacion` text NOT NULL,
  `Imagen` text,
  `asesor_Id_Asesor` int(11) NOT NULL,
  PRIMARY KEY (`Id_Noticia`),
  KEY `cita_ibfk_1` (`Correo`),
  KEY `fk_noticia_asesor1_idx` (`asesor_Id_Asesor`),
  CONSTRAINT `fk_noticia_asesor1` FOREIGN KEY (`asesor_Id_Asesor`) REFERENCES `asesor` (`Id_Asesor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precio`
--

DROP TABLE IF EXISTS `precio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `precio` (
  `Id_Precio` int(11) NOT NULL AUTO_INCREMENT,
  `Costo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Precio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio`
--

LOCK TABLES `precio` WRITE;
/*!40000 ALTER TABLE `precio` DISABLE KEYS */;
/*!40000 ALTER TABLE `precio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarjeta`
--

DROP TABLE IF EXISTS `tarjeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarjeta` (
  `Id_Tarjeta` int(11) NOT NULL AUTO_INCREMENT,
  `N_De_Usuario` int(11) DEFAULT NULL,
  `Nombre_T` varchar(200) DEFAULT NULL,
  `Num_T` varchar(200) DEFAULT NULL,
  `Mes` int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Codigo_S` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Tarjeta`),
  KEY `N_De_Usuario` (`N_De_Usuario`),
  CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`N_De_Usuario`) REFERENCES `usuario_info` (`N_De_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarjeta`
--

LOCK TABLES `tarjeta` WRITE;
/*!40000 ALTER TABLE `tarjeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarjeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `Correo` varchar(70) NOT NULL,
  `Contrasena` varchar(200) DEFAULT NULL,
  `Validacion` varchar(20) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Activacion` tinyint(1) DEFAULT NULL,
  `Codigo_Activacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`Correo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('17231222@itslerdo.edu.mx','8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e','Validada',2,1,3365),('pulidovaldezd@gmail.com','8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e','Validada',1,NULL,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_info`
--

DROP TABLE IF EXISTS `usuario_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_info` (
  `N_De_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(50) DEFAULT NULL,
  `A_Paterno` varchar(20) DEFAULT NULL,
  `A_Materno` varchar(20) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Telefono` varchar(16) DEFAULT NULL,
  `Foto` text,
  `usuario_Correo` varchar(70) NOT NULL,
  PRIMARY KEY (`N_De_Usuario`),
  KEY `fk_usuario_info_usuario1_idx` (`usuario_Correo`),
  CONSTRAINT `fk_usuario_info_usuario1` FOREIGN KEY (`usuario_Correo`) REFERENCES `usuario` (`Correo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_info`
--

LOCK TABLES `usuario_info` WRITE;
/*!40000 ALTER TABLE `usuario_info` DISABLE KEYS */;
INSERT INTO `usuario_info` VALUES (2,'David','Valdez','Valdez',23,'+528713975674','fotosusuarios/pp.jpg','17231222@itslerdo.edu.mx'),(3,'David','Valdez','Valdez',23,'+528713975674','fotosusuarios/WhatsApp Image 2019-11-26 at 13.18.51.jpeg','pulidovaldezd@gmail.com');
/*!40000 ALTER TABLE `usuario_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `pulidclass`.`ValidarCuenta`
AFTER UPDATE ON `pulidclass`.`usuario_info`
FOR EACH ROW
Update Usuario set Validacion='Validada' */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping events for database 'pulidclass'
--

--
-- Dumping routines for database 'pulidclass'
--
/*!50003 DROP PROCEDURE IF EXISTS `spAltaAdministrador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaAdministrador`(IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(200), IN `_Tipo` INT)
BEGIN
	declare Id_AltaCuenta int default 0;
    declare Id_AltaUsuario int default 0;

    
    set Id_AltaCuenta = (SELECT count(*) from usuario where contrasena=_contra and correo=_correo);
    
    if (Id_AltaCuenta != 0) then
		begin
			select 0;
        end;
	else
		begin
            insert into usuario(Correo,Contrasena, tipo) values (_correo,_contra, _Tipo);
            
            insert into usuario_info(usuario_Correo,Nombres,A_Paterno,A_Materno, Edad, Telefono, Foto) Values (_correo,null,null,null,null,null,null);
            set Id_AltaUsuario=(select N_De_Usuario from Usuario where usuario_Correo=_correo);
            
            insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se creo una cuenta con el correo ',_correo), 'Cuenta y Usuario', curdate());
            
			select 1;
        end;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spAltaAsesor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaAsesor`(IN `_CorreoAdmin` VARCHAR(70), IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30), IN `_Edad` INT, IN `_GradoEstudios` VARCHAR(40), IN `_Nombres` VARCHAR(50), IN `_APaterno` VARCHAR(30), IN `_AMaterno` VARCHAR(30), IN `_Ocupacion` VARCHAR(50), IN `_Materia1` VARCHAR(70), IN `_Materia2` VARCHAR(70), IN `_Materia3` VARCHAR(70), IN `_Descripcion` VARCHAR(250), IN `_Telefono` VARCHAR(16), IN `_Foto` TEXT)
BEGIN
	declare Id_AltaNombreUsuario int default 0;
	declare Id_AltaAsesor int default 0;
    declare Id_AltaCorreo int default 0;

    
    set Id_AltaNombreUsuario = (SELECT count(*) from Asesor where  Nombre_Usuario=_NombreUsuario);
    set Id_AltaCorreo = (SELECT count(*) from Asesor where  Correo=_Correo);
    
    if (Id_AltaNombreUsuario <> 0 || Id_AltaCorreo <> 0) then
		begin
			select 0;
        end;
	else
		begin
            insert into Asesor(Nombre_Usuario,Edad,Grado_Estudios,Nombres,A_Paterno,A_Materno,Ocupacion,Descripcion, Correo, Telefono, Foto) values (_NombreUsuario,_Edad,_GradoEstudios,_Nombres,_APaterno,_AMaterno,_Ocupacion,_Descripcion, _Correo, _Telefono, _Foto);
            
            set Id_AltaAsesor = (SELECT Id_Asesor FROM Asesor ORDER BY Id_Asesor DESC LIMIT 1);

            insert into materiacategoria values (null,Id_AltaAsesor,materia1),(null,Id_AltaAsesor,materia2),(null,Id_AltaAsesor,materia3);
            
            insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_CorreoAdmin,concat('El usuario con el correo:  ',_CorreoAdmin,'creo una cuenta de asesor, con el nombre de usuario: ', _NombreUsuario), 'Asesor', curdate());
            
			SELECT 1;
        end;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spAltaCita` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaCita`(IN `_N_De_Usuario` INT, IN `_Id_Asesor` INT, IN `_Id_Tarjeta` INT, IN `_DireccionP1` VARCHAR(200), IN `_DireccionP2` VARCHAR(200), IN `_Dir_Descripcion` VARCHAR(100), IN `_Fecha` DATE, IN `_Hora_Inicial` VARCHAR(15), IN `_Hora_Final` VARCHAR(15), IN `_NDeHoras` INT, IN `_Costo` DECIMAL(10,2))
BEGIN
		declare _correo varchar(70) default '';
        
        set _correo= (SELECT correo from Usuario where  N_De_Usuario=_N_De_Usuario);
		insert into Cita(N_De_Usuario, Id_Asesor,Id_Tarjeta,DireccionP1,DireccionP2,Dir_Descripcion,Fecha,Hora_Inicial,Hora_Final,N_De_Horas,Costo) Values (_N_De_Usuario,_Id_Asesor,_Id_Tarjeta,_DireccionP1,_DireccionP2,_Dir_Descripcion,_Fecha,_Hora_Inicial,_Hora_Final,_NDeHoras,_Costo);
            
		insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('El usuario con el Numero De Usuario: ',_N_De_Usuario, 'Genero Una Cita con el asesor:', _Id_Asesor), 'Cita', curdate());
            
		SELECT 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spAltaCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaCuenta`(IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(200), IN `_tipo` INT, IN `_Activacion` BOOL, IN `_Codigo_Activacion` INT)
BEGIN
	declare Id_AltaCuenta int default 0;
    declare Id_AltaUsuario int default 0;
    declare Id_AltaDireccion int default 0;

    
    set Id_AltaCuenta = (SELECT count(*) from usuario where contrasena=_contra and correo=_correo);
    
    if (Id_AltaCuenta != 0) then
		begin
			select 0;
        end;
	else
		begin
 insert into usuario(Correo,Contrasena, tipo, activacion, codigo_activacion) values (_correo,_contra, _tipo, _activacion, _codigo_activacion);
            
            insert into usuario_info(usuario_Correo,Nombres,A_Paterno,A_Materno, Edad, Telefono, Foto) Values (_correo,null,null,null,null,null,null);
            set Id_AltaUsuario=(select N_De_Usuario from Usuario where Correo=_correo);
            
            insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se creo una cuenta con el correo ',_correo), 'Cuenta y Usuario', curdate());
            
			select 1;
        end;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spAltaDireccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaDireccion`(IN `_Correo` VARCHAR(70), IN `_Pais` VARCHAR(30), IN `_Estado` VARCHAR(30), IN `_Ciudad` VARCHAR(30), IN `_Colonia` VARCHAR(50), IN `_Calle` VARCHAR(50), IN `_Numero` INT, IN `_CodigoPostal` INT, IN `_Descripcion` VARCHAR(250))
BEGIN
	declare _IdUsuario int default 0;
    declare _IdDireccion int default 0;
    
    set _IdUsuario=(select N_De_Usuario from usuario_info where usuario_Correo=_Correo);

	insert into Direccion(Pais,Estado,Ciudad, Colonia, Calle, Numero, Codigo_Postal, Descripcion,usuario_info_N_De_Usuario) Values (_Pais,_Estado,_Ciudad,_Colonia,_Calle,_Numero,_CodigoPostal,_Descripcion,_IdUsuario);
    
	insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se agrego una dirección de el usuario con el correo ',_correo), 'Direccion y Habita', curdate());
	SELECT 0;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spAltaUsuarioAsesor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaUsuarioAsesor`(IN `_CorreoAdmin` VARCHAR(70), IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(200), IN `_Tipo` INT, IN `_Nombres` VARCHAR(50), IN `_A_Paterno` VARCHAR(30), IN `_A_Materno` VARCHAR(30), IN `_Edad` INT, IN `_Telefono` VARCHAR(16), IN `_Foto` TEXT)
BEGIN
	declare Id_AltaCuenta int default 0;
    declare Id_AltaUsuario int default 0;
    
     insert into usuario(Correo,Contrasena, tipo) values (_correo,_contra, _Tipo);
            
	insert into Usuario_Info(usuario_Correo,Nombres,A_Paterno,A_Materno, Edad, Telefono, Foto) Values (_correo,_Nombres,_A_Paterno,_A_Materno,_Edad,_Telefono,_Foto);
            
	insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_CorreoAdmin,concat('Se creo una cuenta con el correo ',_correo), 'Cuenta y Usuario', curdate());
    
    select 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spBajaAsesor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaAsesor`(IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30))
BEGIN
	declare _Id_BajaAsesor int default 0;
    
    set _Id_BajaAsesor = (SELECT Id_Asesor from asesor where Nombre_Usuario=_NombreUsuario);
    
    if (_Id_BajaAsesor != 0) then
		begin
			delete from asesor where Nombre_Usuario=_Id_BajaAsesor;
            
			insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('El usuario con el correo:  ',_correo,' elimino una cuenta de asesor, con el nombre de usuario: ', _NombreUsuario), 'Asesor', curdate());
             
			SELECT 'Asesor Dado De Baja';
        end;
	else
		begin
            select 'El Asesor Con Ese Nombre De Usuario No Existe';
        end;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spBajaCita` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaCita`(IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30), IN `_Fecha` DATE, IN `_Hora` VARCHAR(15), IN `_NDeHoras` INT, IN `_Costo` INT)
BEGIN
	declare	_IdNDeUsuario int default 0;
    declare	_IdAsesor int default 0;
    declare _Folio int default 0;
			
            set _IdNDeUsuario=(select N_De_Usuario from usuario where Correo=_Correo);
            set _IdAsesor=(select Id_Asesor from asesor where Nombre_Usuario=_NombreUsuario);
            
            set _Folio=(select Folio from cita where Fecha=_Fecha and Hora=_Hora and N_De_Horas=_NDeHoras and Costo=_Costo and Folio= Any(select Folio from cita where N_De_Usuario=_IdNDeUsuario and Id_Asesor=_IdAsesor));
            
            delete from Cita where Folio=_Folio;
             
			insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se cancelo una cita de el usuario con el correo ',_correo, 'Y es asesor', _NombreUsuario), 'Cita', curdate());
			SELECT 'Los Datos Ha Sido Ingresados Correctamente';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spBajaCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaCuenta`(IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(200))
BEGIN
	declare _Id_BajaCuenta int default 0;
    declare _Id_Usuario int default 0;
    
    set _Id_BajaCuenta = (SELECT count(*) from usuario where contrasena=_contra and correo=_correo);
    
    if (_Id_BajaCuenta != 0) then
		begin
			set _Id_Usuario=(Select N_De_Usuario from Usuario_Info where usuario_Correo=_Correo);
            delete from direccion where usuario_info_N_De_Usuario=_Id_Usuario;
            delete from tarjeta where N_De_Usuario=_Id_Usuario;
            delete from Usuario_Info where usuario_Correo=_Correo;
            delete from Usuario where Correo=_Correo;
            delete from Cita where N_De_Usuario=_Id_Usuario;
			insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se elimino la cuenta con el correo ',_correo), 'Cuenta, Usuario, Dirección y Habita', curdate());
             
			SELECT 0;
        end;
	else
		begin
            select 1;
        end;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spBajaDireccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaDireccion`(IN `_IdDireccion` INT)
BEGIN

	delete from direccion where Id_Direccion=_IdDireccion;
            
	insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se elimino una dirección de el usuario con el correo ',_correo), 'Direccion y Habita', curdate());
	Select 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spModificarAsesor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarAsesor`(IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30), IN `_NombreUsuarioNew` VARCHAR(30), IN `_EdadNew` INT, IN `_GradoEstudiosNew` VARCHAR(40), IN `_NombresNew` VARCHAR(50), IN `_APaternoNew` VARCHAR(30), IN `_AMaternoNew` VARCHAR(30), IN `_OcupacionNew` VARCHAR(50), IN `_MateriaNew` VARCHAR(70))
BEGIN
	declare Id_ModificaAsesor int default 0;
    declare Id_Corroborar_Nueva int default 0;
    
    set Id_ModificaAsesor = (SELECT count(*) from asesor where Nombre_Usuario=_NombreUsuario);
    
    if (Id_ModificaAsesor != 0) then
		begin
			set Id_Corroborar_Nueva=(SELECT count(*) from Asesor where Nombre_Usuario=_NombreUsuarioNew);
            if(Id_Corroborar_Nueva !=0) then
				begin
					Select 'El Asesor con el nombre de usuario nuevo ya esta registrado, por favor proporcione otro';
                end;
			else
				begin
					Update Asesor set Nombre_Usuario=_NombreUsuarioNew, Edad=_EdadNew, Grado_Estudios=_GradoEstudiosNew,Nombres=_NombresNew,A_Paterno=_APaternoNew,A_Materno=_AMaternoNew,Ocupacion=_OcupacionNew,Materias_Que_Ofrece=_MateriaNew where Nombre_Usuario=_NombreUsuario;
                    
                    insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('El usuario con el correo:  ',_correo,' modifico una cuenta de asesor, con el nombre de usuario: ', _NombreUsuario), 'Asesor', curdate());
                    
					SELECT 'La Cuenta Ha Sido Modificada Correctamente';
				end;
			end if;
        end;
	else
		begin
            select 'El Asesor Con Ese Nombre De Usuario No Existe, Proporcione Bien Sus Datos';
        end;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spModificarCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarCuenta`(IN `_Correo` VARCHAR(70), IN `_ContraNew` VARCHAR(200))
BEGIN

	Update usuario set Contrasena=_contraNew where Correo=_correo;
                    
	insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se modifico una cuenta con el correo ',_correo), 'Cuenta', curdate());
	
    select 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spModificarDireccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarDireccion`(IN `_IdDireccion` INT, IN `_PaisNew` VARCHAR(30), IN `_EstadoNew` VARCHAR(30), IN `_CiudadNew` VARCHAR(30), IN `_ColoniaNew` VARCHAR(50), IN `_CalleNew` VARCHAR(50), IN `_NumeroNew` INT, IN `_CodigoPostalNew` INT, IN `_DescripcionNew` VARCHAR(250))
BEGIN

    Update Direccion set Pais=_PaisNew, Estado=_EstadoNew, Ciudad=_CiudadNew, Colonia=_ColoniaNew, Calle=_CalleNew, Numero=_NumeroNew, Codigo_Postal=_CodigoPostalNew, Descripcion=_DescripcionNew where Id_Direccion=_IdDireccion;
            
	insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se agrego una dirección de el usuario con el correo ',_correo), 'Direccion', curdate());
	Select 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spModificarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarUsuario`(IN `_Correo` VARCHAR(70), IN `_Nombres` VARCHAR(50), IN `_A_Paterno` VARCHAR(20), IN `_A_Materno` VARCHAR(20), IN `_Edad` INT, IN `_Telefono` VARCHAR(16), IN `_Foto` TEXT)
BEGIN
	declare _Id_ModificaUsuario int default 0;
    
    set _Id_ModificaUsuario = (SELECT N_De_Usuario from Usuario_Info where usuario_Correo=_correo);
    
	UPDATE Usuario_Info set usuario_Correo=_Correo, Nombres=_Nombres, A_Paterno=_A_Paterno, A_Materno=_A_Materno, Edad=_Edad, Telefono=_Telefono, Foto=_Foto where N_De_Usuario=_Id_ModificaUsuario;
	insert into Bitacora(usuario_Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se actualizaron los datos del usuario con el correo ',_correo), 'Usuario', curdate());
	SELECT 0;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-13 12:24:01
