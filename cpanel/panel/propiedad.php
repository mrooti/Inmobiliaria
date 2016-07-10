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
<title>Agregar Propiedad | Inmobiliaria</title>
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
					<h3 class="blank1">Propiedades</h3>
					<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
						<div class="panel-body no-padding">
						<button type="button" class="btn-success btn form_attr" data-toggle="modal" data-target="#alta_p">Agregar Propiedad</button>
						<br>
						<br>
							<table class="table table-striped">
								<thead>
									<tr class="warning">
										<th>#Control</th>
										<th>Titulo</th>
										<th>Dirección</th>
										<th>C.P.</th>
										<th>Destacada</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody id="listado">
								</tbody>
							</table>
						</div>
					</div>
					<!-- Fin del contenido de tabla -->
					<div class="clearfix"></div>
					
					<!--Inicio de Modal Alta-->
					<div class="modal fade" id="alta_p" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Ingrese los datos solicitados.</h4>
								</div>
								<div class="modal-body">
									<form class="form-horizontal" id="agregar_propiedad">
										<legend class="subcategoria">General</legend>
										<div class="form-group">
											<label for="titulo" class="col-sm-2 control-label">Título</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="titulo" name="titulo" placeholder="El Título de la propiedad">
											</div>
										</div>
										<div class="form-group">
											<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
											<div class="col-sm-8"><textarea name="descripcion" id="descripcion" cols="50" rows="4" class="form-control1"></textarea></div>
										</div>
										<legend class="subcategoria">Ubicación</legend>
										<div class="form-group">
											<label for="calle" class="col-sm-2 control-label">Calle</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="calle" name="calle" placeholder="" required>
											</div>
										</div>
										<div class="form-group">
											<label for="num_int" class="col-sm-2 control-label">Num. Interior</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="num_int" name="num_int" placeholder="">
											</div>
										</div>
										<div class="form-group">
											<label for="num_ext" class="col-sm-2 control-label">Num. Exterior</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="num_ext" name="num_ext" placeholder="">
											</div>
										</div>
										<div class="form-group">
											<label for="colonia" class="col-sm-2 control-label">Colonia</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="colonia" name="colonia" placeholder="" required>
											</div>
										</div>
										<div class="form-group">
											<label for="cp" class="col-sm-2 control-label">Código Postal</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="cp" name="cp" placeholder="">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Estado</label>
											<div class="col-sm-8">
												<select class="form-control1" id="estado" >
													<?php 
													$res = $mysqli->query("select * from estado");
													echo "<option value=''>Seleccione un estado</option>";
													while ($aux = $res->fetch_assoc()) {
														echo "<option value=".$aux['Id_estado'].">".$aux['Estado']."</option>";
													}

													?>

												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Municipio</label>
											<div class="col-sm-8">
												<select class="form-control1" id="municipio"  disabled="disabled">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Localidad</label>
											<div class="col-sm-8">
												<select class="form-control1" id="localidad" name="localidad" disabled="disabled" required>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="sector" class="col-sm-2 control-label">Sector</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="sector" name="sector" placeholder="">
											</div>
										</div>
										<legend class="subcategoria">Detalles de la propiedad</legend>
										<div class="form-group">
											<label for="num_control" class="col-sm-2 control-label">Numero de Control</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="num_control" name="num_control" placeholder="" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Tipo de Propiedad</label>
											<div class="col-sm-8">
												<select class="form-control1" id="t_propiedad" name="t_propiedad" required>
													<?php 
													$res = $mysqli->query("select * from tipo_propiedad");
													echo "<option value=''>Seleccione una opción</option>";
													while ($aux = $res->fetch_assoc()) {
														echo "<option value=".$aux['idTipo_propiedad'].">".ucwords($aux['Propiedad'])."</option>";
													}

													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="myfile" class="col-sm-2 control-label">Imagenes</label>
											<div class="col-sm-8">
												<input type="file" class="form-control1" id="myfile" name="myfile[]" placeholder="" multiple>
											</div>
										</div>
										<div class="form-group">
											<label for="precio" class="col-sm-2 control-label">Precio</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="precio" name="precio" placeholder="">
											</div>
										</div>
										<div class="form-group">
											<label for="precio_m2" class="col-sm-2 control-label">Precio por M²</label>
											<div class="col-sm-8">
												<input type="text" class="form-control1" id="precio_m2" name="precio_m2" placeholder="">
											</div>
										</div>
										<div class="form-group">
											<label for="radio" class="col-sm-2 control-label">Tipo</label>
											<div class="col-sm-8">
												<div class="radio-inline"><label><input type="radio" name="tipo" value="1" required> Venta</label></div>
												<div class="radio-inline"><label><input type="radio" name="tipo" value="2" required> Renta</label></div>
											</div>
										</div>
										<legend class="subcategoria">Atributos</legend>
										<?php 
										$res = $mysqli->query("select * from atributo");
										while ($aux = $res->fetch_assoc()) {
											echo "<div class='col-md-6 col-sm-6'>
													<div class='form-group'>
														<label for='atributos[".$aux['id_atributo']."][]' class='col-sm-2 control-label'>".ucwords($aux['Atributo_propiedad'])."</label>
														<div class='col-sm-offset-1 col-sm-7'>
															<input type='text' class='form-control1' name='atributos[".$aux['id_atributo']."]'>
														</div>
													</div>
												</div>";
										}

										?>
										<div class="clearfix"></div>
										<div class="modal-footer">
											<button type="reset" class="btn btn-default" data-dismiss="modal">Cerrar</button>
											<button type="submit" class="btn btn-primary">Agregar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade bs-example-modal-sm" tabindex="-1" id="success" role="dialog" aria-labelledby="success">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="gridSystemModalLabel">Mensaje</h4>
					    </div>
					    <div class="modal-body">
							<h3 class="text-center">La propiedad ha sido guardado con exito.</h3>
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
					      <h3 class="text-center">Estamos procesando su solicitud, espere por favor.</h3>
					    </div>
					  </div>
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
		$.post("../ajax/ajax.php?opcion=16",{}).done(function(data){
			$("#listado").html(data);
		});
	}
	function baja(id){
		if(confirm("Confirme baja de propiedad")){
			$.post("../ajax/ajax.php?opcion=17",{id:id}).done(function(data){
				if(data=="success"){
					listado();
				}
				else{
					console.log(data);
				}
			});
		}
		return false;
	}

	function destacada(id){
		$.post("../ajax/ajax.php?opcion=18",{id:id}).done(function(data){
			if(data=="success"){
				listado();
			}
			else{
				console.log(data);
			}
		});
	}

	$(document).ready(function(){
		listado();
	});
	//Cargar el select con los municipios despues de seleccionar una opcion de estado
	$('#estado').change(function(){
		//limpiar el select para municipio y loclaidad
		$('#municipio, #localidad').attr("disabled", "disabled");
		$('#localidad, #localidad').val();
		$('#municipio, #localidad').html("");

		$.ajax({
			url: "../ajax/ajax.php?opcion=9",
			type: "POST",
			data: "estado=" + $('#estado').val(),
			success: function(data){
				$('#municipio').attr("disabled", false);
				$('#municipio').html(data);
			},
			error: function(data){
				alert(data);
			}
		});

	});

	//Cargar el select con las localidades despues de seleccionar una opcion de municipio
	$('#municipio').change(function(){
		$('#localidad').attr("disabled", "disabled");
		$.ajax({
			url: "../ajax/ajax.php?opcion=10",
			type: "POST",
			data: "municipio=" + $('#municipio').val(),
			success: function(data){
				$('#localidad').attr("disabled", false);
				$('#localidad').html(data);
			},
			error: function(data){
				alert(data);
			}
		});

	});

	//Enviar formulario
	$('form').submit(function(){
		$("form").find(":submit").attr("disabled", "disabled");
		var fd = new FormData(document.getElementById("agregar_propiedad"));
		$.ajax({
			url: "../ajax/ajax.php?opcion=15",
			type: "POST",
			data: fd,
			processData: false,  // tell jQuery not to process the data
  			contentType: false,   // tell jQuery not to set contentType
  			beforeSend: function(){
				$("#guardando").modal("toggle");
			},
  			success: function(data){
  				if(data.length == 0){
  					$("#guardando").modal("hide");
					$("#alta_p").modal("hide");
					$("#success").modal("toggle");
					$("form").find(":submit").attr("disabled", false);
					$("#agregar_propiedad").each(function(){
						this.reset();
					});
					listado();
				}else{
					$("#guardando").modal("hide");
					$("#error_m").html(data);
					$("#error").modal("toggle");
				}
  			},
  			error: function(data){
  				$("#guardando").modal("hide");
				$("#error_m").html(data);
				$("#error").modal("toggle");
				$("form").find(":submit").attr("disabled", false);
  			}
		});
		return false;
	});
</script>
</body>
</html>