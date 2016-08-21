<?php
	include("../control/connection.php");
	include("../control/security.php");
	session_start();
	echo $_SESSION['user']['id_persona'];
	echo $_SESSION['code'];
	var_dump(comp_tiempo());
	echo time()-$_SESSION['life'];
	//var_dump(destruir_sesion());
?>