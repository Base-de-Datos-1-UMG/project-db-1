<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");

    //obtenemos el idpersona que enviamos por la url
    $idlaboratorio = $_GET['IDLABORATORIO'];

    //Obtenemos el contenido de cada input en el formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['phone'];

    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE LABORATORIO SET NOMBRE_LABORATORIO = '".$nombre."', DIRECCION_LABORATORIO='".$direccion."', TELEFONO_LABORATORIO='".$telefono."' WHERE IDLABORATORIO = ".$idlaboratorio;

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
    header('Location: ./ver_laboratorio.php');

?>