-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2021 a las 04:58:04
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `activarCaso` (IN `Id_NoExpedienteP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		UPDATE caso SET Estatus = 'Activo' WHERE Id_NoExpediente = Id_NoExpedienteP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarCaso` (IN `JuzgadoP` VARCHAR(45), IN `EstatusP` VARCHAR(45), IN `MateriaP` VARCHAR(45), IN `CostoP` INT(11), IN `DiaP` INT(11), IN `MesP` INT(11), IN `AnioP` INT(11), IN `Id_ClientesP` INT(11), IN `Id_NoEmpleadoP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		INSERT INTO caso(Juzgado, Estatus, Materia, Costo, DiaR, MesR, AnioR, Id_Clientes, Id_NoEmpleado) VALUES(JuzgadoP, EstatusP, MateriaP, CostoP, DiaP, MesP, AnioP, Id_ClientesP, Id_NoEmpleadoP);

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarClientes` (IN `NomP` VARCHAR(60), IN `ApePP` VARCHAR(60), IN `ApeMP` VARCHAR(60), IN `CiudadP` VARCHAR(45), IN `EstadoP` VARCHAR(45), IN `CalleP` VARCHAR(45), IN `numCasaP` INT(11), IN `ColoniaP` VARCHAR(45), IN `EmailP` VARCHAR(45), IN `TelefonoP` CHAR(10), IN `EdadP` INT(11), IN `CurpP` CHAR(18), IN `OcupacionP` VARCHAR(45), IN `SexoP` CHAR(1), IN `DiaP` INT(11), IN `MesP` INT(11), IN `AnioP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		INSERT INTO clientes(Nom, ApeP, ApeM, Ciudad, Estado, Calle, NumCasa, Colonia, Email, Telefono, Edad ,CURP, Ocupacion, Sexo, diaN, MesN, AnioN) VALUES(

		NomP, ApePP, ApeMP,CiudadP, EstadoP,CalleP, numCasaP, ColoniaP, EmailP, TelefonoP, EdadP, CurpP, OcupacionP,SexoP,DiaP, MesP,AnioP);

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarDocCaso` (IN `Id_NoExpedienteP` INT(11), IN `URL_DocP` VARCHAR(200), IN `Nombre_DocP` VARCHAR(80))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		INSERT INTO doccaso(Id_NoExpediente, URL_Doc, Nombre_Doc) VALUES (Id_NoExpedienteP, URL_DocP, Nombre_DocP);

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarDocClientes` (IN `com` VARCHAR(200), IN `ine` VARCHAR(200), IN `acta` VARCHAR(200), IN `Id_ClientesP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		INSERT INTO doccliente(Doc_ComDom, Doc_INE, Doc_ActaN, Id_Clientes) VALUES (com, ine, acta, Id_ClientesP);

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarEmpleado` (IN `NomP` VARCHAR(60), IN `ApePP` VARCHAR(60), IN `ApeMP` VARCHAR(60), IN `CiudadP` VARCHAR(45), IN `EstadoP` VARCHAR(45), IN `CalleP` VARCHAR(45), IN `numCasaP` INT(11), IN `ColoniaP` VARCHAR(45), IN `TelefonoP` CHAR(10), IN `EdadP` INT(11), IN `CurpP` CHAR(18), IN `EspecialidadP` VARCHAR(45), IN `SexoP` CHAR(1))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		INSERT INTO empleado(Nom, ApeP, ApeM, Edad, Sexo, NumCasa, Calle, Colonia, Telefono, Curp, Ciudad, Estado, Especialidad) VALUES(

		NomP, ApePP, ApeMP,EdadP,SexoP ,NumCasaP, CalleP, ColoniaP, TelefonoP, CurpP, CiudadP ,EstadoP, EspecialidadP);

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `archivarCaso` (IN `Id_NoExpedienteP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		UPDATE caso SET Estatus = 'Archivado' WHERE Id_NoExpediente = Id_NoExpedienteP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaCasoAct` (IN `Id_NoExpedienteP` INT(11))  SQL SECURITY INVOKER
BEGIN

	SELECT * FROM caso WHERE Id_NoExpediente = Id_NoExpedienteP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaCasos` (IN `EstatusP` VARCHAR(40))  SQL SECURITY INVOKER
BEGIN

	SELECT empleado.Nom as NomE, empleado.ApeP as ApePE, clientes.Nom, clientes.ApeP, Juzgado, Materia, Costo, DiaR, MesR, AnioR, Id_NoExpediente FROM caso JOIN clientes 

	on clientes.Id_Clientes = caso.Id_Clientes JOIN empleado ON empleado.Id_NoEmpleado= caso.Id_NoEmpleado WHERE Estatus = EstatusP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaCasosXClientes` ()  SQL SECURITY INVOKER
BEGIN

	SELECT Juzgado, Estatus, Nom, ApeP, Apem, Costo, Materia, DiaR, MesR, AnioR FROM Caso JOIN Clientes on Caso.Id_Clientes = Clientes.Id_Clientes;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaCli` (IN `Id_ClientesP` INT(11))  SQL SECURITY INVOKER
BEGIN

	SELECT * FROM Clientes WHERE Id_Clientes = Id_ClientesP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaClientes` ()  SQL SECURITY INVOKER
BEGIN

	SELECT Id_Clientes, Nom, ApeP, ApeM, Ciudad, Estado

	,Calle, NumCasa, Colonia, Email, Telefono, Curp 

	FROM Clientes;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaDocCaso` (IN `Id_NoExpedienteP` INT(11), IN `Nombre_DocP` VARCHAR(80))  SQL SECURITY INVOKER
BEGIN

	SELECT * FROM doccaso WHERE Id_NoExpediente = Id_NoExpedienteP AND Nombre_Doc= Nombre_DocP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaDocCliente` (IN `Id_ClientesP` INT(11))  SQL SECURITY INVOKER
BEGIN

	SELECT * FROM doccliente WHERE Id_Clientes = Id_ClientesP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaEmp` (IN `Id_NoEmpleadoP` INT(11))  SQL SECURITY INVOKER
BEGIN

	SELECT * FROM empleado WHERE Id_NoEmpleado = Id_NoEmpleadoP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaEmpleados` ()  SQL SECURITY INVOKER
BEGIN

	SELECT Id_NoEmpleado, Nom, ApeP, ApeM, Ciudad, Estado, Telefono, CURP, Colonia, Especialidad, Calle, NumCasa FROM empleado;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaIdCliente` (IN `NomP` VARCHAR(60))  SQL SECURITY INVOKER
BEGIN

	SELECT Id_Clientes FROM clientes where Nom = NomP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaIdDocCliente` (IN `Id_ClientesP` INT(11))  SQL SECURITY INVOKER
BEGIN

	SELECT Id_DocCliente FROM doccliente WHERE Id_Clientes = Id_ClientesP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaTodDocCaso` (IN `Id_NoExpedienteP` INT(11))  SQL SECURITY INVOKER
BEGIN

	SELECT * FROM doccaso WHERE Id_NoExpediente = Id_NoExpedienteP;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaUsuarios` (IN `EmailP` VARCHAR(60))  NO SQL
    SQL SECURITY INVOKER
BEGIN
SELECT * FROM usuarios WHERE Email = EmailP;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarCaso` (IN `Id_NoExpedienteP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		DELETE FROM caso where Id_NoExpediente = Id_NoExpedienteP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarCliente` (IN `Id_ClientesP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		DELETE FROM clientes WHERE Id_Clientes = Id_ClientesP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarDocCaso` (IN `Id_DocCasoP` INT(11), IN `Nombre_DocP` VARCHAR(80))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		DELETE FROM doccaso WHERE Id_DocCaso = Id_DocCasoP AND Nombre_Doc=Nombre_DocP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarDocCliente` (IN `Id_DocClienteP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		DELETE FROM doccliente WHERE Id_DocCliente = Id_DocClienteP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarEmpleado` (IN `Id_NoEmpleadoP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		DELETE FROM empleado WHERE Id_NoEmpleado = Id_NoEmpleadoP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarCaso` (IN `Id_NoExpedienteP` INT(11), IN `JuzgadoP` VARCHAR(45), IN `EstatusP` VARCHAR(45), IN `MateriaP` VARCHAR(45), IN `CostoP` INT(11), IN `DiaP` INT(11), IN `MesP` INT(11), IN `AnioP` INT(11), IN `Id_ClientesP` INT(11), IN `Id_NoEmpleadoP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		UPDATE caso SET Juzgado = JuzgadoP, Estatus=EstatusP, Materia = MateriaP, DiaR=DiaP, MesR=MesP, AnioR=AnioP, Id_Clientes=Id_ClientesP, Id_NoEmpleado=Id_NoEmpleadoP 

		WHERE Id_NoExpediente = Id_NoExpedienteP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarClientes` (IN `NomP` VARCHAR(60), IN `ApePP` VARCHAR(60), IN `ApeMP` VARCHAR(60), IN `CiudadP` VARCHAR(45), IN `EstadoP` VARCHAR(45), IN `CalleP` VARCHAR(45), IN `numCasaP` INT(11), IN `ColoniaP` VARCHAR(45), IN `EmailP` VARCHAR(45), IN `TelefonoP` CHAR(10), IN `EdadP` INT(11), IN `CurpP` CHAR(18), IN `OcupacionP` VARCHAR(45), IN `SexoP` CHAR(1), IN `DiaP` INT(11), IN `MesP` INT(11), IN `AnioP` INT(11), IN `Id_ClientesP` INT(11))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		UPDATE clientes SET Nom =NomP, ApeP= ApePP, ApeM= ApeMP, Ciudad=CiudadP, Estado = EstadoP, Calle=CalleP, NumCasa=NumCasaP,Colonia=ColoniaP, Email=EmailP,

		Telefono=TelefonoP, Edad=EdadP ,CURP=CurpP, Ocupacion=OcupacionP, Sexo=SexoP, diaN=DiaP, MesN = MesP, AnioN=AnioP WHERE Id_Clientes = Id_ClientesP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarDocClientes` (IN `Id_DocClienteP` INT(11), IN `com` VARCHAR(200), IN `ine` VARCHAR(200), IN `acta` VARCHAR(200))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		UPDATE doccliente set Doc_ComDom = com, Doc_INE = ine, Doc_ActaN=acta WHERE Id_DocCliente = Id_DocClienteP;

	COMMIT; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarEmpleados` (IN `Id_NoEmpleadoP` INT(11), IN `NomP` VARCHAR(60), IN `ApePP` VARCHAR(60), IN `ApeMP` VARCHAR(60), IN `CiudadP` VARCHAR(45), IN `EstadoP` VARCHAR(45), IN `CalleP` VARCHAR(45), IN `numCasaP` INT(11), IN `ColoniaP` VARCHAR(45), IN `TelefonoP` CHAR(10), IN `EdadP` INT(11), IN `CurpP` CHAR(18), IN `EspecialidadP` VARCHAR(45), IN `SexoP` CHAR(1))  SQL SECURITY INVOKER
BEGIN 

	DECLARE exit handler for sqlexception 

	BEGIN -- ERROR 

		ROLLBACK; 

	END; 

	DECLARE exit handler for sqlwarning 

	BEGIN -- WARNING 

		ROLLBACK; 

	END; 

	START TRANSACTION; 

		UPDATE empleado SET Nom =NomP, ApeP= ApePP, ApeM= ApeMP, Ciudad=CiudadP, Estado = EstadoP, Calle=CalleP, NumCasa=NumCasaP,Colonia=ColoniaP,Telefono=TelefonoP, Edad=EdadP ,CURP=CurpP, Especialidad=EspecialidadP, Sexo=SexoP WHERE Id_NoEmpleado = Id_NoEmpleadoP;

	COMMIT; 

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caso`
--

CREATE TABLE `caso` (
  `Id_NoExpediente` int(11) NOT NULL,
  `Juzgado` varchar(45) NOT NULL,
  `Estatus` varchar(45) NOT NULL,
  `Materia` varchar(45) NOT NULL,
  `Costo` int(11) NOT NULL,
  `DiaR` int(11) NOT NULL,
  `MesR` int(11) NOT NULL,
  `AnioR` int(11) NOT NULL,
  `Id_Clientes` int(11) NOT NULL,
  `Id_NoEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caso`
--

INSERT INTO `caso` (`Id_NoExpediente`, `Juzgado`, `Estatus`, `Materia`, `Costo`, `DiaR`, `MesR`, `AnioR`, `Id_Clientes`, `Id_NoEmpleado`) VALUES
(1, 'Primero', 'Archivado', 'Matrimonial', 6000, 12, 6, 2021, 15, 1),
(3, 'Segundo', 'Activo', 'Penal', 20000, 5, 11, 2020, 17, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id_Clientes` int(11) NOT NULL,
  `Nom` varchar(60) NOT NULL,
  `ApeP` varchar(60) NOT NULL,
  `ApeM` varchar(60) NOT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Calle` varchar(45) NOT NULL,
  `NumCasa` int(11) NOT NULL,
  `Colonia` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Telefono` char(10) NOT NULL,
  `Edad` int(11) NOT NULL,
  `CURP` char(18) NOT NULL,
  `Ocupacion` varchar(45) DEFAULT NULL,
  `Sexo` char(1) NOT NULL,
  `diaN` int(11) NOT NULL,
  `MesN` int(11) NOT NULL,
  `AnioN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id_Clientes`, `Nom`, `ApeP`, `ApeM`, `Ciudad`, `Estado`, `Calle`, `NumCasa`, `Colonia`, `Email`, `Telefono`, `Edad`, `CURP`, `Ocupacion`, `Sexo`, `diaN`, `MesN`, `AnioN`) VALUES
(15, 'Fernando', 'Brambila', 'Rivera', 'Autlan', 'Jalisco', 'Diego Rivera', 216, 'Maderera', 'jfernando_410@hotmail.com', '3171124717', 21, 'BARJ001220MJCRVLA0', 'Ingeniero', 'M', 4, 10, 1999),
(17, 'Mariana ', 'Gonzalez ', 'Rivera', 'Manzanillo', 'Colima', 'Morelos', 78, 'Centro', 'angelesbrambila@hotmail.com', '314125984', 25, 'BARJ001220MJCRVLA0', 'Ingeniera', 'F', 4, 4, 1996);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doccaso`
--

CREATE TABLE `doccaso` (
  `Id_DocCaso` int(11) NOT NULL,
  `Id_NoExpediente` int(11) NOT NULL,
  `URL_Doc` varchar(200) NOT NULL,
  `Nombre_Doc` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `doccaso`
--

INSERT INTO `doccaso` (`Id_DocCaso`, `Id_NoExpediente`, `URL_Doc`, `Nombre_Doc`) VALUES
(12, 1, 'Factura.pdf', 'Factura'),
(14, 3, 'ComprobanteDedomicilio.docx', 'ComprobanteDedomicilio'),
(15, 1, 'ActadeMatrimonio.docx', 'ActadeMatrimonio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doccliente`
--

CREATE TABLE `doccliente` (
  `Id_DocCliente` int(11) NOT NULL,
  `Doc_ComDom` varchar(200) NOT NULL,
  `Doc_INE` varchar(200) NOT NULL,
  `Doc_ActaN` varchar(200) NOT NULL,
  `Id_Clientes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `doccliente`
--

INSERT INTO `doccliente` (`Id_DocCliente`, `Doc_ComDom`, `Doc_INE`, `Doc_ActaN`, `Id_Clientes`) VALUES
(2, '3.3 Transformada Inversa de Laplace .docx', '1.6_BrambilaRivera_JuanFernando.pdf', 'Actividad 3 Principios ElectrÃ³nicos y Aplicaciones digitales.pdf', 15),
(4, '2Âª5.pdf', 'look.java', 'BrambilaRivera_JuanFernando_PracGraf5.rar', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `Id_NoEmpleado` int(11) NOT NULL,
  `Nom` varchar(60) NOT NULL,
  `ApeP` varchar(60) NOT NULL,
  `ApeM` varchar(60) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Sexo` char(1) NOT NULL,
  `NumCasa` int(11) NOT NULL,
  `Calle` varchar(45) NOT NULL,
  `Colonia` varchar(45) NOT NULL,
  `Telefono` char(10) NOT NULL,
  `Curp` char(18) NOT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Especialidad` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`Id_NoEmpleado`, `Nom`, `ApeP`, `ApeM`, `Edad`, `Sexo`, `NumCasa`, `Calle`, `Colonia`, `Telefono`, `Curp`, `Ciudad`, `Estado`, `Especialidad`) VALUES
(1, 'Jose Eduardo', 'Pena', 'Jimenez', 22, 'M', 21, 'San Francisco ', 'Providencia ', '3411234895', 'BARJ001220MJCRVLA0', 'Cd Guzman', 'Jalisco', 'Juridico'),
(3, 'Fernanda', 'Martinez', 'Garcia', 27, 'F', 45, 'Ramon Corona ', 'Centro', '3171124717', 'BARJ001220MJCRVLA3', 'Autlan', 'Jalisco', 'Matrimonial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuarios` int(11) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuarios`, `Email`, `Password`) VALUES
(1, 'fer-410@live.com.mx', '$2y$10$fahkcKXsLqf8AVbq2CtGEOgzMLGO8LRbqnf/DJwumPtv5RSXcULnG'),
(2, 'jose@live.com.mx', '$2y$10$WTAGWTDrGSo/IvgUoEIX8u0H8YNCO38MvzV2/9obqQzTC61ys3mPi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caso`
--
ALTER TABLE `caso`
  ADD PRIMARY KEY (`Id_NoExpediente`),
  ADD KEY `FK_Clientes_idx` (`Id_Clientes`),
  ADD KEY `FK_Empleado_idx` (`Id_NoEmpleado`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id_Clientes`);

--
-- Indices de la tabla `doccaso`
--
ALTER TABLE `doccaso`
  ADD PRIMARY KEY (`Id_DocCaso`),
  ADD KEY `FK_Caso_idx` (`Id_NoExpediente`);

--
-- Indices de la tabla `doccliente`
--
ALTER TABLE `doccliente`
  ADD PRIMARY KEY (`Id_DocCliente`),
  ADD KEY `FK_idClientes_idx` (`Id_Clientes`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`Id_NoEmpleado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caso`
--
ALTER TABLE `caso`
  MODIFY `Id_NoExpediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `Id_Clientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `doccaso`
--
ALTER TABLE `doccaso`
  MODIFY `Id_DocCaso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `doccliente`
--
ALTER TABLE `doccliente`
  MODIFY `Id_DocCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `Id_NoEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caso`
--
ALTER TABLE `caso`
  ADD CONSTRAINT `FK_Clientes` FOREIGN KEY (`Id_Clientes`) REFERENCES `clientes` (`Id_Clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Empleado` FOREIGN KEY (`Id_NoEmpleado`) REFERENCES `empleado` (`Id_NoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `doccaso`
--
ALTER TABLE `doccaso`
  ADD CONSTRAINT `FK_Caso` FOREIGN KEY (`Id_NoExpediente`) REFERENCES `caso` (`Id_NoExpediente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `doccliente`
--
ALTER TABLE `doccliente`
  ADD CONSTRAINT `FK_idClientes` FOREIGN KEY (`Id_Clientes`) REFERENCES `clientes` (`Id_Clientes`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
