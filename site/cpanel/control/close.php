<?php
	include("../control/connection.php");
	include("../control/security.php");
	if(destruir_sesion()){
		header("Location: ../panel/login.php");
	}
?>