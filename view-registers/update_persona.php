<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");

    //obtenemos el idpersona que enviamos por la url
    $idpersona = $_GET['IDPERSONA'];

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

    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE PERSONA SET NOMBRE1 = '".$nombre."', NOMBRE2 = '".$segnombre."', APELLIDO1 = '".$apellido."', APELLIDO2 = '".$segapellido."', NIT = '".$nit."', DPI = '".$dpi."', GENERO = '".$genero."', CARNET = '".$carnet."' WHERE IDPERSONA = ".$idpersona;//le concatenamos en el where para que nos actualice solo el que necesitamos
    $sql2 = "COMMIT";//el commit para que se guarden los cambios
    echo $sql;

    //creamos objetos sql
	$stid = oci_parse($conn, $sql);
	$stid2 = oci_parse($conn, $sql2);

	//ejecutamos los 2 codigos sql
	oci_execute($stid);
	oci_execute($stid2);//el commit siempre debe ser el ultimo que se ejecute para guardar todo lo que hagamos

	//cerramos conexiones
	oci_free_statement($stid);
	oci_free_statement($stid2);
	oci_close($conn);

    //regresar al archivo de consultar personas
	header('Location: ./personas.php');

?>