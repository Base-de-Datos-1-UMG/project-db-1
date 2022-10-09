<?php

    include 'connection.php';
    include 'execute_db.php';

    $user = $_POST['User'];
    $pass = $_POST['Password'];

    $sql = "SELECT 
                P.IDPERSONA,
				E.USUARIO, 
				E.PASSWORD
			FROM EMPLEADO E 
			JOIN PERSONA P 
				ON (P.IDPERSONA = E.PERSONA_IDPERSONA) 
            JOIN ESTADO ES
                ON (ES.IDESTADO = E.ESTADO_IDESTADO)
			WHERE 
				E.USUARIO = '".$user."' 
			AND E.PASSWORD = '".$pass."'
            AND ES.IDESTADO = 0";

	$result = db_fetch($sql, $conn);  

    if($result){

        $_SESSION['idpersona'] = $result['IDPERSONA'];
        $_SESSION['usuario'] = $result['USUARIO'];
        $_SESSION['password'] = $result['PASSWORD'];  

        $idpersona = $result['IDPERSONA'];
        $usuario = $result['USUARIO'];
        $password = $result['PASSWORD'];

        echo ($result ? 'activo' : 'inactivo');

    } else{
        echo 'Usuario no encontrado';
    }

    