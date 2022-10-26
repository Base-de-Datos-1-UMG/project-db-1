<?php

    include_once("../includes/session.php");

    $sql = "SELECT
                C.*,
                P.*,
                ES.*
            FROM CLIENTE C
            JOIN PERSONA P 
                ON (P.IDPERSONA = C.PERSONA_IDPERSONA)
            JOIN ESTADO ES 
                ON (ES.IDESTADO = C.ESTADO_IDESTADO)
            WHERE
                C.ESTADO_IDESTADO = 0
            ORDER BY C.IDCLIENTE ASC";
    
    $result = db_select($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar personas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>*{font-weight: normal;}</style>
</head>

<body class="container">
<div class="d-flex align-items-center" style="justify-content: space-between;">
    <h1 class="mt-2 mb-3">Consulta de Personas</h1>
    <a href="../view-registers/menu.html" class="btn btn-primary">Regresar al menu</a>
</div>
<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th scope="col" style="font-weight: bold;">ID</th>
            <th scope="col" style="font-weight: bold;">Nombre</th>
            <th scope="col" style="font-weight: bold;">Nombre2</th>
            <th scope="col" style="font-weight: bold;">Apellido</th>
            <th scope="col" style="font-weight: bold;">Apellido2</th>
            <th scope="col" style="font-weight: bold;">Nit</th>
            <th scope="col" style="font-weight: bold;">DPI</th>
            <th scope="col" style="font-weight: bold;">Genero</th>
            <th scope="col" style="font-weight: bold;">Carnet</th>
            <th scope="col" style="font-weight: bold;">Baja</th>
        </tr>
    </thead>
    <tbody>
        <!-- Dentro del body hacemos un foreach al arreglo
             e imprimimos cada valor de la consulta a la base de datos
             con los nombres de las columnas en la base de datos -->
        <?php foreach($result as $row): ?>
            <tr>
                <th scope="row"><?= $row['IDCLIENTE']; ?></th>
                <th><?= $row['NOMBRE1']; ?></th>
                <th><?= $row['NOMBRE2']; ?></th>
                <th><?= $row['APELLIDO1']; ?></th>
                <th><?= $row['APELLIDO2']; ?></th>
                <th><?= $row['NIT']; ?></th>
                <th><?= $row['DPI']; ?></th>
                <th><?= ($row['GENERO'] == 1 ? 'Masculino' : 'Femenino'); ?></th>
                <th><?= $row['CARNET']; ?></th>
                <!-- con php imprimimos una etiqueta a para ir a la pagina editar persona
                     con ? despues de la ruta del archivo podemos poner parametros y concatenarle los valores
                     si mandamos mas de un parametro nuestra url deberia quedar asi
                     ./editar_persona.php?IDPERSONA=5&NOMBRE1=Maria
                     & para poner mas parametros -->
                <th><?php echo"<a href='./update_cliente.php?IDCLIENTE=".$row['IDCLIENTE']."'>Dar de baja<a>"; ?></th>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>