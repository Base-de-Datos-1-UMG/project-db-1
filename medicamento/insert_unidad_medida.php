<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//Incluir el archivo de conexion
	include_once("../includes/session.php");

	//Obtenemos el contenido de cada input en el formulario
	$nombre = $_POST['unidad'];

	//concatenamos cada variable en el insert
	$sql = "INSERT INTO UNIDAD_MEDIDA (IDUNIDAD_MEDIDA, UNIDAD_MEDIDA) VALUES (IDUNIDAD_MEDIDA.NEXTVAL, '".$nombre."')";
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

	//regresar al archivo de ingresar medicamento
	header('Location: ./unidad_medida.html');

?>