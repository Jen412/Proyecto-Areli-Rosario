
CREATE PROCEDURE activarCaso(IN Id_NoExpedienteP INT(11))
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
END;
 #Agregar Caso
CREATE PROCEDURE agregarCaso(IN JuzgadoP VARCHAR(45), IN EstatusP VARCHAR(45), IN MateriaP VARCHAR(45), IN CostoP INT(11), IN DiaP INT(11), 
IN MesP INT(11), IN AnioP INT(11), IN Id_ClientesP INT(11),Id_NoEmpleadoP INT(11))
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
END;
#Agregar Clientes
CREATE PROCEDURE agregarClientes (IN NomP VARCHAR(60), IN ApePP VARCHAR(60), IN ApeMP VARCHAR(60), IN CiudadP VARCHAR(45), IN EstadoP VARCHAR(45),
IN CalleP VARCHAR(45), IN numCasaP INT(11), IN ColoniaP VARCHAR(45), IN EmailP VARCHAR(45), IN TelefonoP CHAR(10), IN EdadP INT(11), IN CurpP CHAR(18), IN OcupacionP VARCHAR(45),
IN SexoP CHAR(1),  IN DiaP INT(11), IN MesP INT(11), IN AnioP INT(11))
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
END

#agregar documento de caso
CREATE PROCEDURE agregarDocCaso(IN Id_NoExpedienteP INT(11), IN URL_DocP VARCHAR(200), IN Nombre_DocP VARCHAR(80))
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
END;

#agregar Documentos cliente

CREATE PROCEDURE agregarDocClientes(IN com VARCHAR(200) ,IN ine VARCHAR(200), IN acta VARCHAR(200), IN Id_ClientesP INT(11))
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
END

#agregar Empleado
CREATE PROCEDURE agregarEmpleado(IN NomP VARCHAR(60), IN ApePP VARCHAR(60), IN ApeMP VARCHAR(60), IN CiudadP VARCHAR(45), IN EstadoP VARCHAR(45),IN CalleP VARCHAR(45), IN numCasaP INT(11), 
IN ColoniaP VARCHAR(45), IN TelefonoP CHAR(10), IN EdadP INT(11), IN CurpP CHAR(18), IN EspecialidadP VARCHAR(45), IN SexoP CHAR(1))
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
END
#activar caso
CREATE  PROCEDURE archivarCaso(IN Id_NoExpedienteP INT(11))
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
END

#Consultas
CREATE  PROCEDURE consultaCasoAct(IN Id_NoExpedienteP INT(11))
BEGIN
	SELECT * FROM caso WHERE Id_NoExpediente = Id_NoExpedienteP;
END

CREATE PROCEDURE consultaCasos(IN EstatusP VARCHAR(40))
BEGIN
	SELECT empleado.Nom as NomE, empleado.ApeP as ApePE, clientes.Nom, clientes.ApeP, Juzgado, Materia, Costo, DiaR, MesR, AnioR, Id_NoExpediente FROM caso JOIN clientes 
	on clientes.Id_Clientes = caso.Id_Clientes JOIN empleado ON empleado.Id_NoEmpleado= caso.Id_NoEmpleado WHERE Estatus = EstatusP;
END

CREATE PROCEDURE consultaCasosXClientes()
BEGIN
	SELECT Juzgado, Estatus, Nom, ApeP, Apem, Costo, Materia, DiaR, MesR, AnioR FROM Caso JOIN Clientes on Caso.Id_Clientes = Clientes.Id_Clientes;
END

CREATE PROCEDURE consultaCli(IN Id_ClientesP INT(11))
BEGIN
	SELECT * FROM Clientes WHERE Id_Clientes = Id_ClientesP;
END

CREATE PROCEDURE consultaClientes()
BEGIN
	SELECT Id_Clientes, Nom, ApeP, ApeM, Ciudad, Estado
	,Calle, NumCasa, Colonia, Email, Telefono, Curp 
	FROM Clientes;
END

CREATE PROCEDURE consultaDocCaso(IN Id_NoExpedienteP INT(11), IN Nombre_DocP VARCHAR(80))
BEGIN
	SELECT * FROM doccaso WHERE Id_NoExpediente = Id_NoExpedienteP AND Nombre_Doc= Nombre_DocP;
END

