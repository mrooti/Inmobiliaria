<?php
	include("connection.php");
	function seguridad($entrada){
		global $mysqli;
		return $mysqli->real_escape_string(htmlentities(trim($entrada)));
	}
	//guardar caracteres especiales y saltos de linea
	function seguridad_utf8($entrada){
		global $mysqli;
		return addslashes($mysqli -> real_escape_string(nl2br(trim($entrada))));
	}
	//respetar saltos de linea para imprimirlos de manera correcta
	function seguridad_decode($entrada){
		global $mysqli;
		return str_replace("rn", "", str_replace("<br />", "\n", stripslashes($entrada)));
	}
	function normaliza($cadena){
	    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
	ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
	    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
	bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	    $cadena = utf8_decode($cadena);
	    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
	    $cadena = strtolower($cadena);
	    return utf8_encode($cadena);
	}
	function aleat($longitud){ 
		$key = ''; 
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz'; 
		$max = strlen($pattern)-1; 
		for($i=0;$i < $longitud;$i++) 
			$key .= $pattern{mt_rand(0,$max)}; 
		return $key; 
	}
	function get_ip()
    {
 
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
 
    }
    function usuario($id){
    	$mysqli=conectar();
		$resultado=$mysqli->query("SELECT Id_tipo_usuario FROM persona WHERE id_persona='{$id}' AND Estado='0'")or die("Error en: ".$mysqli->error);
		if($resultado->num_rows>0){
			$row=$resultado->fetch_array(MYSQLI_ASSOC);
			return $row['Id_tipo_usuario'];
		}
		else{
			return "0";
		}
	}
	function crea_sesion($codigo,$id){
		session_start();
		$_SESSION['code']=$codigo;
		$_SESSION['life']=time();
		$_SESSION['user']=$id;//es un array
	}
	function eli($c)
	{
	    foreach(glob($c . "/*") as $ar)
	    {
	        echo $ar."<br>";
	        if (is_dir($ar))
	        {
	            eli($ar);
	        }
	        else
	        {
	            unlink($ar);
	        }
	    }
	    rmdir($c);
	}
	function destruir_sesion(){
		global $mysqli;
		@session_start();
		$codigo=$_SESSION['code'];
		$result=$mysqli->query("UPDATE sesion SET Estado='0' WHERE Codigo='{$codigo}'")or die("error en".$mysqli->error);
		if($result){
			session_unset();
			session_destroy();
			return true;
		}
		else{
			return false;
		}	
	}
	function comp_tiempo(){
		@session_start();
		if(isset($_SESSION['life'])){
			$vida_sesion=time()-$_SESSION['life'];
			if($vida_sesion > 3600){
				destruir_sesion();
				return true;//sesión finalizada
			}
			else{
				return false;//sesion activa
			}
		}
		else{
			return false;//no existe life
		}
	}
	function permisos(array $p1){//recibe arreglo de permisos
		@session_start();
		global $mysqli;
		if(!comp_tiempo()){
			if(isset($_SESSION['user'])){
				$usuario=$_SESSION['user']['id_persona'];
				$id=seguridad($usuario);
				$resultado=$mysqli->query("SELECT Id_tipo_usuario FROM persona WHERE id_persona='{$id}' AND Estado='1'")or die("Error en: ".$mysqli->error);
				if($resultado->num_rows>0){
					$row=$resultado->fetch_array(MYSQLI_ASSOC);
					if(in_array($row['Id_tipo_usuario'], $p1)){
						return true;
					}
					else{
						return false;
					}
				}else{
					return false;//no hay ningun usuario
				}
			}
			else{
				return false;//no tiene permisos
			}
		}
		else{
			return false;
		}
	}
?>