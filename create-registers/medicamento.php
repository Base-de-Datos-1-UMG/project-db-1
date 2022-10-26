<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//Incluir el archivo de conexion
	include_once("../includes/connection.php");

	//Obtenemos el contenido de cada input en el formulario
	$nombre = $_POST['nombre'];
	$precio = $_POST['precio'];
	$lote = $_POST['lote'];


	//concatenamos cada variable en el insert
	$sql = "INSERT INTO MEDICAMENTO (IDMEDICAMENTO,NOMBRE_MEDICAMENTO)
			VALUES (1, '".$nombre."')";

	$sql3 = "INSERT INTO MEDICAMENTO_X_LABORATORIO (PRECIO_MEDICAMENTO,LOTE_MEDICAMENTO)
	        VALUES ('".$precio."', '".$lote."')";
	//se realiza commit
	$sql2 = "COMMIT";

	//creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid2 = oci_parse($conn, $sql2);
	$stid3 = oci_parse($conn, $sql3);

	//ejecutamos los 2 codigos sql
	oci_execute($stid);
	oci_execute($stid3);
	oci_execute($stid2);

	//cerramos conexiones
	oci_free_statement($stid);
	oci_free_statement($stid2);
	oci_free_statement($stid3);
	oci_close($conn);

	echo $sql;

	//regresar al archivo de ingresar medicamento
	header('Location: ../view-registers/medicamentos.html');

?>