CREATE PROCEDURE consultaDocCliente(IN Id_ClientesP INT(11))
BEGIN
	SELECT * FROM doccliente WHERE Id_Clientes = Id_ClientesP;
END

CREATE PROCEDURE consultaEmp(IN Id_NoEmpleadoP INT(11))
BEGIN
	SELECT * FROM empleado WHERE Id_NoEmpleado = Id_NoEmpleadoP;
END

CREATE PROCEDURE consultaEmpleados()
BEGIN
	SELECT Id_NoEmpleado, Nom, ApeP, ApeM, Ciudad, Estado, Telefono, CURP, Colonia, Especialidad, Calle, NumCasa FROM empleado;
END

CREATE PROCEDURE consultaIdCliente(IN NomP VARCHAR(60))
BEGIN
	SELECT Id_Clientes FROM clientes where Nom = NomP;
END

CREATE PROCEDURE consultaIdDocCliente(IN Id_ClientesP INT(11))
BEGIN
	SELECT Id_DocCliente FROM doccliente WHERE Id_Clientes = Id_ClientesP;
END

CREATE PROCEDURE consultaTodDocCaso(IN Id_NoExpedienteP INT(11))
BEGIN
	SELECT * FROM doccaso WHERE Id_NoExpediente = Id_NoExpedienteP;
END

CREATE PROCEDURE consultaUsuarios(IN EmailP VARCHAR(60))
BEGIN
	SELECT * FROM usuarios WHERE Email = EmailP;
END

#Eliminar caso
CREATE PROCEDURE eliminarCaso(IN Id_NoExpedienteP INT(11))
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
END

#Eliminar Cliente
CREATE PROCEDURE eliminarCliente(IN Id_ClientesP INT(11))
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
END

#Eliminar Docoumento de caso
CREATE DEFINER=`FernandoB`@`%` PROCEDURE `EliminarDocCaso`(IN Id_DocCasoP INT(11), IN Nombre_DocP VARCHAR(80))
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
END

#Eliminar Documuentos de Cliente
CREATE PROCEDURE eliminarDocCliente(IN Id_DocClienteP INT(11))
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
END

#Eliminar Empleado

CREATE PROCEDURE eliminarEmpleado(IN Id_NoEmpleadoP INT(11))
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
END

#Modificar Caso
CREATE PROCEDURE modificarCaso(IN Id_NoExpedienteP INT(11), IN JuzgadoP VARCHAR(45), IN EstatusP VARCHAR(45), IN MateriaP VARCHAR(45), IN CostoP INT(11), IN DiaP INT(11), IN MesP INT(11), IN AnioP INT(11), IN Id_ClientesP INT(11), IN Id_NoEmpleadoP INT(11))
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
END

#Modificar Doc cliente
CREATE PROCEDURE modificarDocClientes(IN Id_DocClienteP INT(11), IN com VARCHAR(200) ,IN ine VARCHAR(200), IN acta VARCHAR(200))
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
END

#Modificar Empleado
CREATE PROCEDURE modificarEmpleados(IN Id_NoEmpleadoP INT(11),IN NomP VARCHAR(60), IN ApePP VARCHAR(60), IN ApeMP VARCHAR(60), IN CiudadP VARCHAR(45), IN EstadoP VARCHAR(45),IN CalleP VARCHAR(45), IN numCasaP INT(11),IN ColoniaP VARCHAR(45), IN TelefonoP CHAR(10), IN EdadP INT(11), IN CurpP CHAR(18), IN EspecialidadP VARCHAR(45), IN SexoP CHAR(1))
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
END

#Modificar Cliente
CREATE PROCEDURE modificarClientes(IN NomP VARCHAR(60), IN ApePP VARCHAR(60), IN ApeMP VARCHAR(60), IN CiudadP VARCHAR(45), IN EstadoP VARCHAR(45),
IN CalleP VARCHAR(45), IN numCasaP INT(11), IN ColoniaP VARCHAR(45), IN EmailP VARCHAR(45), IN TelefonoP CHAR(10), IN EdadP INT(11), IN CurpP CHAR(18), IN OcupacionP VARCHAR(45),
IN SexoP CHAR(1),  IN DiaP INT(11), IN MesP INT(11), IN AnioP INT(11), IN Id_ClientesP INT(11))
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
END