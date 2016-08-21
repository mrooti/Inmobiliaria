<!DOCTYPE HTML>
<html>
<head>
<title>Login | Inmobiliaria</title>
<?php include("../estructura/head.php"); ?>
</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span>Living House</span> <a href="index.html">Morelia</a></p>
						</div>
						<div class="signin">
							<form id="form">
							<div class="log-input">
								<div class="log-input-left">
								   <input type="text" class="user" placeholder="Correo" id="usuario" name="usuario" required="required">
								</div>
								
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" class="lock" placeholder="Contraseña" id="contrasena" name="contrasena" required="required">
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" value="Entrar">
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
	$("#form").submit(function(){
		$.post("../ajax/ajax.php?opcion=14",{usuario:$("#usuario").val(),contrasena:$("#contrasena").val()}).done(function(data){
			if(data=="success"){
				window.location.assign("blank_page.php");
				$("#usuario").css("border","green solid 1px");
				$("#contrasena").css("border","green solid 1px");
			}
			else if(data=="error_1"){
				$("#usuario").css("border","red solid 1px");
			}
			else if(data=="error_2"){
				$("#usuario").css("border","green solid 1px");
				$("#contrasena").css("border","red solid 1px");
			}
			else{
				console.log(data);
			}
		});
		return false;
	});
	
</script>
</body>
</html>