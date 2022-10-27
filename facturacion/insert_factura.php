<?php

    include_once("../includes/session.php");

    $idcliente = $_POST['idcliente'];
    $tipo_pago = $_POST['pago'];
    $municipio = $_POST['municipio'];
    $direccion = $_POST['direccion'];
    $sucursal = $_POST['sucursal'];

    $sql = "INSERT INTO FACTURA (IDFACTURA, FECHA, CLIENTE_IDCLIENTE, TIPO_PAGO, MUNICIPIO_IDMUNICIPIO, SUCURSAL_IDSUCURSAL)
            VALUES (IDFACTURA.NEXTVAL, TO_DATE(SYSDATE), ".(int)$idcliente.", ".$tipo_pago.", ".$municipio.", ".$sucursal.")";
    $stid = oci_parse($conn, $sql);
	oci_execute($stid);
	oci_free_statement($stid);
	sleep(1);
    echo $sql;

    // select al ultimo medicamento ingresado
	$sql2 = "SELECT * FROM FACTURA WHERE ROWNUM = 1 ORDER BY IDFACTURA DESC";
	$result = db_fetch($sql2, $conn);

    $cantidad = $_GET['cantidad'];

    for($i = 0; $i < $cantidad; $i++){
        
        if(array_key_exists('MEDICAMENTO_'.$i, $_POST) && array_key_exists('CANTIDAD_'.$i, $_POST)){
            $medicamento = $_POST['MEDICAMENTO_'.$i];echo $i.'<br>';
            $cantidad = $_POST['CANTIDAD_'.$i];

            $sqlp = "SELECT * FROM MEDICAMENTO_X_LABORATORIO WHERE MEDICAMENTO_IDMEDICAMENTO = ".$medicamento;
            $resultp = db_fetch($sqlp, $conn);

            // insertar la relacion detalle factura
            $sql3 = "INSERT INTO DETALLE_FACTURA (IDDETALLE_FACTURA, PRECIO, TOTAL, FACTURA_IDFACTURA, MEDICAMENTO_IDMEDICAMENTO)
            VALUES (IDDETALLE_FACTURA.NEXTVAL, ".$resultp['PRECIO_MEDICAMENTO'].", ".$cantidad.", ".$result['IDFACTURA'].", ".$medicamento.")";
            $stid3 = oci_parse($conn, $sql3);
            oci_execute($stid3);
            oci_free_statement($stid3);
            echo $sql3;

            // rebajar del stock
            $sqll = "SELECT * FROM MEDICAMENTO_X_LABORATORIO WHERE MEDICAMENTO_IDMEDICAMENTO = ".$medicamento;
            $med = db_fetch($sqll, $conn);

            $stock =  $med['EXISTENCIA_MEDICAMENTO'] - $cantidad;

            $sqlll = "UPDATE MEDICAMENTO_X_LABORATORIO SET EXISTENCIA_MEDICAMENTO = ".$stock." WHERE MEDICAMENTO_IDMEDICAMENTO = ".$medicamento;
            $stidlll = oci_parse($conn, $sqlll);
            oci_execute($stidlll);
            oci_free_statement($stidlll);
            echo $sqlll;
        }
    }

    $sql4 = "INSERT INTO ENVIO (IDENVIOS, DIRECCION, FACTURA_IDFACTURA)
             VALUES (IDENVIOS.NEXTVAL, '".$direccion."', ".$result['IDFACTURA'].")";
    $stid4 = oci_parse($conn, $sql4);
    oci_execute($stid4);
    oci_free_statement($stid4);
    echo $sql4;    

    // select al ultimo ENVIO ingresado
	$sql5 = "SELECT * FROM ENVIO WHERE ROWNUM = 1 ORDER BY IDENVIOS DESC";
	$result2 = db_fetch($sql5, $conn);

    $sql6 = "INSERT INTO TRACKING (IDTRACKING, UBICACION, ESTADO, ENVIO_IDENVIO)
             VALUES (IDTRACKING.NEXTVAL, 'En Tienda', 'Pendiente de Entrega', ".$result2['IDENVIOS'].")";
    $stid6 = oci_parse($conn, $sql6);
    oci_execute($stid6);
    oci_free_statement($stid6);
    echo $sql6;  
    
    //se realiza commit
	$sql7 = "COMMIT";
	$stid7 = oci_parse($conn, $sql7);
	oci_execute($stid7);
	oci_free_statement($stid7);
	
	oci_close($conn);

	//regresar al archivo de ingresar medicamento
	header('Location:./factura.php');

?>