<!DOCTYPE HTML>
<?php 
	include("../control/connection.php"); 
	include("../control/security.php"); 
	if(!permisos(array("1"))){
		header("Location: login.php");
	}
	?>
<html>
<head>
<title>Página en Blanco | Inmobiliaria</title>
<?php include("../estructura/head.php"); ?>
</head> 
   
 <body class="sticky-header left-side-collapsed"  onload="muestraReloj();">
    <section>
    <!-- left side start-->
		<?php include("../estructura/main.php"); ?>
    <!-- left side end-->
    
    <!-- main content start-->
		<div class="main-content main-content2 main-content2copy">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<?php include("../estructura/notification.php"); ?>
			<!--notification menu end -->
			</div>
	<!-- header-ends -->
			<!-- Inicio de Contenido-->
			<div id="page-wrapper">
				<div class="graphs">
				<!--Aqui va a ir todo el contenido de cada seccion -->
					<div class="error-main">
						<h3><i class="fa fa-exclamation-triangle"></i> <span id="reloj"></span></h3>
					<div class="col-xs-7 error-main-left">
						<span>Bienvenido</span>
						<p></p>
					</div>
					<div class="col-xs-5 error-main-right">
						
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<!--Fin de contenido-->
		<!--footer section start-->
			<?php include("../estructura/footer.php"); ?>
        <!--footer section end-->
	</section>
	
<?php include("../estructura/scripts.php"); ?>
<script>
	function muestraReloj() {
	  var fechaHora = new Date();
	  var horas = fechaHora.getHours();
	  var minutos = fechaHora.getMinutes();
	  var segundos = fechaHora.getSeconds();
	 
	  if(horas < 10) { horas = '0' + horas; }
	  if(minutos < 10) { minutos = '0' + minutos; }
	  if(segundos < 10) { segundos = '0' + segundos; }
	 
	  document.getElementById("reloj").innerHTML = horas+':'+minutos+':'+segundos;
	  setTimeout(muestraReloj, 1000);
	}
	 
	
</script>
</body>
</html>