<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$user = 'ASUS'; //usuario de oracle
	$pass = '123456'; //password del usuario
	$db = 'orcl'; // nombre por defecto de oracle 19c
	$conn = oci_connect($user, $pass, $db);

	// if($conn){
	// 	echo "<script>console.log('Conexion hacia ".$db.", exitosa!')</script>";
	// } else {
	// 	echo "<script>console.log('Conexion hacia ".$db.", fallida')</script>";
	// }
