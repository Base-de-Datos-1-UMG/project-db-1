<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    include_once('../includes/session.php');

    $sql = "SELECT S.*, H.* FROM SUCURSAL S JOIN HORARIO H ON(H.IDHORARIO = S.HORARIO_IDHORARIO) ORDER BY S.IDSUCURSAL ASC";

    $result = db_select($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar sucursales</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        * {
            font-weight: normal;
        }
    </style>
</head>

<body class="container">

    <div class="d-flex align-items-center" style="justify-content: space-between;">
        <h1 class="mt-2 mb-3">Consulta de sucursales</h1>
        <a href="../view-registers/menu.html" class="btn btn-primary">Regresar al menu</a>
    </div>
    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th scope="col" style="font-weight: bold;">ID</th>
                <th scope="col" style="font-weight: bold;">Nombre</th>
                <th scope="col" style="font-weight: bold;">Horario</th>
                <th scope="col" style="font-weight: bold;">Editar</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dentro del body hacemos un foreach al arreglo
            e imprimimos cada valor de la consulta a la base de datos
            con los nombres de las columnas en la base de datos -->
            <?php foreach($result as $row): ?>
            <tr>
                <th scope="row"><?= $row['IDSUCURSAL']; ?></th>
                <th><?= $row['NOMBRE_SUCURSAL']; ?></th>
                <th><?= $row['HORARIO']; ?></th>
                <th><?php echo"<a href='./editar_sucursal.php?IDSUCURSAL=".$row['IDSUCURSAL']."'>Editar<a>"; ?></th>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>