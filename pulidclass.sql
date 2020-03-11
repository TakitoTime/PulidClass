-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2020 a las 04:34:26
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pulidclass`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaAdministrador` (IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(200), IN `_Tipo` INT)  BEGIN
	declare Id_AltaCuenta int default 0;
    declare Id_AltaUsuario int default 0;

    
    set Id_AltaCuenta = (SELECT count(*) from cuenta where contrasena=_contra and correo=_correo);
    
    if (Id_AltaCuenta != 0) then
		begin
			select 0;
        end;
	else
		begin
            insert into Cuenta(Correo,Contrasena, tipo) values (_correo,_contra, _Tipo);
            
            insert into Usuario(Correo,Nombres,A_Paterno,A_Materno, Edad, Telefono, Foto) Values (_correo,null,null,null,null,null,null);
            set Id_AltaUsuario=(select N_De_Usuario from Usuario where Correo=_correo);
            
            insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se creo una cuenta con el correo ',_correo), 'Cuenta y Usuario', curdate());
            
			select 1;
        end;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaAsesor` (IN `_CorreoAdmin` VARCHAR(70), IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30), IN `_Edad` INT, IN `_GradoEstudios` VARCHAR(40), IN `_Nombres` VARCHAR(50), IN `_APaterno` VARCHAR(30), IN `_AMaterno` VARCHAR(30), IN `_Ocupacion` VARCHAR(50), IN `_Materia1` VARCHAR(70), IN `_Materia2` VARCHAR(70), IN `_Materia3` VARCHAR(70), IN `_Descripcion` VARCHAR(250), IN `_Telefono` VARCHAR(16), IN `_Foto` TEXT)  BEGIN
	declare Id_AltaNombreUsuario int default 0;
    declare Id_AltaCorreo int default 0;

    
    set Id_AltaNombreUsuario = (SELECT count(*) from Asesor where  Nombre_Usuario=_NombreUsuario);
    set Id_AltaCorreo = (SELECT count(*) from Asesor where  Correo=_Correo);
    
    if (Id_AltaNombreUsuario != 0 || Id_AltaCorreo !=0) then
		begin
			select 'En Nombre De Usuario O El Correo Ya Existe En La Base De Datos';
        end;
	else
		begin
            insert into Asesor(Nombre_Usuario,Edad,Grado_Estudios,Nombres,A_Paterno,A_Materno,Ocupacion,Materia1,Materia2,Materia3,Descripcion, Correo, Telefono, Foto) values (_NombreUsuario,_Edad,_GradoEstudios,_Nombres,_APaterno,_AMaterno,_Ocupacion,_Materia1,_Materia2,_Materia3,_Descripcion, _Correo, _Telefono, _Foto);
            
            insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_CorreoAdmin,concat('El usuario con el correo:  ',_CorreoAdmin,'creo una cuenta de asesor, con el nombre de usuario: ', _NombreUsuario), 'Asesor', curdate());
            
			SELECT 'Asesor Dado De Alta';
        end;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaCita` (IN `_N_De_Usuario` INT, IN `_Id_Asesor` INT, IN `_Id_Tarjeta` INT, IN `_DireccionP1` VARCHAR(200), IN `_DireccionP2` VARCHAR(200), IN `_Dir_Descripcion` VARCHAR(100), IN `_Fecha` DATE, IN `_Hora_Inicial` VARCHAR(15), IN `_Hora_Final` VARCHAR(15), IN `_NDeHoras` INT, IN `_Costo` DECIMAL(10,2))  BEGIN
		declare _correo varchar(70) default '';
        
        set _correo= (SELECT correo from Usuario where  N_De_Usuario=_N_De_Usuario);
		insert into Cita(N_De_Usuario, Id_Asesor,Id_Tarjeta,DireccionP1,DireccionP2,Dir_Descripcion,Fecha,Hora_Inicial,Hora_Final,N_De_Horas,Costo) Values (_N_De_Usuario,_Id_Asesor,_Id_Tarjeta,_DireccionP1,_DireccionP2,_Dir_Descripcion,_Fecha,_Hora_Inicial,_Hora_Final,_NDeHoras,_Costo);
            
		insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('El usuario con el Numero De Usuario: ',_N_De_Usuario, 'Genero Una Cita con el asesor:', _Id_Asesor), 'Cita', curdate());
            
		SELECT 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaCuenta` (IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(200), IN `_tipo` INT, IN `_Activacion` BOOL, IN `_Codigo_Activacion` INT)  BEGIN
	declare Id_AltaCuenta int default 0;
    declare Id_AltaUsuario int default 0;
    declare Id_AltaDireccion int default 0;

    
    set Id_AltaCuenta = (SELECT count(*) from cuenta where contrasena=_contra and correo=_correo);
    
    if (Id_AltaCuenta != 0) then
		begin
			select 0;
        end;
	else
		begin
 insert into Cuenta(Correo,Contrasena, tipo, activacion, codigo_activacion) values (_correo,_contra, _tipo, _activacion, _codigo_activacion);
            
            insert into Usuario(Correo,Nombres,A_Paterno,A_Materno, Edad, Telefono, Foto) Values (_correo,null,null,null,null,null,null);
            set Id_AltaUsuario=(select N_De_Usuario from Usuario where Correo=_correo);
            
            insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se creo una cuenta con el correo ',_correo), 'Cuenta y Usuario', curdate());
            
			select 1;
        end;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spAltaDireccion` (IN `_Correo` VARCHAR(70), IN `_Pais` VARCHAR(30), IN `_Estado` VARCHAR(30), IN `_Ciudad` VARCHAR(30), IN `_Colonia` VARCHAR(50), IN `_Calle` VARCHAR(50), IN `_Numero` INT, IN `_CodigoPostal` INT, IN `_Descripcion` VARCHAR(250))  BEGIN
	declare _IdUsuario int default 0;
    declare _IdDireccion int default 0;
    
    set _IdUsuario=(select N_De_Usuario from usuario where Correo=_Correo);

	insert into Direccion(Pais,Estado,Ciudad, Colonia, Calle, Numero, Codigo_Postal, Descripcion) Values (_Pais,_Estado,_Ciudad,_Colonia,_Calle,_Numero,_CodigoPostal,_Descripcion);
	set _IdDireccion=(select Id_Direccion from Direccion order by Id_Direccion desc limit 1);
            
	insert into Habita(N_De_Usuario,Id_Direccion) values(_IdUsuario, _IdDireccion);
	insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se agrego una dirección de el usuario con el correo ',_correo), 'Direccion y Habita', curdate());
	SELECT 0;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaAsesor` (IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30))  BEGIN
	declare _Id_BajaAsesor int default 0;
    
    set _Id_BajaAsesor = (SELECT Id_Asesor from asesor where Nombre_Usuario=_NombreUsuario);
    
    if (_Id_BajaAsesor != 0) then
		begin
			delete from asesor where Nombre_Usuario=_Id_BajaAsesor;
            
			insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('El usuario con el correo:  ',_correo,' elimino una cuenta de asesor, con el nombre de usuario: ', _NombreUsuario), 'Asesor', curdate());
             
			SELECT 'Asesor Dado De Baja';
        end;
	else
		begin
            select 'El Asesor Con Ese Nombre De Usuario No Existe';
        end;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaCita` (IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30), IN `_Fecha` DATE, IN `_Hora` VARCHAR(15), IN `_NDeHoras` INT, IN `_Costo` INT)  BEGIN
	declare	_IdNDeUsuario int default 0;
    declare	_IdAsesor int default 0;
    declare _Folio int default 0;
			
            set _IdNDeUsuario=(select N_De_Usuario from usuario where Correo=_Correo);
            set _IdAsesor=(select Id_Asesor from asesor where Nombre_Usuario=_NombreUsuario);
            
            set _Folio=(select Folio from cita where Fecha=_Fecha and Hora=_Hora and N_De_Horas=_NDeHoras and Costo=_Costo and Folio= Any(select Folio from cita where N_De_Usuario=_IdNDeUsuario and Id_Asesor=_IdAsesor));
            
            delete from Cita where Folio=_Folio;
             
			insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se cancelo una cita de el usuario con el correo ',_correo, 'Y es asesor', _NombreUsuario), 'Cita', curdate());
			SELECT 'Los Datos Ha Sido Ingresados Correctamente';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaCuenta` (IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(20))  BEGIN
	declare _Id_BajaCuenta int default 0;
    declare _Id_Usuario int default 0;
    
    set _Id_BajaCuenta = (SELECT count(*) from cuenta where contrasena=_contra and correo=_correo);
    
    if (_Id_BajaCuenta != 0) then
		begin
			set _Id_Usuario=(Select N_De_Usuario from Usuario where Correo=_Correo);
            delete from direccion, habita using direccion, habita where habita.N_De_Usuario=_Id_Usuario and habita.Id_direccion=Direccion.Id_Direccion;
            delete from habita where N_De_Usuario=_Id_Usuario;
            delete from Usuario where Correo=_Correo;
            delete from Cuenta where Correo=_Correo;
			insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se elimino la cuenta con el correo ',_correo), 'Cuenta, Usuario, Dirección y Habita', curdate());
             
			SELECT 0;
        end;
	else
		begin
            select 1;
        end;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spBajaDireccion` (IN `_IdDireccion` INT)  BEGIN

	delete from habita where Id_Direccion=_IdDireccion;
	delete from direccion where Id_Direccion=_IdDireccion;
            
	insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se elimino una dirección de el usuario con el correo ',_correo), 'Direccion y Habita', curdate());
	Select 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarAsesor` (IN `_Correo` VARCHAR(70), IN `_NombreUsuario` VARCHAR(30), IN `_NombreUsuarioNew` VARCHAR(30), IN `_EdadNew` INT, IN `_GradoEstudiosNew` VARCHAR(40), IN `_NombresNew` VARCHAR(50), IN `_APaternoNew` VARCHAR(30), IN `_AMaternoNew` VARCHAR(30), IN `_OcupacionNew` VARCHAR(50), IN `_MateriaNew` VARCHAR(70))  BEGIN
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
                    
                    insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('El usuario con el correo:  ',_correo,' modifico una cuenta de asesor, con el nombre de usuario: ', _NombreUsuario), 'Asesor', curdate());
                    
					SELECT 'La Cuenta Ha Sido Modificada Correctamente';
				end;
			end if;
        end;
	else
		begin
            select 'El Asesor Con Ese Nombre De Usuario No Existe, Proporcione Bien Sus Datos';
        end;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarCuenta` (IN `_Correo` VARCHAR(70), IN `_Contra` VARCHAR(20), IN `_CorreoNew` VARCHAR(70), IN `_ContraNew` VARCHAR(20))  BEGIN
	declare Id_ModificaCuenta int default 0;
    declare Id_Corroborar_Nueva int default 0;
    
    set Id_ModificaCuenta = (SELECT count(*) from cuenta where Contrasena=_contra and Correo=_correo);
    
    if (Id_ModificaCuenta != 0) then
		begin
			set Id_Corroborar_Nueva=(SELECT count(*) from cuenta where Correo=_correoNew);
            if(Id_Corroborar_Nueva !=0) then
				begin
					Select 0;
                end;
			else
				begin
					Update cuenta set Correo=_correoNew,Contrasena=_contraNew where Correo=_correo;
                    
					insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se modifico una cuenta con el correo ',_correo), 'Cuenta', curdate());
                    
					Select 1;
				end;
			end if;
        end;
	else
		begin
            select 2;
        end;
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarDireccion` (IN `_IdDireccion` INT, IN `_PaisNew` VARCHAR(30), IN `_EstadoNew` VARCHAR(30), IN `_CiudadNew` VARCHAR(30), IN `_ColoniaNew` VARCHAR(50), IN `_CalleNew` VARCHAR(50), IN `_NumeroNew` INT, IN `_CodigoPostalNew` INT, IN `_DescripcionNew` VARCHAR(250))  BEGIN

    Update Direccion set Pais=_PaisNew, Estado=_EstadoNew, Ciudad=_CiudadNew, Colonia=_ColoniaNew, Calle=_CalleNew, Numero=_NumeroNew, Codigo_Postal=_CodigoPostalNew, Descripcion=_DescripcionNew where Id_Direccion=_IdDireccion;
            
	insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se agrego una dirección de el usuario con el correo ',_correo), 'Direccion', curdate());
	Select 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarUsuario` (IN `_Correo` VARCHAR(70), IN `_Nombres` VARCHAR(50), IN `_A_Paterno` VARCHAR(20), IN `_A_Materno` VARCHAR(20), IN `_Edad` INT, IN `_Telefono` VARCHAR(16), IN `_Foto` TEXT)  BEGIN
	declare _Id_ModificaUsuario int default 0;
    
    set _Id_ModificaUsuario = (SELECT N_De_Usuario from Usuario where Correo=_correo);
    
	UPDATE Usuario set Correo=_Correo, Nombres=_Nombres, A_Paterno=_A_Paterno, A_Materno=_A_Materno, Edad=_Edad, Telefono=_Telefono, Foto=_Foto where N_De_Usuario=_Id_ModificaUsuario;
	insert into Bitacora(Correo,Accion_Realizada,TablaAfectada, Fecha) values (_correo,concat('Se actualizaron los datos del usuario con el correo ',_correo), 'Usuario', curdate());
	SELECT 0;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor`
--

CREATE TABLE `asesor` (
  `Id_Asesor` int(11) NOT NULL,
  `Nombre_Usuario` varchar(30) NOT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Grado_Estudios` varchar(40) DEFAULT NULL,
  `Nombres` varchar(50) DEFAULT NULL,
  `A_Paterno` varchar(30) DEFAULT NULL,
  `A_Materno` varchar(30) DEFAULT NULL,
  `Ocupacion` varchar(50) DEFAULT NULL,
  `Materia1` varchar(70) DEFAULT NULL,
  `Materia2` varchar(70) DEFAULT NULL,
  `Materia3` varchar(70) DEFAULT NULL,
  `Descripcion` varchar(250) DEFAULT NULL,
  `Correo` varchar(70) DEFAULT NULL,
  `Telefono` varchar(16) DEFAULT NULL,
  `Foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`Id_Asesor`, `Nombre_Usuario`, `Edad`, `Grado_Estudios`, `Nombres`, `A_Paterno`, `A_Materno`, `Ocupacion`, `Materia1`, `Materia2`, `Materia3`, `Descripcion`, `Correo`, `Telefono`, `Foto`) VALUES
(125, 'TakitoTime', 22, 'Universidad', 'David Guadalupe', 'Pulido', 'Valdez', 'Estudiante', 'Matematicas', 'Fisica', 'Programacion', 'Joven universitario con habilidades principalmente en matematicas, y con capacidad de enseñar a otros', '17231222@itslerdo.edu.mx', '8713975674', 'fotoasesores/asesorpro1.jpg'),
(126, 'Chinofloo', 20, 'Universidad', 'Cesar', 'Mendoza', 'Reyes', 'Estudiante', 'Programacion', 'Calculo', 'Ingles', 'Me gusta dar clases reducidas pero interactivas para poder enseñar a los alumnos a aprender por medio de  ejercicios y que logren adquirir experiencia, para poder transmitir conocimientos necesarios para aprender algun oficio', 'cesarmendoza@gmail.com', '8717887048', 'fotoasesores/asesorpro2.jpeg'),
(127, 'Gerita', 30, 'Posgrado', 'Gerardo', 'Ortiz', 'Salas', 'Arquitecto', 'Algebra Lineal', 'Termodinamica', 'Mecanica De Fluidos', 'Profesionista experto en la realizacion de obras de ingenieria, capacitado para poder asistir a jovenes en los ambitos relacionados con las matematicas.', 'gerardortiz@gmail.com', '8714685762', 'fotoasesores/face2.jpg'),
(128, 'Meny98', 21, 'Universidad', 'Manuel Alejandro', 'Herrera', 'Ceniceros', 'Estudiante', 'Contabilidad', 'Base De Datos', 'Redes', 'Lo más bello de este Mundo son las mujeres y la naturaleza.', 'ManuelAlejandroH@outlook.com', '8714038669', 'fotoasesores/asesorpro3.png'),
(129, 'Karlita23', 23, 'Universidad', 'Karla', 'Guerrero', 'Hernandez', 'Estudiante', 'Contabilidad', 'Ingles', 'Marketing', 'Soy una joven estudiante con la capacidad de emprender e inonvar con nuevas metodologias y con el estudio del mercado.', 'karlaguerrero@gmail.com', '8714440458', 'fotoasesores/face1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `Id_Bitacora` int(11) NOT NULL,
  `Correo` varchar(70) DEFAULT NULL,
  `Accion_Realizada` varchar(250) DEFAULT NULL,
  `TablaAfectada` varchar(250) DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`Id_Bitacora`, `Correo`, `Accion_Realizada`, `TablaAfectada`, `Fecha`) VALUES
(1, 'correo@correo.com', 'Se creo una cuenta con el correo correo@correo.com', 'Cuenta y Usuario', '2019-11-26'),
(2, 'felipe@mail.com', 'Se creo una cuenta con el correo felipe@mail.com', 'Cuenta y Usuario', '2019-11-26'),
(3, 'correo@correo.com', 'Se actualizaron los datos del usuario con el correo correo@correo.com', 'Usuario', '2019-11-26'),
(4, 'correo@correo.com', 'Se actualizaron los datos del usuario con el correo correo@correo.com', 'Usuario', '2019-11-26'),
(5, 'correo@correo.com', 'Se agrego una dirección de el usuario con el correo correo@correo.com', 'Direccion y Habita', '2019-11-26'),
(6, 'correo@correo.com', 'Se actualizaron los datos del usuario con el correo correo@correo.com', 'Usuario', '2019-11-26'),
(7, 'correo@correo.com', 'Se actualizaron los datos del usuario con el correo correo@correo.com', 'Usuario', '2019-11-26'),
(8, 'correo@correo.com', 'Se agrego una dirección de el usuario con el correo correo@correo.com', 'Direccion y Habita', '2019-11-26'),
(9, 'correo@correo.com', 'El usuario con el Numero De Usuario: 1Genero Una Cita con el asesor:123', 'Cita', '2019-11-26'),
(10, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-07'),
(11, 'sillapone@gmail.com', 'Se creo una cuenta con el correo sillapone@gmail.com', 'Cuenta y Usuario', '2020-02-07'),
(12, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(13, '17231222@itslerdo.edu.mx', 'El usuario con el correo:  17231222@itslerdo.edu.mxcreo una cuenta de asesor, con el nombre de usuario: Erenkiller', 'Asesor', '2020-02-07'),
(14, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(15, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(16, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(17, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(18, NULL, NULL, 'Direccion y Habita', '2020-02-07'),
(19, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(20, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(21, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(22, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(23, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(24, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(25, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(26, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(27, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(28, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(29, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(30, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(31, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(32, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(33, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(34, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(35, 'sillapone@gmail.com', 'Se agrego una dirección de el usuario con el correo sillapone@gmail.com', 'Direccion y Habita', '2020-02-07'),
(36, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(37, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(38, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(39, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(40, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(41, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(42, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(43, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(44, 'sillapone@gmail.com', 'Se actualizaron los datos del usuario con el correo sillapone@gmail.com', 'Usuario', '2020-02-07'),
(45, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-07'),
(50, 'correo@correo.com', 'El usuario con el Numero De Usuario: 1Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(51, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(52, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(53, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(54, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(55, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(56, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(57, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(58, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(59, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(60, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(61, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(62, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(63, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(64, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(65, '17231222@itlserdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itlserdo.edu.mx', 'Cuenta y Usuario', '2020-02-11'),
(66, '17231222@itlserdo.edu.mx', 'Se actualizaron los datos del usuario con el correo 17231222@itlserdo.edu.mx', 'Usuario', '2020-02-11'),
(67, '17231222@itlserdo.edu.mx', 'Se agrego una dirección de el usuario con el correo 17231222@itlserdo.edu.mx', 'Direccion y Habita', '2020-02-11'),
(68, '17231222@itlserdo.edu.mx', 'El usuario con el Numero De Usuario: 5Genero Una Cita con el asesor:123', 'Cita', '2020-02-11'),
(69, 'sillapone@gmail.com', 'El usuario con el Numero De Usuario: 4Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(70, 'david_tier@hotmail.com', 'Se creo una cuenta con el correo david_tier@hotmail.com', 'Cuenta y Usuario', '2020-02-13'),
(71, 'david_tier@hotmail.com', 'Se actualizaron los datos del usuario con el correo david_tier@hotmail.com', 'Usuario', '2020-02-13'),
(72, 'david_tier@hotmail.com', 'Se agrego una dirección de el usuario con el correo david_tier@hotmail.com', 'Direccion y Habita', '2020-02-13'),
(73, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(74, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(75, 'david_tier@hotmail.com', 'Se agrego una dirección de el usuario con el correo david_tier@hotmail.com', 'Direccion y Habita', '2020-02-13'),
(76, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(77, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(78, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(79, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(80, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(81, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-13'),
(82, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:124', 'Cita', '2020-02-13'),
(83, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:124', 'Cita', '2020-02-13'),
(84, 'prueba1@hotmail.com', 'Se creo una cuenta con el correo prueba1@hotmail.com', 'Cuenta y Usuario', '2020-02-14'),
(85, 'prueba1@hotmail.com', 'Se actualizaron los datos del usuario con el correo prueba1@hotmail.com', 'Usuario', '2020-02-14'),
(86, 'prueba1@hotmail.com', 'Se actualizaron los datos del usuario con el correo prueba1@hotmail.com', 'Usuario', '2020-02-14'),
(87, 'prueba1@hotmail.com', 'Se actualizaron los datos del usuario con el correo prueba1@hotmail.com', 'Usuario', '2020-02-14'),
(88, 'prueba1@hotmail.com', 'Se actualizaron los datos del usuario con el correo prueba1@hotmail.com', 'Usuario', '2020-02-14'),
(89, 'prueba1@hotmail.com', 'Se actualizaron los datos del usuario con el correo prueba1@hotmail.com', 'Usuario', '2020-02-14'),
(90, 'prueba1@hotmail.com', 'Se agrego una dirección de el usuario con el correo prueba1@hotmail.com', 'Direccion y Habita', '2020-02-18'),
(91, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(92, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(93, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(94, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(95, 'prueba1@hotmail.com', 'Se agrego una dirección de el usuario con el correo prueba1@hotmail.com', 'Direccion y Habita', '2020-02-21'),
(96, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(97, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(98, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(99, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(100, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(101, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(102, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(103, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(104, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(105, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(106, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(107, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(108, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(109, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(110, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(111, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(112, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(113, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(114, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(115, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(116, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(117, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(118, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(119, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(120, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(121, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(122, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(123, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(124, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(125, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(126, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(127, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(128, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(129, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(130, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(131, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(132, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(133, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(134, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(135, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(136, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(137, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(138, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(139, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(140, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(141, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(142, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(143, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(144, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(145, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(146, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(147, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(148, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(149, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(150, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(151, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(152, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(153, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(154, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(155, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(156, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(157, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(158, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(159, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(160, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(161, 'david_tier@hotmail.com', 'El usuario con el Numero De Usuario: 6Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(162, 'administrador1@gmail.com', 'Se creo una cuenta con el correo administrador1@gmail.com', 'Cuenta y Usuario', '2020-02-21'),
(163, 'administrador1@gmail.com', 'Se actualizaron los datos del usuario con el correo administrador1@gmail.com', 'Usuario', '2020-02-21'),
(164, 'administrador1@gmail.com', 'Se actualizaron los datos del usuario con el correo administrador1@gmail.com', 'Usuario', '2020-02-21'),
(165, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(166, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(167, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(168, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(169, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(170, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(171, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(172, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(173, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(174, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(175, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(176, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(177, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(178, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(179, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(180, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(181, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(182, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(183, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(184, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(185, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(186, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(187, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(188, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(189, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(190, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(191, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(192, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(193, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(194, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(195, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(196, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(197, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(198, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(199, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(200, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(201, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(202, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(203, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(204, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(205, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(206, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(207, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(208, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(209, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(210, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(211, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(212, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(213, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(214, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(215, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(216, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(217, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(218, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(219, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(220, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(221, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(222, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(223, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(224, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(225, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(226, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(227, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(228, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(229, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(230, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(231, 'prueba1@hotmail.com', 'El usuario con el Numero De Usuario: 7Genero Una Cita con el asesor:123', 'Cita', '2020-02-21'),
(232, 'davida7x77@gmail.com', 'Se creo una cuenta con el correo davida7x77@gmail.com', 'Cuenta y Usuario', '2020-02-21'),
(233, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(234, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(235, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(236, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(237, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(238, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(239, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(240, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(241, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(242, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(243, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(244, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(245, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(246, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(247, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(248, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(249, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(250, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(251, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(252, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(253, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(254, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(255, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(256, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(257, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(258, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-21'),
(259, 'sillapone@gmail.com', 'Se creo una cuenta con el correo sillapone@gmail.com', 'Cuenta y Usuario', '2020-02-24'),
(260, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-24'),
(261, 'sillapone@gmail.com', 'Se creo una cuenta con el correo sillapone@gmail.com', 'Cuenta y Usuario', '2020-02-24'),
(262, '17231222@itslerdo.edu.mx', 'Se creo una cuenta con el correo 17231222@itslerdo.edu.mx', 'Cuenta y Usuario', '2020-02-26'),
(263, '17231222@itslerdo.edu.mx', 'Se actualizaron los datos del usuario con el correo 17231222@itslerdo.edu.mx', 'Usuario', '2020-02-26'),
(264, '17231222@itslerdo.edu.mx', 'Se agrego una dirección de el usuario con el correo 17231222@itslerdo.edu.mx', 'Direccion y Habita', '2020-02-26'),
(265, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:123', 'Cita', '2020-02-26'),
(266, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:123', 'Cita', '2020-02-26'),
(267, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:123', 'Cita', '2020-02-26'),
(268, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:123', 'Cita', '2020-02-26'),
(269, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:123', 'Cita', '2020-02-26'),
(270, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:124', 'Cita', '2020-02-26'),
(271, NULL, NULL, 'Usuario', '2020-03-09'),
(272, NULL, NULL, 'Usuario', '2020-03-09'),
(273, '17231222@itslerdo.edu.mx', 'Se actualizaron los datos del usuario con el correo 17231222@itslerdo.edu.mx', 'Usuario', '2020-03-09'),
(274, '17231222@itslerdo.edu.mx', 'Se agrego una dirección de el usuario con el correo 17231222@itslerdo.edu.mx', 'Direccion y Habita', '2020-03-09'),
(275, '17231222@itslerdo.edu.mx', 'Se agrego una dirección de el usuario con el correo 17231222@itslerdo.edu.mx', 'Direccion y Habita', '2020-03-09'),
(276, '17231222@itslerdo.edu.mx', 'Se actualizaron los datos del usuario con el correo 17231222@itslerdo.edu.mx', 'Usuario', '2020-03-09'),
(277, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:123', 'Cita', '2020-03-09'),
(278, '17231222@itslerdo.edu.mx', 'El usuario con el Numero De Usuario: 39Genero Una Cita con el asesor:123', 'Cita', '2020-03-10'),
(279, '17231222@itslerdo.edu.mx', 'Se agrego una dirección de el usuario con el correo 17231222@itslerdo.edu.mx', 'Direccion y Habita', '2020-03-10'),
(280, 'administrador1@gmail.com', 'El usuario con el correo:  administrador1@gmail.comcreo una cuenta de asesor, con el nombre de usuario: TakitoTime', 'Asesor', '2020-03-10'),
(281, 'administrador1@gmail.com', 'El usuario con el correo:  administrador1@gmail.comcreo una cuenta de asesor, con el nombre de usuario: Chinofloo', 'Asesor', '2020-03-10'),
(282, 'administrador1@gmail.com', 'El usuario con el correo:  administrador1@gmail.comcreo una cuenta de asesor, con el nombre de usuario: Gerita', 'Asesor', '2020-03-10'),
(283, 'administrador1@gmail.com', 'El usuario con el correo:  administrador1@gmail.comcreo una cuenta de asesor, con el nombre de usuario: Meny98', 'Asesor', '2020-03-10'),
(284, 'administrador1@gmail.com', 'El usuario con el correo:  administrador1@gmail.comcreo una cuenta de asesor, con el nombre de usuario: Karlita23', 'Asesor', '2020-03-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `Folio` int(11) NOT NULL,
  `N_De_Usuario` int(11) DEFAULT NULL,
  `Id_Asesor` int(11) DEFAULT NULL,
  `Id_Tarjeta` int(11) DEFAULT NULL,
  `DireccionP1` varchar(200) DEFAULT NULL,
  `DireccionP2` varchar(200) DEFAULT NULL,
  `Dir_Descripcion` varchar(100) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora_Inicial` varchar(15) DEFAULT NULL,
  `Hora_Final` varchar(15) DEFAULT NULL,
  `N_De_Horas` int(11) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `Correo` varchar(70) NOT NULL,
  `Contrasena` varchar(200) DEFAULT NULL,
  `Validacion` varchar(20) DEFAULT NULL,
  `Tipo` int(11) DEFAULT NULL,
  `Activacion` tinyint(1) DEFAULT NULL,
  `Codigo_Activacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`Correo`, `Contrasena`, `Validacion`, `Tipo`, `Activacion`, `Codigo_Activacion`) VALUES
('17231222@itslerdo.edu.mx', '8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e', 'Validada', 2, 1, 2422),
('administrador1@gmail.com', '8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e', 'Validada', 1, NULL, NULL),
('correo@correo.com', '123', 'Validada', NULL, NULL, NULL),
('davida7x77@gmail.com', '8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e', 'Validada', 1, 0, 1478),
('david_tier@hotmail.com', '8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e', 'Validada', NULL, NULL, NULL),
('felipe@mail.com', '123', 'Validada', NULL, NULL, NULL),
('prueba1@hotmail.com', '8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e', 'Validada', NULL, NULL, NULL),
('sillapone@gmail.com', '8ebd873aea90b4acc4a44be4085fadf938734e04f071bb2ba622ce9aefc3d55bb09de4e15c424e86896ccd64de326717b5d718439159ff89b45da9730583288e', 'Validada', 2, 1, 4291);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `Id_Direccion` int(11) NOT NULL,
  `Pais` varchar(30) DEFAULT NULL,
  `Estado` varchar(30) DEFAULT NULL,
  `Ciudad` varchar(30) DEFAULT NULL,
  `Colonia` varchar(50) DEFAULT NULL,
  `Calle` varchar(50) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Codigo_Postal` int(11) DEFAULT NULL,
  `Descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`Id_Direccion`, `Pais`, `Estado`, `Ciudad`, `Colonia`, `Calle`, `Numero`, `Codigo_Postal`, `Descripcion`) VALUES
(1, 'Mexico', 'Durango', 'Lerdo', 'San Isidro', 'Mapimi ', 5, 35159, 'Casa mia'),
(8, 'MÃ©xico', 'DGO', 'Lerdo', '#103', 'Calle Mina', 0, 35154, ''),
(19, 'MÃ©xico', 'DGO', 'Lerdo', '#103', 'Calle Mina', 0, 35154, ''),
(20, 'MÃ©xico', 'DGO', 'Lerdo', '#103', 'Calle Mina', 0, 35154, 'hola k ase'),
(22, 'MÃ©xico', 'Durango', 'Gomez Palacio', 'Hortencias', 'Hector Espino', 185, 35043, 'Fachada Verde, Porton Azul Rey'),
(24, 'Mexico', 'Durango', 'Gomez Palacio', 'Hortencias', 'Hector Espino', 288, 35043, 'Fachada Verde. Porton Azul'),
(25, 'Mexico', 'Durango', 'Gomez Palacio', 'Hortencias', 'Hector Espino', 288, 35043, 'Fachada Verde, Porton Azul, Arboles Enfrente'),
(26, 'Mexico', 'Durango', 'Gomez Palacio', 'Hortencias', 'Hector Espino', 288, 35043, 'Fachada Verde, Porton Azul, Arboles Enfrente'),
(27, 'Mexico', 'Durango', 'Gomez Palacio', 'Hortencias', 'Hector Espino', 185, 35043, 'Fachada verde, porton azul, 2 arboles enfrente'),
(28, 'Mexico', 'Durango', 'Gomez Palacio', 'Hortencias', 'Hector Espino', 288, 35043, 'Fachada Verde. Porton Azul'),
(30, 'Mexico', 'Durango', 'Gomez Palacio', 'Hortencias', 'Hector Espino', 195, 35043, 'Fachada Verde. Porton Azul');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habita`
--

