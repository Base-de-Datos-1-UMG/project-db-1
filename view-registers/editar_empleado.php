<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    // los datos que pasemos por url, los obtenemos con GET
    $idempleado = $_GET['IDEMPLEADO'];

    $sql = "SELECT P.*, E.* FROM EMPLEADO E JOIN PERSONA P ON (P.IDPERSONA = E.PERSONA_IDPERSONA) WHERE E.IDEMPLEADO = ".$idempleado;
    $result = db_fetch($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body class="container">
    
<h1 class="mb-2">Modificar de Empleado</h1>
<h4 class="mb-4"><?= $result['NOMBRE1']." ".$result["NOMBRE2"]." ".$result["APELLIDO1"]." ".$result["APELLIDO2"] ?></h4>
    <form class="row g-3 form-control" <?php echo("action='./update_empleado.php?IDEMPLEADO=".$idempleado."'"); ?> method="post">
        <div class="col-auto">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" <?= "value = '".$result['USUARIO']."'" ?>>
        </div>
        <div class="col-auto">
            <label for="staticEmail2">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" placeholder="Ingresa el salario"  <?= "value = '".$result['SALARIO']."'" ?>>
        </div>
        <div class="col-auto">
            <label for="">Puesto</label>
            <input type="text" class="form-control" name="puesto" placeholder="Ingresa el puesto de empleo"  <?= "value = '".$result['PUESTO']."'" ?>>
        </div>
        <div>
            <label for="">Contraseña</label>
            <input type="text" class="form-control" name="password" placeholder="Ingresa el password" maxlength="10"  <?= "value = '".$result['PASSWORD']."'" ?>>
        </div>
        <div class="col-auto">
            <label for="">Estado</label>
            <select name="estado" id="" class="form-control">
                <option value="0" <?php ($result['ESTADO_IDESTADO'] == 0 ? 'selected' : '') ?>>Activo</option>
                <option value="1" <?php ($result['ESTADO_IDESTADO'] == 1 ? 'selected' : '') ?>>Inactivo</option>
            </select>
        </div>
        <div class="col-auto w-100 d-flex" style="justify-content: space-around;">
            <input class="btn btn-success mb-3" id="entrar" type="submit" value="Modificar">
            <a href="./empleados.php" class="btn btn-primary mb-3">Regresar a empleados</a>
        </div>
    </form>

</body>
</html>