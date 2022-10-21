<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//Incluir el archivo de conexion
	include_once("../includes/connection.php");

	//Obtenemos el contenido de cada input en el formulario
	$nombre = $_POST['nombre'];
	$segnombre = $_POST['segnombre'];
	$apellido = $_POST['apellido'];
	$segapellido = $_POST['segapellido'];
	$nit = $_POST['nit'];
	$dpi = $_POST['dpi'];
	$password = $_POST['password'];
	$carnet = $_POST['carnet'];
	$genero = $_POST['genero'];

	//concatenamos cada variable en el insert
	$sql = "INSERT INTO PERSONA (IDPERSONA,NOMBRE1,NOMBRE2,APELLIDO1,APELLIDO2,NIT,DPI,GENERO,CARNET)
			VALUES (IDPERSONA.NEXTVAL, '".$nombre."', '".$segnombre."', '".$apellido."', '".$segapellido."', '".$nit."', '".$dpi."', '".$genero."', '".$carnet."')";
	//se realiza commit
	$sql2 = "COMMIT";

	//creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid2 = oci_parse($conn, $sql2);

	//ejecutamos los 2 codigos sql
	oci_execute($stid);
	oci_execute($stid2);

	//cerramos conexiones
	oci_free_statement($stid);
	oci_free_statement($stid2);
	oci_close($conn);

	echo $sql;

	//regresar al archivo de ingresar usuario
	header('Location: ./create_user.html');

?>