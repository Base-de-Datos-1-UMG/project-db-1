<?php

    include_once("../includes/session.php");

    $idhorario = $_POST['idhorario'];
    $nombre = $_POST['nombre'];

    $sql = "INSERT INTO SUCURSAL (IDSUCURSAL, NOMBRE_SUCURSAL, HORARIO_IDHORARIO)
            VALUES (IDSUCURSAL.NEXTVAL+3, '".$nombre."', ".$idhorario.")";

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
    header('Location: ./create_sucursal.php');

?>