<?php
	function seguridad($entrada){
		global $mysqli;
		return $mysqli->real_escape_string(htmlentities(trim($entrada)));
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
?>