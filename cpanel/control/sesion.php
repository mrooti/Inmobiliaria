<?php
	include("conexion.php");
	function usuario($id){
		$resultado=$mysqli->query("SELECT Id_tipo_usuario FROM persona WHERE id_persona='{$id}' AND Estado='0'")or die("Error en: ".$mysqli->error);
		if($resultado->num_rows>0){
			$row=$resultado->fetch_array(MYSQLI_ASSOC);
			return $row['Id_tipo_usuario'];
		}
		else{
			return "0";
		}
	}
?>