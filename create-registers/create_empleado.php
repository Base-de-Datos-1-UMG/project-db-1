<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $sql = "SELECT * FROM PERSONA WHERE IDPERSONA NOT IN (SELECT PERSONA_IDPERSONA FROM EMPLEADO)";

    $result = db_select($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container">
    
    <h1 class="mb-4">Creacion de Empleado</h1>
    <form class="row g-3 form-control" action="./insert_empleado.php" method="post">
        <div class="col-auto">
            <label for="inputPassword2">Seleccionar persona</label>
            <select class="form-select" aria-label="Default select example" name="idpersona">
                <?php foreach($result as $row): ?>
                    <option value=<?= '"'.$row['IDPERSONA'].'"' ?>><?= $row['NOMBRE1']." ".$row['NOMBRE2']." ".$row['APELLIDO1']." ".$row['APELLIDO2'] ?></option>
                <?php endforeach; ?>
			</select>
        </div>
        <div class="col-auto">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario">
        </div>
        <div class="col-auto">
            <label for="staticEmail2">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" placeholder="Ingresa el salario">
        </div>
        <div class="col-auto">
            <label for="">Puesto</label>
            <input type="text" class="form-control" name="puesto" placeholder="Ingresa el puesto de empleo">
        </div>
        <div>
            <label for="">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ingresa el password" maxlength="10">
        </div>
        <div class="col-auto w-100 d-flex" style="justify-content: space-around;">
            <input class="btn btn-success mb-3" id="entrar" type="submit" value="Registrar">
            <a href="../view-registers/menu.html" class="btn btn-primary mb-3">Regresar al menu</a>
        </div>
    </form>

</body>
</html>