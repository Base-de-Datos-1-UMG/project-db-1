<?php

    include_once("../includes/session.php");

    $sql = "SELECT * 
            FROM PERSONA 
            WHERE IDPERSONA NOT IN (SELECT PERSONA_IDPERSONA FROM CLIENTE WHERE ESTADO_IDESTADO = 0)
            AND IDPERSONA != 0
            ORDER BY NOMBRE1, NOMBRE2, APELLIDO1, APELLIDO2";

    $result = db_select($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Crear Cliente</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="container d-flex flex-column justify-content-center" style="height: 100vh;">
    <main class="container">
        <div class="row g-3 form-control">
            <h1 class="mb-4"> Ingresar nuevo cliente </h1>
        </div>

        <form action="./insert_cliente.php" method="post" class="row g-3 form-control">
        <div class="col-auto">
                <label for="staticEmail2">Persona</label>
                <select name="idpersona" id="" class="form-control">
                    <?php foreach($result as $row): ?>
                        <option value=<?= "'".$row['IDPERSONA']."'" ?>><?= $row['NOMBRE1'].' '.$row['NOMBRE2'].' '.$row['APELLIDO1'].' '.$row['APELLIDO2'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto w-100 d-flex justify-content-center" style="gap: 1rem;">
                <input class="btn btn-success mb-3" id="ingresar" type="submit" value="Registrar">
                <a href="../view-registers/menu.html" class="btn btn-primary mb-3">Regresar al menu</a>
            </div>
        </form>

    </main>

</body>

</html>