<?php

    include_once('../includes/session.php');

    $sql = "SELECT * FROM PRINCIPIO_ACTIVO";
    $result = db_select($sql, $conn);

    $sql2 = "SELECT * FROM LABORATORIO";
    $result2 = db_select($sql2, $conn);

    $sql3 = "SELECT * FROM UNIDAD_MEDIDA";
    $result3 = db_select($sql3, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Bootstrap 4</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="container d-flex flex-column justify-content-center pt-4 pb-4">
    <main class="container">
        <div class="row g-3 form-control">
            <h1 class="mb-4"> Crear Medicamentos </h1>
        </div>

        <form class="row g-3 form-control" action="./insert_medicamento.php" method="post">
            <div class="col-auto">
                <label for="staticEmail2">Nombre del medicamento</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre del medicamento">
            </div>
            <div class="col-auto">
                <label for="staticEmail2">Precio del medicamento</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingresa el precio">
            </div>
            <div class="col-auto">
                <label for="">Cantidad</label>
                <input type="number" name="cantidad" id="" class="form-control">
            </div>
            <div class="col-auto">
                <label for="staticEmail2">Lote del medicamento</label>
                <input type="text" class="form-control" id="lote" name="lote" placeholder="Ingresa el lote">
            </div>
            <div class="col-auto">
                <label for="">Fecha Vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="" class="form-control">
            </div>
            <div class="col-auto">
                <label for="">Laboratorio</label>
                <select name="laboratorio" id="" class="form-control">
                    <?php foreach ($result2 as $key => $row): ?>
                        <option value=<?= "'".$row['IDLABORATORIO']."'" ?>><?= $row['NOMBRE_LABORATORIO'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label for="">Unidad Medida</label>
                <select name="unidad_medida" id="" class="form-control">
                    <?php foreach($result3 as $row): ?>
                        <option value=<?= "'".$row['IDUNIDAD_MEDIDA']."'" ?>><?= $row['UNIDAD_MEDIDA'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <label for="staticEmail2">Principio Activo</label>
                <select name="principio" id="" class="form-control">
                    <?php foreach($result as $row): ?>
                        <option value=<?= "'".$row['IDPRINCIPIO_ACTIVO']."'" ?>><?= $row['PRINCIPIO_ACTIVO'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto w-100 d-flex justify-content-center" style="gap: 1rem;">
                <input class="btn btn-success mb-3" id="ingresar" type="submit" value="Registrar">
                <a href="../view-registers/menu.html" class="btn btn-primary mb-3">Regresar al menu</a>
            </div>

        </form>




    </main>

    <script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>

</html>