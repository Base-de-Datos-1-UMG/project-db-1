<?php

	include_once "session.php";
	
	// ejecutar select de varias filas, recibe el query en $sql, y se le pasa la variable $conn de la conexion a oracle
	function db_select($sql, $conn){
		
		if($sql){

			$stid = oci_parse($conn, $sql);

			oci_execute($stid);

			$nrows = oci_fetch_all($stid, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);

			oci_free_statement($stid);

			oci_close($conn);

			return $res;

		}
	}
	
	// ejecutar select de una fila, recibe el query en $sql, y se le pasa la variable $conn de la conexion a oracle
	function db_fetch($sql, $conn){

		if($sql){

			$result = db_select($sql, $conn);
			$array = [];
			foreach($result as $index => $row){

				$array = $row;
				break;

			}

			return $array;

		}

	}