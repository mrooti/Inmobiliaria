<!DOCTYPE HTML>
<?php include("../control/connection.php"); ?>
<html>
<head>
<title>Usuarios | Inmobiliaria</title>
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
				<h3 class="blank1">Usuarios</h3>
				<!--Aqui va a ir todo el contenido de cada seccion -->
					<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
							<div class="panel-body no-padding">
							<button type="button" class="btn-success btn form_attr">Agregar Usuario</button>
							<br>
							<br>
								<table class="table table-striped">
									<thead>
										<tr class="warning">
											<th>#</th>
											<th>Nombre</th>
											<th>Apellido Paterno</th>
											<th>Apellido Materno</th>
											<th>RFC</th>
										</tr>
									</thead>
									<tbody>
									<?php
										//codigo para con sulta
										$resultado=$mysqli->query("SELECT id_persona, Nombres, Apellido_p, apellido_m, RFC FROM persona WHERE Estado='1'");
										while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
											
									?>
										<tr>
											<td><?php echo $row['id_persona']; ?></td>
											<td><?php echo $row['Nombres']; ?> </td>
											<td><?php echo $row['Apellido_p']; ?></td>
											<td><?php echo $row['apellido_m']; ?></td>
											<td><?php echo $row['RFC']; ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- Fin del contenido de tabla -->
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