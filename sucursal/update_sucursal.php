<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once('../includes/session.php');

    //obtenemos el idpersona que enviamos por la url
    $idsucursal = $_GET['IDSUCURSAL'];

    //Obtenemos el contenido de cada input en el formulario
    $nombre = $_POST['nombre'];
    $horario = $_POST['idhorario'];

    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE SUCURSAL SET NOMBRE_SUCURSAL = '".$nombre."', HORARIO_IDHORARIO = ".$horario." WHERE IDSUCURSAL = ".$idsucursal;

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
    header('Location: ./ver_sucursal.php');

?>