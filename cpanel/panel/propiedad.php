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
				<h3 class="blank1">Alta de Propiedad</h3>
					<form class="form-horizontal" id="agregar_propiedad">
						<legend><i>General</i></legend>
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
						<legend><i>Ubicación</i></legend>
						<div class="form-group">
							<label for="calle" class="col-sm-2 control-label">Calle</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" id="calle" name="calle" placeholder="">
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
								<input type="text" class="form-control1" id="colonia" name="colonia" placeholder="">
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
								<select class="form-control1" id="localidad" name="localidad" disabled="disabled">
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="sector" class="col-sm-2 control-label">Sector</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" id="sector" name="sector" placeholder="">
							</div>
						</div>
						<legend><i>Detalles de la propiedad</i></legend>
						<div class="form-group">
							<label for="num_control" class="col-sm-2 control-label">Numero de Control</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" id="num_control" name="num_control" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tipo de Propiedad</label>
							<div class="col-sm-8">
								<select class="form-control1" id="t_propiedad" name="t_propiedad">
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
								<div class="radio-inline"><label><input type="radio" name="tipo" value="1"> Venta</label></div>
								<div class="radio-inline"><label><input type="radio" name="tipo" value="2"> Renta</label></div>
							</div>
						</div>
						<legend>Atributos</legend>
						<?php 
						$res = $mysqli->query("select * from atributo");
						while ($aux = $res->fetch_assoc()) {
							echo "<div class='form-group'>
									<label for='atributos[".$aux['id_atributo']."][]' class='col-sm-2 control-label'>".ucwords($aux['Atributo_propiedad'])."</label>
									<div class='col-sm-8'>
										<input type='text' class='form-control1' name='atributos[".$aux['id_atributo']."]'>
									</div>
								</div>";
						}

						?>
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
							<!--La clase form_tp es para control en la funcion de jquery-->
								<button type="submit" class="btn-success btn form_tp">Agregar</button>
								<button type="reset" id="btn_reset" class="btn-default btn form_tp">Limpiar</button>
							</div>
						</div>
					</form>
				<div class="clearfix"></div>
				<br><!--Espaciado -->
				<div class="alert alert-danger col-sm-9 col-sm-offset-1" id="msj_error">
					No se pudo completar la operación.
				</div>
				<br><!--Espaciado -->
				<div class="alert alert-success col-sm-9 col-sm-offset-1" id="msj_success">
					Cambios guardados correctamente.
				</div>
				<br><!--Espaciado -->
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
	//Ocultar los divs con los mensajes
   	$("#msj_success, #msj_error").hide();
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
  			success: function(data){
  				$("#msj_success").slideDown(500).delay(2500).queue(function(n){
					$(this).slideUp(500);
				n();
				});
				$("form").find(":submit").attr("disabled", false);
				$("#agregar_propiedad").each(function(){
					this.reset();
				});
  			},
  			error: function(data){
  				$("#msj_error").slideDown(500).delay(2500).queue(function(n){
					$(this).slideUp(500);
				n();
				});
				$("form").find(":submit").attr("disabled", false);
  			}
		});
		return false;
	});
</script>
</body>
</html>