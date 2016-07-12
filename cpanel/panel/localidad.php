<!DOCTYPE HTML>
<?php 
	include("../control/connection.php"); 
	include("../control/security.php"); 
	if(!permisos(array("1"))){
		header("Location: /login.php");
	}
	?>
<html>
<head>
<title>Localidades | Inmobiliaria</title>
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
				<h3 class="blank1">Localidades</h3>
				<!--Aqui va a ir todo el contenido de cada seccion -->
					<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
							<div class="panel-body no-padding">
							<button type="button" class="btn-success btn form_attr" data-toggle="modal" data-target="#alta_l">Agregar Localidad</button>
							<br>
							<br>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<select name="estado" id="estado" class="form-control">
											<option value="0">Selecciona un Estado</option>
											<?php
												$resultado=$mysqli->query("SELECT * FROM estado")or die("error en: ".$mysqli->error);
												while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
													echo "<option value=\"{$row['Id_estado']}\">{$row['Estado']}</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<select name="municipio" id="municipio" class="form-control">
											<option value="0">Selecciona un Municipio</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12" style="text-align: center;">
									<h2>ó</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Puedes buscar la localidad ingresando el nombre">
									</div>
									
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<button type="button" name="buscar" id="buscar" onclick="buscar()" class="btn btn-warning">Buscar</button>
									</div>
								</div>
							</div>
								<table class="table table-striped">
									<thead>
										<tr class="warning">
											<th>Localidad</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody id="listado">

									</tbody>
								</table>
							</div>
						</div>
						<!-- Fin del contenido de tabla -->
						<!--Inicio de Modal Alta-->
						<div class="modal fade" id="alta_l" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Ingrese los datos solicitados.</h4>
						      </div>
						      <div class="modal-body">
						        <form id="form">
						        	<div class="form-group">
										<select name="estado_2" id="estado_2" class="form-control">
											<option value="0">Selecciona un Estado</option>
											<?php
												$resultado=$mysqli->query("SELECT * FROM estado")or die("error en: ".$mysqli->error);
												while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
													echo "<option value=\"{$row['Id_estado']}\">{$row['Estado']}</option>";
												}
											?>
										</select>
						        	</div>
						        	<div class="form-group">
						        		<select name="municipio_2" id="municipio_2" class="form-control">
											<option value="0">Selecciona un Municipio</option>
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="localidad">Localidad</label>
										<input type="text" class="form-control1" id="localidad" name="localidad" required="required">
						        	</div>
						       
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						        <button type="button" class="btn btn-primary" onclick="guardar()">Guardar Localidad</button>
						      </div>
						      </form>
						    </div>
						  </div>
						</div>
						<!--Fin Modal alta-->
						<!--Modal success-->
						<div class="modal fade bs-example-modal-sm" tabindex="-1" id="success" role="dialog" aria-labelledby="success">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="gridSystemModalLabel">Alerta</h4>
						    </div>
						    <div class="modal-body">
								<h3>La localidad ha sido guardada con exito.</h3>
						    </div>
						    </div>
						  </div>
						</div>
						<!--Fin modal success-->
						<!--Modal error-->
						<div class="modal fade bs-example-modal-sm" tabindex="-1" id="error" role="dialog" aria-labelledby="error">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						    <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="gridSystemModalLabel">Alerta</h4>
						    </div>
						    <div class="modal-body" id="error_m">

						    </div>
						    </div>
						  </div>
						</div>
						<!--Fin modal error-->
						<!--Modal guardando-->
						<div class="modal fade bs-example-modal-sm" tabindex="-1" id="guardando" role="dialog" aria-labelledby="guardando">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						      <h3>Estamos procesando su solicitud, espere por favor.</h3>
						    </div>
						  </div>
						</div>
						<!--Fin modal guardando-->
						<!--Modal de Modificar-->
						<div class="modal fade" id="modifica_l" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Ingrese los datos solicitados.</h4>
						      </div>
						      <div class="modal-body">
						        <form id="form_m">
						        	<div class="form-group">
						        		<input type="hidden" id="id" name="id" class="form-control">
										<label for="localidad">Localidad</label>
										<input type="text" class="form-control" id="localidad_m" name="localidad_m" required="required">
						        	</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						        <button type="button" class="btn btn-primary" onclick="modificar()">Guardar cambios</button>
						      </div>
						      </form>
						    </div>
						  </div>
						</div>
						<!--FIn de Modal de Modificar-->
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
	function listado(){
		$.post("../ajax/ajax.php?opcion=12",{}).done(function(data){
			$("#listado").html(data);
		});
	}
	$("#estado").change(function(){
		$.post("../ajax/ajax.php?opcion=9",{estado:$("#estado").val()}).done(function(data){
			$("#municipio").html(data);
		});
	});
	$("#municipio").change(function(){
		$.post("../ajax/ajax.php?opcion=19",{municipio:$("#municipio").val()}).done(function(data){
			$("#listado").html(data);
		});
	});
	$("#estado_2").change(function(){
		$.post("../ajax/ajax.php?opcion=9",{estado:$("#estado_2").val()}).done(function(data){
			$("#municipio_2").html(data);
		});
	});
	function buscar(){
		$.post("../ajax/ajax.php?opcion=20",{busqueda:$("#busqueda").val()}).done(function(data){
			$("#listado").html(data);
		});
	}
	function guardar(){
		if($("#municipio_2").val()==""||$("#municipio_2").val()=="0"||$("#localidad").val()==""){
			return false;
		}
		else{
			$.post("../ajax/ajax.php?opcion=21",{municipio:$("#municipio_2").val(),localidad:$("#localidad").val()}).done(function(data){
				if(data=="success"){
					$("#alta_l").modal("hide");
					$("#success").modal("toggle");
					$("#form")[0].reset();
				}
				else{
					$("#error_m").html(data);
					$("#error").modal("toggle");
				}
			});
		}
	}
	function baja(id){
		if(confirm("Confirme baja de localidad")){
			$.post("../ajax/ajax.php?opcion=22",{localidad:id}).done(function(data){
				if(data=="success"){
					$("#error_m").html("Baja Correcta");
					$("#error").modal("toggle");
				}
				else{
					console.log(data);
				}
			});
		}
		return false;
	}
	function editar(id){
		$.post("../ajax/ajax.php?opcion=23",{localidad:id}).done(function(data){
			$("#localidad_m").val(data);
			$("#id").val(id);
			$("#modifica_l").modal("toggle");
		});
	}
	function modificar(){
		if($("#localidad_m").val()!=""){
			$.post("../ajax/ajax.php?opcion=24",{localidad:$("#localidad_m").val(),id:$("#id").val()}).done(function(data){
				if(data=="success"){
					$("#modifica_l").modal("hide");
					$("#error_m").html("Modificación correcta");
					$("#error").modal("toggle");
				}
				else{
					console.log(data);
				}
			});
		}
		else{
			$("#error_m").html("No debes dejar el campo vacío");
			$("#error").modal("toggle");
		}
	}
</script>
</body>
</html>