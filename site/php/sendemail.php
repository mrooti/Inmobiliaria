<?php
$name       = @trim(stripslashes($_POST['nombre'])); 
$from       = @trim(stripslashes($_POST['email'])); 
$message    = @trim(stripslashes($_POST['mensaje'])); 
$to   		= 'contacto@livinghousemorelia.com';//replace with your email

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: {$name} <{$from}>";
$headers[] = "Reply-To: <{$from}>";
$headers[] = "Subject: Nuevo Pedido";
$headers[] = "X-Mailer: PHP/".phpversion();

if(mail($to, "Nuevo Mensaje de {$name}.", "Nombre: {$name}"."\nCorreo: ".$from."\nMensaje: {$message}")){
	echo "success";
}
else{
	echo "Error";
}
die;
?>