CREATE TABLE `habita` (
  `N_De_Usuario` int(11) DEFAULT NULL,
  `Id_Direccion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `habita`
--

INSERT INTO `habita` (`N_De_Usuario`, `Id_Direccion`) VALUES
(1, 1),
(NULL, 8),
(6, 24),
(7, 25),
(7, 26),
(39, 27),
(39, 28),
(39, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `Id_Precio` int(11) NOT NULL,
  `Costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`Id_Precio`, `Costo`) VALUES
(1, '100.00'),
(2, '200.00'),
(3, '250.00'),
(4, '300.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `N_De_Usuario` int(11) NOT NULL,
  `Correo` varchar(70) DEFAULT NULL,
  `Nombres` varchar(50) DEFAULT NULL,
  `A_Paterno` varchar(20) DEFAULT NULL,
  `A_Materno` varchar(20) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Telefono` varchar(16) DEFAULT NULL,
  `Foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`N_De_Usuario`, `Correo`, `Nombres`, `A_Paterno`, `A_Materno`, `Edad`, `Telefono`, `Foto`) VALUES
(1, 'correo@correo.com', 'Juan', 'Perez', 'Perez', 189, '871237182', 'fotosusuarios/rj01400-01-thumbnail-1080x1080-70.jpg'),
(2, 'felipe@mail.com', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'david_tier@hotmail.com', 'David Guadalupe', 'Pulido', 'Valdez', 22, '8713975674', 'fotosusuarios/pp.jpg'),
(7, 'prueba1@hotmail.com', 'David Guadalupe', 'Pulido', 'Valdez', 22, '8713975674', 'fotosusuarios/WhatsApp Image 2019-11-26 at 13.18.51.jpeg'),
(8, 'administrador1@gmail.com', 'David Guadalupe', 'Pulido', 'Valdez', 22, '8713975674', 'fotosusuarios/44407397_2031437606920368_5591387600746184704_n.jpg'),
(9, 'davida7x77@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'sillapone@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL),
(39, '17231222@itslerdo.edu.mx', 'David Guadalupe', 'Pulido', 'Valdez', 22, '8713975674', 'fotosusuarios/26171846_1670030629727736_6166157510929192402_o.jpg');

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `ValidarCuenta` AFTER UPDATE ON `usuario` FOR EACH ROW Update Cuenta set Validacion='Validada'
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`Id_Asesor`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`Id_Bitacora`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`Folio`),
  ADD KEY `cita_ibfk_1` (`N_De_Usuario`),
  ADD KEY `cita_ibfk_2` (`Id_Asesor`),
  ADD KEY `cita_ibfk_3` (`Id_Tarjeta`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`Correo`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`Id_Direccion`);

--
-- Indices de la tabla `habita`
--
ALTER TABLE `habita`
  ADD KEY `N_De_Usuario` (`N_De_Usuario`),
  ADD KEY `Id_Direccion` (`Id_Direccion`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`Id_Precio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`N_De_Usuario`),
  ADD KEY `Correo` (`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asesor`
--
ALTER TABLE `asesor`
  MODIFY `Id_Asesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `Id_Bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `Folio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `Id_Direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `Id_Precio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `N_De_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`N_De_Usuario`) REFERENCES `usuario` (`N_De_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`Id_Asesor`) REFERENCES `asesor` (`Id_Asesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`Id_Tarjeta`) REFERENCES `tarjeta` (`Id_Tarjeta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `habita`
--
ALTER TABLE `habita`
  ADD CONSTRAINT `habita_ibfk_1` FOREIGN KEY (`N_De_Usuario`) REFERENCES `usuario` (`N_De_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `habita_ibfk_2` FOREIGN KEY (`Id_Direccion`) REFERENCES `direccion` (`Id_Direccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Correo`) REFERENCES `cuenta` (`Correo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
