<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//Incluir el archivo de conexion
	include_once("../includes/session.php");

	//Obtenemos el contenido de cada input en el formulario
	$nombre = $_POST['nombre'];
	$precio = $_POST['precio'];
	$lote = $_POST['lote'];
	$date = $_POST['fecha_vencimiento'];
	$laboratorio =$_POST['laboratorio'];
	$unidad = $_POST['unidad_medida'];
	$principio = $_POST['principio'];
	$cantidad = $_POST['cantidad'];

	$date_arr = explode('-', $date);

	$date = $date_arr[2].'-'.$date_arr[1].'-'.$date_arr[0];

	//concatenamos cada variable en el insert
	$sql = "INSERT INTO MEDICAMENTO (IDMEDICAMENTO,NOMBRE_MEDICAMENTO, PRINCIPIO_ACTIVO_IDPRINCIPIO_ACTIVO, UNIDAD_MEDIDA_IDUNIDAD_MEDIDA)
			VALUES (IDMEDICAMENTO.NEXTVAL, '".$nombre."', ".$principio.", ".$unidad.")";
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	oci_free_statement($stid);
	
	sleep(1);

	// select al ultimo medicamento ingresado
	$sql4 = "SELECT * FROM MEDICAMENTO WHERE ROWNUM = 1 ORDER BY IDMEDICAMENTO DESC";
	$result = db_fetch($sql4, $conn);

	// insertar la relacion medicamento laboratorio
	$sql5 = "INSERT INTO MEDICAMENTO_X_LABORATORIO (MEDICAMENTO_IDMEDICAMENTO, LABORATORIO_IDLABORATORIO, EXISTENCIA_MEDICAMENTO, PRECIO_MEDICAMENTO, LOTE_MEDICAMENTO, FECHA_VENCIMIENTO)
			 VALUES (".$result['IDMEDICAMENTO'].", ".$laboratorio.", ".$cantidad.", '".$precio."', '".$lote."', TO_DATE('".$date."'))";
	$stid5 = oci_parse($conn, $sql5);
	oci_execute($stid5);
	oci_free_statement($stid5);
	echo $sql5;

	//se realiza commit
	$sql2 = "COMMIT";
	$stid2 = oci_parse($conn, $sql2);
	oci_execute($stid2);
	oci_free_statement($stid2);
	
	oci_close($conn);

	//regresar al archivo de ingresar medicamento
	header('Location: ./ingresar_medicamentos.php');

?>