<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	include_once "./includes/session.php";

	$sql2 = "SELECT * FROM ESTADO";
	$result = db_select($sql2, $conn);

	$iduser = $_SESSION['idpersona'];
	$user = $_SESSION['usuario'];
	$pass = $_SESSION['password'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Farmacias UMG</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body class="container pt-5 text-bg-light">

	<table class="table table-striped table-hover text-bg-secondary ">
		<thead>
			<tr>
				<th scope="col">IDESTADO</th>
				<th scope="col">ESTADO</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($result as $index => $row): ?>
			<tr>
				<th scope="col"><?= $row['IDESTADO'] ?></th>
				<th scope="col"><?= $row['DES_ESTADO'] ?></th>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php echo $user.'----'.$pass.'----'.$iduser ?>

	<pre>
		<?= var_dump($result) ?>
	</pre>
	<div class="form-control  text-bg-dark">
		<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Inserta id estado</label>
			<input type="number" class="form-control" id="idestado">
		</div>
		<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Inserta Descripcion de estado</label>
			<input type="text" class="form-control" id="des_estado">
		</div>
		<div class="col-auto w-100 d-flex justify-content-center">
            <button class="btn btn-primary mb-3" id="enviar">Registrar Estado</button>
        </div>
	</div>

	<script>
        $('#enviar').click(function(){
            var idestado = document.getElementById('idestado').value;
            var des_estado = document.getElementById('des_estado').value;

            var ruta = "name=ESTADO&IDESTADO="+idestado+"DES_ESTADO="des_estado;

            $.ajax({
                url: 'includes/insert.php',
                type: 'POST',
                data: ruta,
            })
            .done(function (res){
                console.log("exito "+res);
            })
            .fail(function (){
                console.log("error");
            })
            .always(function (){
                console.log("complete");
            });
        });

    </script>

</body>
</html>