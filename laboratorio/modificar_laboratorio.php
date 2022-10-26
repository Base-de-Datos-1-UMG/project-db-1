<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    $idlaboratorio = $_GET['IDLABORATORIO'];

    $sql = "SELECT * FROM LABORATORIO WHERE IDLABORATORIO = ".$idlaboratorio;

    $result = db_fetch($sql, $conn);

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

<body class="container d-flex flex-column justify-content-center" style="height: 100vh;">
    <main class="container">
        <div class="row g-3 form-control">
            <h1 class="mb-4"> Modificar laboratorio </h1>
        </div>

        <form action=<?= "'./update_laboratorio.php?IDLABORATORIO=".$idlaboratorio."'" ?> method="post" class="row g-3 form-control">
            <div class="col-auto">
                <label for="staticEmail2">Nombre</label>
                <input type="text" class="form-control" id="user" name="nombre" placeholder="Ingresa el nombre laboratorio" maxlength="45" value=<?= "'".$result['NOMBRE_LABORATORIO']."'" ?>>
            </div>
            <div class="col-auto">
                <label for="staticEmail2">Dirección</label>
                <input type="text" class="form-control" id="user" name="direccion" placeholder="Ingrese dirección laboratorio" maxlength="45" value=<?= "'".$result['DIRECCION_LABORATORIO']."'" ?>>
            </div>
            <div class="col-auto">
                <label for="">Telefono</label>
                <input type="text" class="form-control" name="phone" placeholder="Ingresa el telefono laboratorio" maxlength="8" value=<?= "'".$result['TELEFONO_LABORATORIO']."'" ?>>
            </div>
            <div class="col-auto w-100 d-flex" style="justify-content: space-around;">
                <input type="submit" class="btn btn-success mb-3" id="entrar" value="Modificar laboratorio">
                <a href="./ver_laboratorio.php" class="btn btn-primary mb-3">Regresar a laboratorios</a>
            </div>
        </form>

    </main>

</body>

</html>