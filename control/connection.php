<?php
	global $mysqli;
	//sustituye los valores de usuario, contraseña y base de datos a los valores que tengas tú
	$mysqli=new mysqli("localhost","usuario","contrasena","basededatos");
	if($mysqli->errno){
		echo "<h1>Fallo la conexión con la base de datos";
	}
	$mysqli->set_charset("utf8");
	global $mysqli;
?>