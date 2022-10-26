<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/session.php");

    $sql = "SELECT * FROM HORARIO";
    $result = db_select($sql, $conn);

    $idsucursal = $_GET['IDSUCURSAL'];
    $sql2 = "SELECT * FROM SUCURSAL WHERE IDSUCURSAL = ".$idsucursal;
    $sucursal = db_fetch($sql2, $conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sucursal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container">
    
    <h1 class="mb-4">Editar de Sucursal</h1>
    <form class="row g-3 form-control" action=<?= "'./update_sucursal.php?IDSUCURSAL=".$idsucursal."'" ?> method="post">
        <div class="col-auto">
            <label for="inputPassword2">Seleccionar horario</label>
            <select class="form-select" aria-label="Default select example" name="idhorario">
                <?php foreach($result as $row): ?>
                    <option value=<?= '"'.$row['IDHORARIO'].'"' ?>><?= $row['HORARIO'] ?></option>
                <?php endforeach; ?>
			</select>
        </div>
        <div class="col-auto">
            <label for="usuario">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="usuario" value=<?= "'".$sucursal['NOMBRE_SUCURSAL']."'" ?>>
        </div>
        <div class="col-auto w-100 d-flex" style="justify-content: space-around;">
            <input class="btn btn-success mb-3" id="entrar" type="submit" value="Actualizar">
            <a href="./ver_sucursal.php" class="btn btn-primary mb-3">Regresar a sucursales</a>
        </div>
    </form>

</body>
</html>