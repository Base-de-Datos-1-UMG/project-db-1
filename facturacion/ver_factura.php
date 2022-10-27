<?php

    include_once("../includes/session.php");

    $sql = "SELECT DISTINCT
                F.IDFACTURA,
                F.CLIENTE_IDCLIENTE,
                F.TIPO_PAGO,
                F.FECHA
            FROM FACTURA F 
            JOIN DETALLE_FACTURA DF 
                ON (DF.FACTURA_IDFACTURA = F.IDFACTURA)
            ORDER BY F.IDFACTURA ASC";

    $result = db_select($sql, $conn);

    function get_cliente($id = false, $conn){
        if($id){
            $sql = "SELECT 
                        C.*,
                        P.*
                    FROM CLIENTE C 
                    JOIN PERSONA P
                        ON (P.IDPERSONA = C.PERSONA_IDPERSONA)
                    WHERE C.IDCLIENTE = ". $id;
            $result = db_fetch($sql, $conn);
            return $result['NOMBRE1'].' '.$result['NOMBRE2'].' '.$result['APELLIDO1'].' '.$result['APELLIDO2'];
        }
    }

    function get_pago($pago = false, $conn){
        if($pago > -1){
            $sql = "SELECT TIPO_PAGO FROM TIPO_PAGO WHERE IDTIPO_PAGO = ".$pago;
            $result = db_fetch($sql, $conn);
            return $result['TIPO_PAGO'];
        }
    }

    function get_monto($row, $conn){
        if($row){

            $sql = "SELECT 
                        SUM(PRECIO * TOTAL) AS TOTAL
                    FROM DETALLE_FACTURA
                    WHERE 
                        FACTURA_IDFACTURA = ".$row['IDFACTURA'];
            $result = db_fetch($sql, $conn);
            return $result['TOTAL'];

        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar facturas</title>
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
        <h1 class="mt-2 mb-3">Consulta de medicamentos</h1>
        <a href="../view-registers/menu.html" class="btn btn-primary">Regresar al menu</a>
    </div>
    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th scope="col" style="font-weight: bold;">ID</th>
                <th scope="col" style="font-weight: bold;">Cliente</th>
                <th scope="col" style="font-weight: bold;">Monto</th>
                <th scope="col" style="font-weight: bold;">Tipo de Pago</th>
                <th scope="col" style="font-weight: bold;">Fecha</th>
                <th scope="col" style="font-weight: bold;">Ver detalles</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dentro del body hacemos un foreach al arreglo
            e imprimimos cada valor de la consulta a la base de datos
            con los nombres de las columnas en la base de datos -->
            <?php foreach($result as $row): ?>
            <tr>
                <th scope="row"><?= $row['IDFACTURA']; ?></th>
                <th><?= get_cliente($row['CLIENTE_IDCLIENTE'], $conn) ?></th>
                <th><?= get_monto($row, $conn) ?></th>
                <th><?= get_pago($row['TIPO_PAGO'], $conn) ?></th>
                <th><?= $row['FECHA']; ?></th>
                <th><a href=<?= "./detalles_factura.php?IDFACTURA=".$row['IDFACTURA']."&IDCLIENTE=".$row['CLIENTE_IDCLIENTE'] ?>>Ver detalles</a></th>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>