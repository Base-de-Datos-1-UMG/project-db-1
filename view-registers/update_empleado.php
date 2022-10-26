<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");

    //obtenemos el idpersona que enviamos por la url
    $idempleado = $_GET['IDEMPLEADO'];

    //Obtenemos el contenido de cada input en el formulario
    $usuario = $_POST['usuario'];
    $salario = $_POST['salario'];
    $puesto = $_POST['puesto'];
    $password = $_POST['password'];
    $estado = $_POST['estado'];

    //hacemos el sql de update para actualizar la persona
    $sql = "UPDATE EMPLEADO SET USUARIO='".$usuario."', SALARIO='".$salario."', PUESTO='".$puesto."', PASSWORD='".$password."', ESTADO_IDESTADO=".$estado." WHERE IDEMPLEADO=".$idempleado;//le concatenamos en el where para que nos actualice solo el que necesitamos

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
    header('Location: ./empleados.php');

?>