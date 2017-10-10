<!DOCTYPE HTML>
<?php 
	include("../control/connection.php"); 
	include("../control/security.php"); 
	if(!permisos(array("1"))){
		echo "<script>location.assign(\"login.php\")</script>";
	}
	?>
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
							<button type="button" class="btn-success btn form_attr" data-toggle="modal" data-target="#alta_u">Agregar Usuario</button>
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
						<div class="modal fade" id="alta_u" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Ingrese los datos solicitados.</h4>
						      </div>
						      <div class="modal-body">
						        <form id="form">
						        	<div class="form-group">
										<label for="Nombres">Nombre</label>
										<input type="text" class="form-control1" id="nombre" name="nombre" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Apellido_p">Apellido Paterno</label>
										<input type="text" class="form-control1" id="apellido_p" name="apellido_p" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Apellido_m">Apellido Materno</label>
										<input type="text" class="form-control1" id="apellido_m" name="apellido_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="rfc">RFC</label>
										<input type="text" class="form-control1" id="rfc" name="rfc" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="CURP">CURP</label>
										<input type="text" class="form-control1" id="curp" name="curp" required="required">
						        	</div>
									<div class="form-group">
										<label for="calle">Calle</label>
										<input type="text" class="form-control1" id="calle" name="calle" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="numero interior">Número Interior</label>
										<input type="text" class="form-control1" id="numero_i" name="numero_i" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="numero exterior">Número Exterior</label>
										<input type="text" class="form-control1" id="numero_e" name="numero_e">
						        	</div>
						        	<div class="form-group">
										<label for="colonia">Colonia</label>
										<input type="text" class="form-control1" id="colonia" name="colonia" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Codigo postal">Código Postal</label>
										<input type="text" class="form-control1" id="cp" name="cp" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Estado">Elige el Estado</label>
										<select class="form-control" name="estado" id="estado" required="required">
											<?php
												$resultado=$mysqli->query("SELECT * FROM estado")or die("error en: ".$mysqli->error);
												while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
													echo "<option value=\"{$row['Id_estado']}\">{$row['Estado']}</option>";
												}
											?>
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Municipio">Elige el Municipio</label>
										<select class="form-control" name="municipio" id="municipio" required="required">
											
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Municipio">Elige el Localidad</label>
										<select class="form-control" name="localidad" id="localidad" required="required">
											
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Telefono">Telefono</label>
										<input type="number" class="form-control1" id="telefono" name="telefono" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Tipo de Usuario">Tipo de Usuario</label>
										<select class="form-control" id="t_u" name="t_u" required="required">
											<?php
												$resultado=$mysqli->query("SELECT * FROM tipo_usuario")or die("error en: ".$mysqli->error);
												while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
													echo "<option value=\"{$row['Id_tipo_usuario']}\">{$row['Tipo_usuario']}</option>";
												}
											?>
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Correo">Correo</label>
										<input type="email" class="form-control1" id="correo" name="correo" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Contraseña">Contraseña</label>
										<input type="password" class="form-control1" id="password1" name="password1" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Repetir contraseña">Vuelva a ingresar la contraseña</label>
										<input type="password" class="form-control1" id="password2" name="password2" required="required">
						        	</div>
						       
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
						      </div>
						      </form>
						    </div>
						  </div>
						</div>
						<!--Fin Modal alta-->
						<!-- Modal Módificar -->
						<div class="modal fade" id="modificar_u" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Ingrese los datos solicitados.</h4>
						      </div>
						      <div class="modal-body">
						        <form id="form_m">
						        	<div class="form-group">
										<label for="Nombres">#</label>
										<input type="number" class="form-control1" id="id_m" name="id_m" readonly="readonly">
						        	</div>
						        	<div class="form-group">
										<label for="Nombres">Nombre</label>
										<input type="text" class="form-control1" id="nombre_m" name="nombre_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Apellido_p">Apellido Paterno</label>
										<input type="text" class="form-control1" id="apellido_p_m" name="apellido_p_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Apellido_m">Apellido Materno</label>
										<input type="text" class="form-control1" id="apellido_m_m" name="apellido_m_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="rfc">RFC</label>
										<input type="text" class="form-control1" id="rfc_m" name="rfc_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="CURP">CURP</label>
										<input type="text" class="form-control1" id="curp_m" name="curp_m" required="required">
						        	</div>
									<div class="form-group">
										<label for="calle">Calle</label>
										<input type="text" class="form-control1" id="calle_m" name="calle_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="numero interior">Número Interior</label>
										<input type="text" class="form-control1" id="numero_i_m" name="numero_i_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="numero exterior">Número Exterior</label>
										<input type="text" class="form-control1" id="numero_e_m" name="numero_e_m">
						        	</div>
						        	<div class="form-group">
										<label for="colonia">Colonia</label>
										<input type="text" class="form-control1" id="colonia_m" name="colonia_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Codigo postal">Código Postal</label>
										<input type="text" class="form-control1" id="cp_m" name="cp_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Estado">Elige el Estado</label>
										<select class="form-control" name="estado_m" id="estado_m" required="required">
											<?php
												$resultado=$mysqli->query("SELECT * FROM estado")or die("error en: ".$mysqli->error);
												while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
													echo "<option value=\"{$row['Id_estado']}\">{$row['Estado']}</option>";
												}
											?>
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Municipio">Elige el Municipio</label>
										<select class="form-control" name="municipio_m" id="municipio_m" required="required">
											
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Municipio">Elige el Localidad</label>
										<select class="form-control" name="localidad_m" id="localidad_m" required="required">
											
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Telefono">Telefono</label>
										<input type="number" class="form-control1" id="telefono_m" name="telefono_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Tipo de Usuario">Tipo de Usuario</label>
										<select class="form-control" id="t_u_m" name="t_u_m" required="required">
											<?php
												$resultado=$mysqli->query("SELECT * FROM tipo_usuario")or die("error en: ".$mysqli->error);
												while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
													echo "<option value=\"{$row['Id_tipo_usuario']}\">{$row['Tipo_usuario']}</option>";
												}
											?>
										</select>
						        	</div>
						        	<div class="form-group">
										<label for="Correo">Correo</label>
										<input type="email" class="form-control1" id="correo_m" name="correo_m" required="required">
						        	</div>
						        	<div class="form-group">
										<label for="Contraseña">Contraseña</label>
										<input type="password" class="form-control1" id="password1_m" name="password1_m">
						        	</div>
						        	<div class="form-group">
										<label for="Repetir contraseña">Vuelva a ingresar la contraseña</label>
										<input type="password" class="form-control1" id="password2_m" name="password2_m">
						        	</div>
						       
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
						      </div>
						      </form>
						    </div>
						  </div>
						</div>
						<!-- Fin Modal Módificar -->
						<!--Modal success-->
						<div class="modal fade bs-example-modal-sm" tabindex="-1" id="success" role="dialog" aria-labelledby="success">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="gridSystemModalLabel">Alerta</h4>
						    </div>
						    <div class="modal-body">
								<h3>El usuario ha sido guardado con exito.</h3>
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
		$.post("../ajax/ajax.php?opcion=10",{municipio:$("#municipio").val()}).done(function(data){
			$("#localidad").html(data);
		});
	});
	$("#password2").focusout(function(){
		if($("#password1").val()==$("#password2").val()){
			$("#password1").css("border","green solid 1px");
			$("#password2").css("border","green solid 1px");
		}
		else{
			$("#password1").css("border","green solid 1px");
			$("#password2").css("border","red solid 1px");
		}
	});
	$("#form").submit(function(){
		if($("#password1").val()==$("#password2").val()){
			var data=$("#form").serialize();
			$.ajax({
				url: "../ajax/ajax.php?opcion=11",
				method: "POST",
				data: data,
				beforeSend: function(){
					$("#guardando").modal("toggle");
				},
			}).done(function(data){
				if(data=="success"){
					$("#guardando").modal("hide");
					$("#alta_u").modal("hide");
					$("#success").modal("toggle");
					$("#form")[0].reset();
					listado();
				}
				else{
					$("#guardando").modal("hide");
					$("#error_m").html(data);
					$("#error").modal("toggle");
				}
			});
		}
		else{
			$("#password1").css("border","green solid 1px");
			$("#password2").css("border","red solid 1px");
		}
		return false;
	});
	$(document).ready(function(){
		listado();
	});
	function baja(id){
		if(confirm("Confirme baja de usuario")){
			$.post("../ajax/ajax.php?opcion=13",{id:id}).done(function(data){
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
	function editar(id){
		if(id!=""&&id!=null){
			$.post("../ajax/ajax.php?opcion=30",{usuario:id}).done(function(data){
				var r= JSON.parse(data);
				$('#id_m').val(r.id_persona);
				$('#nombre_m').val(r.nombre);
				$('#apellido_p_m').val(r.apellido_p);
				$('#apellido_m_m').val(r.apellido_m);
				$('#calle_m').val(r.calle);
				$('#colonia_m').val(r.colonia);
				$('#correo_m').val(r.correo);
				$('#cp_m').val(r.cp);
				$('#curp_m').val(r.curp);
				$('#t_u_m').val(r.id_tipo_usuario);
				$('#numero_e_m').val(r.n_exterior);
				$('#numero_i_m').val(r.n_interior);
				$('#rfc_m').val(r.rfc);
				$('#telefono_m').val(r.telefono);
				$('#estado_m').val(r.id_estado);
				$.post("../ajax/ajax.php?opcion=9",{estado:$("#estado_m").val()}).done(function(data){
					$("#municipio_m").html(data);
				});
				$('#municipio_m').val(r.id_municipio);
				$.post("../ajax/ajax.php?opcion=10",{municipio:$("#municipio_m").val()}).done(function(data){
					$("#localidad_m").html(data);
				});
				$('#localidad_m').val(r.id_localidad);
				$('#modificar_u').modal('toggle');
			});
		}else{
			return false;
		}
	}
	$("#password2_m").focusout(function(){
		if($("#password1_m").val()==$("#password2_m").val()){
			$("#password1_m").css("border","green solid 1px");
			$("#password2_m").css("border","green solid 1px");
		}
		else{
			$("#password1_m").css("border","green solid 1px");
			$("#password2_m").css("border","red solid 1px");
		}
	});
	$("#estado_m").change(function(){
		$.post("../ajax/ajax.php?opcion=9",{estado:$("#estado_m").val()}).done(function(data){
			$("#municipio_m").html(data);
		});
	});
	$("#municipio_m").change(function(){
		$.post("../ajax/ajax.php?opcion=10",{municipio:$("#municipio_m").val()}).done(function(data){
			$("#localidad_m").html(data);
		});
	});
	$('#form_m').submit(function(){
		var data=$("#form_m").serialize();
		$.ajax({
				url: "../ajax/ajax.php?opcion=31",
				method: "POST",
				data: data,
				beforeSend: function(){
					$("#guardando").modal("toggle");
				},
			}).done(function(data){
				if(data=="success"){
					$("#guardando").modal("hide");
					$("#modificar_u").modal("hide");
					$("#success").modal("toggle");
					$("#form_m")[0].reset();
					listado();
				}
				else{
					$("#guardando").modal("hide");
					$("#error_m").html(data);
					$("#error").modal("toggle");
				}
			});
		return false;
	});
	$('#password1_m').tooltip({'trigger':'focus', 'title': 'Si no desea cambiar contraseña debe dejar en blanco ambos campos'});
	$('#password2_m').tooltip({'trigger':'focus', 'title': 'Si no desea cambiar contraseña debe dejar en blanco ambos campos'});
</script>
</body>
</html>