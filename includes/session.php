<?php

	include_once "connection.php";
	include_once "execute_db.php";
	include_once "functions.php";

	if(!isset($_SESSION)){
		session_start();
	}