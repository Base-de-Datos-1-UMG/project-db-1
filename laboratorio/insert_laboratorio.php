<?php

    include_once("../includes/session.php");

    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['phone'];

    $sql = "INSERT INTO LABORATORIO (IDLABORATORIO, NOMBRE_LABORATORIO, TELEFONO_LABORATORIO, DIRECCION_LABORATORIO) 
            VALUES (IDLABORATORIO.NEXTVAL, '".$nombre."', '".$telefono."', '".$direccion."')";

    $sql2 = "COMMIT";

    echo $sql;

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

	//regresar al archivo de ingresar usuario
	header('Location: ./nuevo_laboratorio.html');

?>