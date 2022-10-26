<?php

    include_once("../includes/session.php");

    $idcliente = $_GET['IDCLIENTE'];

    $sql = "UPDATE CLIENTE SET 
                ESTADO_IDESTADO = 1
            WHERE IDCLIENTE = ".$idcliente;

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
    header('Location: ./ver_cliente.php');

?>