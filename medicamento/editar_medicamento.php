<?php

    // $_POST;
    // $_GET;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //Incluir el archivo de conexion
    include_once("../includes/connection.php");
    include_once("../includes/execute_db.php");

    // los datos que pasemos por url, los obtenemos con GET
    $idmedicamento = $_GET['IDMEDICAMENTO'];
    $idprincipio_activo = $_GET['IDPRINCIPIO_ACTIVO'];

    //hacemos la consulta con where para traer solo los datos de la persona seleccionada
    $sql = "SELECT * FROM MEDICAMENTO WHERE IDMEDICAMENTO = ".$idmedicamento;
    $sql2 = "SELECT * FROM MEDICAMENTO_X_LABORATORIO WHERE IDMEDICAMENTO = ".$idmedicamento;
    $sql1 = "SELECT * FROM PRINCIPIO_ACTIVO WHERE IDPRINCIPIO_ACTIVO = ".$idprincipio_activo;


    //con db_fetch hacemos consultas donde solo necesitamos 1 fila
    $result = db_fetch($sql, $conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
    <!-- aca pasamos nuevamente por la url el id de la persona -->
    <form <?php echo"action='./update_medicamento.php?IDMEDICAMENTO=".$idmedicamento."'";
                echo"action='./update_medicamento.php?IDPRINCIPIO_ACTIVO=".$idprincipio_activo."'";
          ?> method="post">
    <div class="col-auto">
            <label for="staticEmail2">Nombre Medicamento</label>
            <input type="text" class="form-control" id="nombre_medicamento" name="nombre_medicamento" placeholder="Ingresa el nombre" <?php echo"value='".$result['NOMBRE_MEDICAMENTO']."'"; ?>>
            <!-- dentro de cada input con php imprimimos el value de ese input
                 para que al cargar la pagina el formulario aparezca lleno
                 con los datos de la persona que vamos a editar -->
        </div>
        <div class="col-auto">
            <label for="staticEmail2">Precio</label>
            <input type="text" class="form-control" id="precio_medicamento" name="precio_medicamento" placeholder="Ingresa el precio" <?php echo"value='".$result['PRECIO_MEDICAMENTO']."'"; ?>>
        </div>
        <div class="col-auto">
            <label for="staticEmail2">Lote Medicamento</label>
            <input type="text" class="form-control" id="lote_medicamento" name="lote_medicamento" placeholder="Ingresa el lote" <?php echo"value='".$result['LOTE_MEDICAMENTO']."'"; ?>>
        </div>
        <div class="col-auto">
            <label for="staticEmail2">Principio Activo</label>
            <input type="text" class="form-control" id="principio_activo" name="<principio_activo>" placeholder="Ingresa el principio activo" <?php echo"value='".$result['PRINCIPIO_ACTIVO']."'"; ?>>
        </div>
    <div class="col-auto w-100 d-flex justify-content-center">
            <input class="btn btn-primary mb-3" id="entrar" type="submit" value="Registrar">
        </div>
    </form>



</body>
</html>