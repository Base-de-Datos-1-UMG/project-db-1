<?php

    include_once("../includes/session.php");

    //Consultamos la tabla que queremos mostrar en la vista
    $sql = "SELECT M.*, PA.*, UM.*, ML.*, L.*
            FROM MEDICAMENTO M 
            JOIN PRINCIPIO_ACTIVO PA 
                ON (PA.IDPRINCIPIO_ACTIVO = M.PRINCIPIO_ACTIVO_IDPRINCIPIO_ACTIVO) 
            JOIN UNIDAD_MEDIDA UM 
                ON (UM.IDUNIDAD_MEDIDA = M.UNIDAD_MEDIDA_IDUNIDAD_MEDIDA)
            JOIN MEDICAMENTO_X_LABORATORIO ML 
                ON (ML.MEDICAMENTO_IDMEDICAMENTO = M.IDMEDICAMENTO)
            JOIN LABORATORIO L 
                ON (L.IDLABORATORIO = ML.LABORATORIO_IDLABORATORIO)
            ORDER BY M.IDMEDICAMENTO";
    $medicamento = db_select($sql, $conn);

    $sql1 = "SELECT
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
    $cliente = db_select($sql1, $conn);

    $sql2 = "SELECT * FROM TIPO_PAGO";
    $pago = db_select($sql2, $conn);

    $sql3 = "SELECT S.*, H.* 
             FROM SUCURSAL S 
             JOIN HORARIO H ON(H.IDHORARIO = S.HORARIO_IDHORARIO) 
             ORDER BY S.IDSUCURSAL ASC";
    $sucursal = db_select($sql3, $conn);

    $sql4 = "SELECT * FROM MUNICIPIO ORDER BY MUNICIPIO";
    $municipio = db_select($sql4, $conn);

    if(array_key_exists('cantidad', $_POST)){
        $cantidad = $_POST['cantidad'];
    } else{
        $cantidad = 1;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear factura</title>
    <!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body class ="container d-flex flex-column justify-content-center">
    
    <div class="d-flex align-items-center mb-4" style="justify-content: space-between;">
        <h1>Datos de Factura</h1>
        <a href="../view-registers/menu.html" class="btn btn-primary">Regresar al menu</a>
    </div>


    <form action="./factura.php" class="row g-3 form-control" method="post" >
        <div class="col-auto">
            <label for="">Ingresar cantidad de productos</label>
            <input type="number" name="cantidad" id="" class="form-control">
        </div>
        <div class="col-auto w-100 d-flex justify-content-center">
            <input class="btn btn-primary mb-3" id="enviar" type="submit" value="Agregar productos">
        </div>
    </form>

    <form class="row g-3 form-control" method="post" action=<?= '"./insert_factura.php?cantidad='.$cantidad.'"' ?>>
        <div class="col-auto">
            <label for="staticEmail2" >Cliente</label>
            <select name="idcliente" id="" class="form-control">
                <?php foreach($cliente as $row): ?>
                    <option value=<?= '"'.$row['IDCLIENTE'].'"' ?>><?= $row['NOMBRE1']." ".$row['NOMBRE2']." ".$row['APELLIDO1']." ".$row['APELLIDO2'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <label for="">Municipio</label>
            <select name="municipio" id="" class="form-control">
                <?php foreach($municipio as $row): ?>
                    <option value=<?= "'".$row['IDMUNICIPIO']."'" ?>><?= $row['MUNICIPIO'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
        <label for="staticEmail2" >Direccion de envio</label>
                    <input type="text" class="form-control" id="Envio" name="direccion" placeholder="Ingresa direccion de Envio">
                </div>
        <div class="col-auto">
            <label for="staticEmail2" >Pago</label>
            <select name="pago" id="" class="form-control">
                <?php foreach($pago as $row): ?>
                    <option value=<?= "'".$row['IDTIPO_PAGO']."'" ?>><?= $row['TIPO_PAGO'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <label for="staticEmail2" >Sucursal</label>
            <select name="sucursal" id="" class="form-control">
                <?php foreach($sucursal as $row): ?>
                    <option value=<?= "'".$row['IDSUCURSAL']."'" ?>><?= $row['NOMBRE_SUCURSAL'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row d-flex mt-3" style="justify-content: space-around;">
            <div class="col-auto">
                <label for="">Medicamentos</label>
                <?php for($i = 0; $i < $cantidad; $i++): ?>
                    <select name=<?= "'MEDICAMENTO_".$i."'" ?> id="" class="form-control mb-2">
                        <?php foreach($medicamento as $row): ?>
                            <option value=<?= "'".$row['IDMEDICAMENTO']."'" ?>><?= $row['NOMBRE_MEDICAMENTO'].' '.$row['UNIDAD_MEDIDA'].' - '.$row['NOMBRE_LABORATORIO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endfor; ?>
            </div>
            <div class="col-auto">
                <label for="">Cantidad</label>
                <?php for($i = 0; $i < $cantidad; $i++): ?>
                    <input type="number" name=<?= "CANTIDAD_".$i ?> id="" class="form-control mb-2">
                <?php endfor; ?>
            </div>
        </div>
        <div class="col-auto w-100 d-flex justify-content-center">
            <input class="btn btn-primary mb-3" id="entrar" type="submit" value="Crear">
        </div>
    </form>

</body>
</html>