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
<title>Tipo Propiedad</title>
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
				<h3 class="blank1">Tipo de Propiedad</h3>
				<!--Div para formulario para agregar nueva categoria-->
				<div class="tab-content">
					<div class="tab-pane active" id="horizontal-form">
						<form class="form-horizontal" id="form_tp">
							<div class="form-group">
								<label for="nombre_tp" class="col-sm-2 control-label">Nombre</label>
								<div class="col-sm-8">
									<input type="text" class="form-control1" id="nombre_tp" name="nombre_tp" placeholder="Ingrese una nueva categoría" required="required">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
								<!--La clase form_tp es para control en la funcion de jquery-->
									<button type="submit" class="btn-success btn form_tp">Agregar</button>
									<button type="reset" class="btn-default btn form_tp">Limpiar</button>
								</div>
							</div>
						</form>
					</div>
				</div><!--fin del input de busqueda-->
				<br><!--Espaciado -->
				<div class="alert alert-danger col-sm-9 col-sm-offset-1" id="msj_error">
					No se pudo completar la operación.
				</div>
				<br><!--Espaciado -->
				<div class="alert alert-success col-sm-9 col-sm-offset-1" id="msj_success">
					Cambios guardados correctamente.
				</div>
				<br><!--Espaciado -->
				<!--Div para desplegar tabla con listado de tipos de propiedad-->
				<div class="col-sm-9 col-sm-offset-1 xs tabls">
					<div class="bs-example4 panel-body1">
						<table class="table">
							<thead>
								<tr class="warning">
								  	<th>#</th>
								  	<th width="70%">Nombre</th>
								  	<th>Editar</th>
								  	<th>Eliminar</th>
								</tr>
						  	</thead>
						  	<tbody id="t_contenido">
								<tr>
								<?php

									$res = $mysqli->query("select * from selecttp");
									if($res->num_rows > 0){
										$i = 1;
										while ($aux = $res->fetch_assoc()){
											echo "<tr>
											  <th scope='row'>".$i++."</th>
											  <td>".ucwords($aux['Propiedad'])."</td>
											  <td><button type='button' class='btn-info btn' rel=".$aux['idTipo_propiedad']." value='".$aux['Propiedad']."' data-toggle='modal' data-target='#modal_edit'><span class='fa fa-edit'></span></button></td>
											  <td><button type='button' class='btn-danger btn' rel=".$aux['idTipo_propiedad']."><span class='glyphicon glyphicon-remove'></span></button></td>
											</tr>";
										}										
									}else{
										echo "<tr>
											<td colspan='3' style='text-align:center'>No hay datos</td>
										</tr>";
									}
								 ?>
							 	</tr>
						  	</tbody>
						</table>					
					</div>
				</div><!--Fin del espacio para la tabla-->
			</div><!--Fin de graphs-->
		</div><!--Fin de contenido-->
		<!--Modal para edicion de tipo de propiedad-->
		<div class="modal fade " id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog " role="document"><!--Modal pequeña (modal-sm)-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar tipo de propiedad</h4>
					</div>
					<div class="modal-body">
					<form class="form-horizontal" id="form_edit">
						<div class="form-group">
							<label for="nombre_ed" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-9">
								<input type="text" class="form-control1" id="nombre_ed" name="nombre_ed" required="required">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
								<button type="submit" class="btn btn-primary form_tp">Guardar cambios</button>
								<button type="reset" class="btn btn-default form_tp" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
		<!--footer section start-->
			<?php include("../estructura/footer.php"); ?>
        <!--footer section end-->
	</section>
	
<?php include("../estructura/scripts.php"); ?>
<script>
   //funcion para cargar el contenido de la tabla
   function cargar_tabla(){
	$.ajax({
		url: "../ajax/ajax.php?opcion=2",
		success: function(data){
			$("#t_contenido").html(data);
		},
		error: function(data){
			alert(data);
		}
	});
   }
   var id= 0;//para guardar el id seleccionado al editar
   $(document).ready(function(){
   		//Ocultamos los divs con los mensajes
   		$("#msj_success, #msj_error").hide();
   		//agregar nuevo tipo de propiedad
   		$("#form_tp").submit(function(){
   			$(".form_tp").attr("disabled", "disabled");
   			var form = $(this).serialize();
   			$.ajax({
   				url: "../ajax/ajax.php?opcion=1",
   				type: "POST",
   				data: form,
   				success: function(data){
   					if(data){
   						$("#msj_success").slideDown(500).delay(2500).queue(function(n){
   							$(this).slideUp(500);
							n();
   						});
   						cargar_tabla();
   						$(".form_tp").attr("disabled", false);
   						$("#nombre_tp").val('');
   					}else{
   						$("#msj_error").slideDown(500).delay(2500).queue(function(n){
   							$(this).slideUp(500);
							n();
   						});
   					}
   				},
   				error: function(data){
   					$("#msj_error").slideDown(500).delay(2500).queue(function(n){
						$(this).slideUp(500);
						n();
					});
   				}
   			});
   			return false;
   		});

   		//Eliminar un registro
   		$("#t_contenido").on("click", "button[class='btn-danger btn']", function(){
   			var id = $(this).attr("rel");
   			if(confirm("Realmente desea borrar el registro")){
   				$.ajax({
	   				url: "../ajax/ajax.php?opcion=3",
	   				type: "POST",
	   				data: "id="+id,
	   				success: function(data){
	   					if(data){
	   						$("#msj_success").slideDown(500).delay(2500).queue(function(n){
	   							$(this).slideUp(500);
								n();
	   						});
	   						cargar_tabla();
	   					}else{
	   						$("#msj_error").slideDown(500).delay(2500).queue(function(n){
	   							$(this).slideUp(500);
								n();
	   						});
	   					}
	   				},
	   				error: function(data){
	   					$("#msj_error").slideDown(500).delay(2500).queue(function(n){
   							$(this).slideUp(500);
							n();
   						});
	   				}
   				});
   			}//fin del if de confirmación
   		});
   		//Guardar el id en la variable correspondiente
   		$("#t_contenido").on("click", "button[class='btn-info btn']",function(){
   			id = $(this).attr("rel");
   			$("#nombre_ed").val($(this).val());
   		});
   		//Editar tipo de propiedad
   		$("#form_edit").submit(function(){
   			$(".form_tp").attr("disabled", "disabled");
   			$.ajax({
   				url: "../ajax/ajax.php?opcion=4",
   				type: "POST",
   				data: "id="+id + "&nuevo="+$("#nombre_ed").val(),
   				success: function(data){
   					if(data){
   						cargar_tabla();
   						$(".form_tp").attr("disabled", false);
   						$("#nombre_ed").val('');
   						$("#modal_edit").modal("hide");
   						$("#msj_success").slideDown(500).delay(2500).queue(function(n){
   							$(this).slideUp(500);
							n();
   						});
   					}else{
   						$("#msj_error").slideDown(500).delay(2500).queue(function(n){
   							$(this).slideUp(500);
							n();
   						});
   					}
   				},
   				error: function(data){
   					$("#msj_error").slideDown(500).delay(2500).queue(function(n){
						$(this).slideUp(500);
						n();
					});
   				}
   			});
   			return false;
   		});
   });
</script>
</body>
</html>