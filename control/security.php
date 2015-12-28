<?php
	function seguridad($entrada){
		global $mysqli;
		return $mysqli->real_escape_string(htmlentities(trim($entrada)));
	}
?>