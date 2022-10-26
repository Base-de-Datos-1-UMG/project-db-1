<?php

    include_once("../includes/session.php");

    $idpersona = $_POST['idpersona'];

    $sql = "INSERT INTO CLIENTE (IDCLIENTE, FECHA_INGRESO_CLIENTE, PERSONA_IDPERSONA, ESTADO_IDESTADO)
            VALUES (IDCLIENTE.NEXTVAL, TO_DATE(SYSDATE), ".$idpersona.", 0)";

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
	header('Location: ./crear_cliente.php');

?>