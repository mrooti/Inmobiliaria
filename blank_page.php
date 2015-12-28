<!DOCTYPE HTML>
<html>
<head>
<title>Página en Blanco | Inmobiliaria</title>
<?php include("../estructura/head.php"); ?>
</head> 
   
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
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
					<div class="error-main">
						<h3><i class="fa fa-exclamation-triangle"></i> <span>404</span></h3>
					<div class="col-xs-7 error-main-left">
						<span>Oops!</span>
						<p>The page you're looking for could not be found.</p>
						<div class="error-btn">
							<a href="index.html">Go back?</a>
						</div>
					</div>
					<div class="col-xs-5 error-main-right">
						<img src="images/7.png" alt=" " class="img-responsive" />
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
</body>
</html>