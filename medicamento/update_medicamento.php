<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");

    //obtenemos el idpersona que enviamos por la url
    $idmedicamento = $_GET['IDMEDICAMENTO'];
    $idprincipio_activo = $_GET['IDPRINCIPIO_ACTIVO'];
    //Obtenemos el contenido de cada input en el formulario
    $nombre_medicamento = $_POST['nombre_medicamento'];
    $precio_medicamento = $_POST['precio_medicamento'];
    $lote_medicamento = $_POST['lote_medicamento'];
    $principio_activo = $_POST['principio_activo'];


    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE MEDICAMENTO SET NOMBRE_MEDICAMENTO = '".$nombre_medicamento."' WHERE IDMEDICAMENTO = ".$idmedicamento;//le concatenamos en el where para que nos actualice solo el que necesitamos
    $sql4 = "UPDATE MEDICAMENTO_X_LABORATORIO SET PRECIO_MEDICAMENTO = '".$precio_medicamento."', LOTE_MEDICAMENTO = '".$lote_medicamento."' WHERE IDMEDICAMENTO = ".$idmedicamento;
    $sql3 = "UPDATE PRINCIPIO_ACTIVO SET PRINCIPIO_ACTIVO = '".$PRINCIPIO_ACTIVO."'  WHERE IDPRINCIPIO_ACTIVO = ".$idprincipio_activo;
    $sql2 = "COMMIT";//el commit para que se guarden los cambios
    echo $sql;

    //creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid4 = oci_parse($conn, $sql4);
	$stid3 = oci_parse($conn, $sql3);
	$stid2 = oci_parse($conn, $sql2);

	//ejecutamos los 2 codigos sql
	oci_execute($stid);
	oci_execute($stid4);
	oci_execute($stid3);
	oci_execute($stid2);//el commit siempre debe ser el ultimo que se ejecute para guardar todo lo que hagamos

	//cerramos conexiones
	oci_free_statement($stid);
	oci_free_statement($stid4);
	oci_free_statement($stid3);
	oci_free_statement($stid2);
	oci_close($conn);

    //regresar al archivo de consultar personas
	header('Location: ./medicamentos.php');

?>