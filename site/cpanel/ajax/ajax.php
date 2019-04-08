<?php
	include("../control/connection.php");
	include("../control/security.php");
	//se incluyen los archivos de coneccción a la base de datos y el de seguridad
	//TODA VARIABLE RECIBIDA A ESTE ARCHIVO DEBE PASARSE POR LA FUNCIÓN seguridad(variable)
	switch(seguridad($_GET["opcion"])){
		//cada caso que se vaya agregando, debe estar comentado para saber que se esta realizando
		case 1:
		//Agregar nuevo registro a la tabla tipo_propiedad de la base de datos
			if($mysqli->query("call inserttp('".seguridad($_POST['nombre_tp'])."')")){
				echo true;
			}else{
				echo "Error";
			}
		break;
		case 2:
		//Regresa el contenido de la tabla tipo_propiedad del archivo panel/tipo_propiedad.php
			$res = $mysqli->query("select * from selecttp");
				if($res->num_rows > 0){
					$str = "";
					$i = 1;
					while ($aux = $res->fetch_assoc()){
						$str .= "<tr>
						  <th scope='row'>".$i++."</th>
						  <td>".ucwords($aux['Propiedad'])."</td>
						  <td><button type='button' class='btn-info btn' rel=".$aux['idTipo_propiedad']." value='".$aux['Propiedad']."' data-toggle='modal' data-target='#modal_edit'><span class='fa fa-edit'></span></button></td>
						  <td><button type='button' class='btn-danger btn' rel=".$aux['idTipo_propiedad']."><span class='glyphicon glyphicon-remove'></span></button></td>
						</tr>";
					}										
				}else{
					$str = "<tr>
					<td colspan='3' style='text-align:center'>No hay datos</td>
					</tr>";
				}
				echo $str;
		break;
		case 3:
		//Borrar registro de la tabla tipo_propiedad de la base de datos
			if($mysqli->query("call deletetp(".seguridad($_POST['id']).")")){
				echo true;
			}else{
				echo "Error";
			}
		break;
		case 4:
		//editar campo de la tabla tipo_propiedad de la base de datos
			if($mysqli->query("call updatetp('".seguridad($_POST['nuevo'])."',".seguridad($_POST['id']).")")){
				echo true;
			}else{
				echo "Error";
			}
		break;
		case 5:
		//Agregar nuevo registro a la tabla atributo de la base de datos
			if($mysqli->query("call insertattr('".seguridad($_POST['nombre_attr'])."')")){
				echo true;
			}else{
				echo "Error";
			}
		break;
		case 6:
		//Regresa el contenido de la tabla atributo del archivo panel/atributos.php
			$res = $mysqli->query("select * from selectattr");
				if($res->num_rows > 0){
					$str = "";
					$i = 1;
					while ($aux = $res->fetch_assoc()){
						$str .= "<tr>
								  <th scope='row'>".$i++."</th>
								  <td>".ucwords($aux['Atributo_propiedad'])."</td>
								  <td><button type='button' class='btn-info btn' rel=".$aux['id_atributo']." value='".$aux['Atributo_propiedad']."' data-toggle='modal' data-target='#modal_edit'><span class='fa fa-edit'></span></button></td>
								  <td><button type='button' class='btn-danger btn' rel=".$aux['id_atributo']."><span class='glyphicon glyphicon-remove'></span></button></td>
								</tr>";
					}				
				}else{
					$str = "<tr>
					<td colspan='3' style='text-align:center'>No hay datos</td>
					</tr>";
				}
				echo $str;
		break;
		case 7:
		//Borrar registro de la tablas atributo de la base de datos
			if($mysqli->query("call deleteattr(".seguridad($_POST['id']).")")){
				echo true;
			}else{
				echo "Error";
			}
		break;
		case 8:
		//editar campo de la tabla atributo de la base de datos
			if($mysqli->query("call updateattr('".seguridad($_POST['nuevo'])."',".seguridad($_POST['id']).")")){
				echo true;
			}else{
				echo "Error";
			}
		break;
		case 9://Mostrar municipios de un estado recienbiendo variable post "estado"
			if(isset($_POST['estado'])){
				$estado=seguridad($_POST['estado']);
				$resultado=$mysqli->query("SELECT Id_municipio, Municipio FROM municipio WHERE Id_estado='{$estado}'")or die("Error en: ".$mysqli->error);
				while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
					echo "<option value=\"{$row['Id_municipio']}\">{$row['Municipio']}</option>";
				}
			}else{
				echo "Error";
			}
		break;
		case 10://Mostrar localidades de un municipio recibiendo variable post "municipio"
			if(isset($_POST['municipio'])){
				$municipio=seguridad($_POST['municipio']);
				$resultado=$mysqli->query("SELECT id_localidad, Localidad FROM localidad WHERE Id_municipio='{$municipio}'")or die("Error en: ".$mysqli->error);
				while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
					echo "<option value=\"{$row['id_localidad']}\">{$row['Localidad']}</option>";
				}
			}else{
				echo "Error";
			}
		break;
		case 11://alta de un usuario
			if(isset($_POST['nombre'])&&isset($_POST['apellido_p'])&&isset($_POST['apellido_m'])&&isset($_POST['rfc'])&&isset($_POST['curp'])&&isset($_POST['calle'])&&isset($_POST['numero_i'])&&isset($_POST['numero_e'])&&isset($_POST['colonia'])&&isset($_POST['cp'])&&isset($_POST['localidad'])&&isset($_POST['telefono'])&&isset($_POST['t_u'])&&isset($_POST['correo'])&&isset($_POST['password1'])){
				$nombre=seguridad($_POST['nombre']);
				$apellido_p=seguridad($_POST['apellido_p']);
				$apellido_m=seguridad($_POST['apellido_m']);
				$rfc=seguridad($_POST['rfc']);
				$curp=seguridad($_POST['curp']);
				$calle=seguridad($_POST['calle']);
				$numero_i=seguridad($_POST['numero_i']);
				$numero_e=seguridad($_POST['numero_e']);
				$colonia=seguridad($_POST['colonia']);
				$cp=seguridad($_POST['cp']);
				$localidad=seguridad($_POST['localidad']);
				$telefono=seguridad($_POST['telefono']);
				$t_u=seguridad($_POST['t_u']);
				$correo=seguridad($_POST['correo']);
				$pass=seguridad($_POST['password1']);
				$pass=hash('sha256', md5($pass));
				$resultado=$mysqli->query("INSERT INTO persona(Nombres, Apellido_p,apellido_m,RFC,CURP,calle,nu_exterior,nu_interior,colonia,CP,Id_localidad,telefono,Id_tipo_usuario,Correo,Contrasena,Estado) VALUES('{$nombre}','{$apellido_p}','{$apellido_m}','{$rfc}','{$curp}','{$calle}','{$numero_e}','{$numero_i}','{$colonia}','{$cp}','{$localidad}','{$telefono}','{$t_u}','{$correo}','{$pass}','1')")or die("error en: ".$mysqli->error);
				if($resultado){
					echo "success";
				}
				else{
					echo "error_2";//error de alta
				}
			}
			else{
				echo "error_1";
			}
		break;
		case 12://actualizar tabla de listado de usuarios
			//codigo para consulta
			$resultado=$mysqli->query("SELECT id_persona, Nombres, Apellido_p, apellido_m, RFC FROM persona WHERE Estado='1'");
			while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
				echo "<tr>
						<td>{$row['id_persona']}</td>
						<td>{$row['Nombres']}</td>
						<td>{$row['Apellido_p']}</td>
						<td>{$row['apellido_m']}</td>
						<td>{$row['RFC']}</td>
						<td><button type='button' class='btn-success btn' onclick=editar(\"{$row['id_persona']}\") title='Editar'><span class='glyphicon glyphicon-edit'></span></button><button type='button' class='btn-danger btn' onclick=baja(\"{$row['id_persona']}\")><span class='glyphicon glyphicon-remove'></span></button></td>
					</tr>";
			}
		break;
		case 13://Baja de usuario
			if(isset($_POST['id'])){
				$id=seguridad($_POST['id']);
				$resultado=$mysqli->query("UPDATE persona SET Estado='0' WHERE id_persona='{$id}'")or die("Error en: ".$mysqli->error);
				if($resultado){
					echo "success";
				}
				else{
					echo "error_1";
				}
			}
			else{
				echo "error_2";
			}
		break;
		case 14://sesión
			if(isset($_POST['usuario'])&&isset($_POST['contrasena'])){
				$usuario=seguridad($_POST['usuario']);
				$contrasena=seguridad($_POST['contrasena']);
				$contrasena=hash('sha256', md5($contrasena));
				$resu=$mysqli->query("SELECT id_persona FROM persona WHERE Correo='{$usuario}' AND Estado='1'")or die("Error en:".$mysqli->error);
				$resu2=$mysqli->query("SELECT id_persona FROM persona WHERE Correo='{$usuario}' AND Contrasena='{$contrasena}' AND Estado=1")or die("Error en:".$mysqli->error);
				$num=$resu2->num_rows;
				if($resu){//usuario existe
					if($resu2&&$num>0){
						$ip=get_ip();
						$id=$resu2->fetch_array(MYSQLI_ASSOC);
						$codigo=aleat("64");
						$confirma=$mysqli->query("INSERT INTO sesion(Codigo,IP,Fecha,Id_persona,Estado) VALUES('{$codigo}','{$ip}',(select now()),'{$id['id_persona']}','1')")or die("error en: ".$mysqli->error);
						if($confirma){
							crea_sesion($codigo,$id);
							echo "success";
						}
						else{
							echo "error_3";
						}
					}
					else{
						echo "error_2";
					}
				}
				else{
					echo "error_1";
				}
			}
			else{
				echo "error_0";//no fueron declaradas las variables
			}
		break;
		case 15:
			//agregar propiedad a la base de datos
			session_start();
			$usuario = $_SESSION['user']['id_persona'];
			$titulo = seguridad($_POST['titulo']);
			$descripcion = seguridad($_POST['descripcion']);
			$calle = seguridad($_POST['calle']);
			$num_int = seguridad($_POST['num_int']);
			$num_ext = seguridad($_POST['num_ext']);
			$colonia = seguridad($_POST['colonia']);
			$cp = seguridad($_POST['cp']);
			$localidad = seguridad($_POST['localidad']);
			$sector = seguridad($_POST['sector']);
			$t_propiedad = seguridad($_POST['t_propiedad']);
			$num_control = seguridad($_POST['num_control']);
			$precio = seguridad($_POST['precio']);
			$precio_m2 = seguridad($_POST['precio_m2']);
			$precio = seguridad($_POST['precio']);
			$tipo = seguridad($_POST['tipo']);
			$atributos = $_POST['atributos'];
			 // var_dump($atributos);

			$query = $mysqli->query("INSERT INTO propiedad(Titulo,Descripcion,calle,nu_exterior,nu_interior,colonia,CP,Id_localidad,Sector,Id_tipo_propiedad,Estado,Id_persona,Aprobado,numero_control) VALUES('{$titulo}','{$descripcion}','{$calle}','{$num_ext}','{$num_int}','{$colonia}','{$cp}','{$localidad}','{$sector}','{$t_propiedad}',1,'{$usuario}','1','{$num_control}')");

			$id_propiedad = $mysqli->insert_id;

			if($id_propiedad != ""){//verificamos que haya insertado en la tabla principal
				//insertar en atributo_propiedad
				foreach ($atributos as $pos => $valor) {
					if($valor != ""){
						$mysqli->query("INSERT INTO atributo_propiedad VALUES ('".seguridad($pos)."','{$id_propiedad}','".seguridad($valor)."')");
					}					
				}
				//insertar en fotografia
				//si $_FILES["myfile"]["error"] en su primera posicion (primer archivo) tiene error 4, es que no se agrego ningun archivo
				if(isset($_FILES["myfile"]) && $_FILES["myfile"]["error"][0] != 4) 
				{
					$output_dir = "../uploads/";
					$agregado = true;
					$error =$_FILES["myfile"]["error"];
					//agregar archivos
					$fileCount = count($_FILES["myfile"]["name"]);
					for($i=0; $i < $fileCount; $i++)
					{
						$nom_img = normaliza($_FILES["myfile"]["name"][$i]);
						$fileName = $num_control."-".$nom_img;
						move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
						// insertar a la base de datos
						$res = $mysqli->query("INSERT INTO fotografia (Ruta, nombre, id_Propiedad) VALUES ('".$fileName."', '{$nom_img}','{$id_propiedad}')")or die("Error en:".$mysqli->error);
						if(!$res){
							$agregado= false;
							break;
						}
					}
					
					if(!$agregado){
						echo "error_1";
					}
				}
				//insertar en propiedad_operacion
				$mysqli->query("INSERT INTO propiedad_operacion VALUES ('{$id_propiedad}', NULL, '{$precio}', '{$precio_m2}', '{$tipo}')");

			}else{
				echo "error_0";
			}
		break;
		case 16://listado de propiedades
			$resultado=$mysqli->query("SELECT id_Propiedad, numero_control, Titulo, calle, nu_exterior, nu_interior, colonia, CP, destacada FROM propiedad WHERE Aprobado='1'");
			while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
				$direccion = $row['calle']." #".$row['nu_exterior'];
				if($row['nu_interior'] != "") {
					$direccion .= " Int.".$row['nu_interior']." Col. ".$row['colonia'];
				}else{
					$direccion .= " Col. ".$row['colonia'];
				}
				if($row['destacada'] == 1){
					$destacada = "destacada";
				}else{
					$destacada = "nodestacada";
				}
				echo "<tr>
						<td>{$row['numero_control']}</td>
						<td>{$row['Titulo']}</td>
						<td>{$direccion}</td>
						<td>{$row['CP']}</td>
						<td class='text-center'><span class='dest glyphicon glyphicon-star-empty ".$destacada."' onclick=destacada(\"{$row['id_Propiedad']}\") ></span></td>
						<td><button type='button' class='btn-danger btn' onclick=baja(\"{$row['id_Propiedad']}\") title='Eliminar'><span class='glyphicon glyphicon-remove'></span></button>
						<button type='button' class='btn-success btn' onclick=editar(\"{$row['id_Propiedad']}\") title='Editar'><span class='glyphicon glyphicon-edit'></span></button></td>
					</tr>";
			}
		break;
		case 17://dar de baja una propiedad
			if(isset($_POST['id'])){
				$id=seguridad($_POST['id']);
				$resultado=$mysqli->query("UPDATE propiedad SET Aprobado='0' WHERE id_Propiedad='{$id}'")or die("Error en: ".$mysqli->error);
				if($resultado){
					echo "success";
				}
				else{
					echo "error_1";
				}
			}
			else{
				echo "error_2";
			}
		break;
		case 18://marcar como destacada
			if(isset($_POST['id'])){
				$id=seguridad($_POST['id']);
				$res=$mysqli->query("SELECT destacada FROM propiedad WHERE id_Propiedad='{$id}'")or die("Error en: ".$mysqli->error);
				$row=$res->fetch_array(MYSQLI_ASSOC);
				$row['destacada'] == 1 ? $destacada = 0 : $destacada = 1; 
				$resultado=$mysqli->query("UPDATE propiedad SET destacada='{$destacada}' WHERE id_Propiedad='{$id}'")or die("Error en: ".$mysqli->error);
				if($resultado){
					echo "success";
				}
				else{
					echo "error_1";
				}
			}
			else{
				echo "error_2";
			}
		break;
		case 19: //Mostrar localidades de municipio en tabla
		if(isset($_POST['municipio'])){
				$municipio=seguridad($_POST['municipio']);
				$resultado=$mysqli->query("SELECT id_localidad, Localidad FROM localidad WHERE Id_municipio='{$municipio}' ORDER BY Localidad ASC")or die("Error en: ".$mysqli->error);
				while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
					echo "<tr>
							<td>{$row['Localidad']}</td>
							<td>
								<button type='button' class='btn-success btn' onclick=editar(\"{$row['id_localidad']}\") title='Editar'><span class='glyphicon glyphicon-edit'></span></button>
								<button type='button' class='btn-danger btn' onclick=baja(\"{$row['id_localidad']}\")><span class='glyphicon glyphicon-remove'></span></button>
							</td>
					</tr>";
				}
			}else{
				echo "Error";
			}
		break;
		case 20: //realizar bsuqueda de una localidad
			if(isset($_POST['busqueda'])){
				$busqueda=seguridad($_POST['busqueda']);
				$resultado=$mysqli->query("SELECT id_localidad, Localidad FROM localidad WHERE Localidad LIKE '%{$busqueda}%' ORDER BY Localidad ASC")or die("Error en: ".$mysqli->error);
				while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
					echo "<tr>
							<td>{$row['Localidad']}</td>
							<td>
								<button type='button' class='btn-success btn' onclick=editar(\"{$row['id_localidad']}\") title='Editar'><span class='glyphicon glyphicon-edit'></span></button>
								<button type='button' class='btn-danger btn' onclick=baja(\"{$row['id_localidad']}\")><span class='glyphicon glyphicon-remove'></span></button>
							</td>
					</tr>";
				}
			}
			else{
				echo "<tr><td>No se ha encontrado incidencias</td></tr>";
			}
		break;
		case 21://alta de localidad
			if(isset($_POST['localidad'])&&isset($_POST['municipio'])){
				$municipio=seguridad($_POST['municipio']);
				$localidad=seguridad($_POST['localidad']);
				$resultado=$mysqli->query("INSERT INTO localidad(Id_municipio,Localidad) VALUES('{$municipio}','{$localidad}')")or die("Error en: ".$mysqli->error);
				if($resultado)
					echo "success";
				else
					echo "error_1";
			}
			else{
				echo "error_0";
			}
		break;
		case 22://baja
			if(isset($_POST['localidad'])){
				$localidad=seguridad($_POST['localidad']);
				$resultado=$mysqli->query("DELETE FROM localidad WHERE id_localidad={$localidad}")or die("Error en:".$mysqli->error);
				if($resultado)
					echo "success";
				else
					echo "error_1";
			}
			else{
				echo "error_0";
			}
			break;
		case 23: //obtener info de localidad para ser modificada
			if(isset($_POST['localidad'])){
				$localidad=seguridad($_POST['localidad']);
				$resultado=$mysqli->query("SELECT Localidad FROM localidad WHERE id_localidad={$localidad}")or die("error en:".$mysqli->error);
				$row=$resultado->fetch_array(MYSQLI_ASSOC);
				echo $row['Localidad'];
			}
			else{
				echo "error_0";
			}
		break;
		case 24://modificar localidad
			if(isset($_POST['localidad'])&&isset($_POST['id'])){
				$localidad=seguridad($_POST['localidad']);
				$id=seguridad($_POST['id']);
				$resultado=$mysqli->query("UPDATE localidad SET Localidad='{$localidad}' WHERE id_localidad={$id}")or die("error en:".$mysqli->error);
				if($resultado)
					echo "success";
				else
					echo "error_1";	
			}
			else{
				echo "error_0";
			}
		break;
		case 25://regresar datos para update de propiedad
				if(isset($_POST['id'])){
					$id=seguridad($_POST['id']);
					$resultado=$mysqli->query("SELECT * FROM propiedad WHERE id_Propiedad='{$id}'")or die("Error en: ".$mysqli->error);
					$row=$resultado->fetch_array(MYSQLI_ASSOC);
					$res['id'] = $row['id_Propiedad'];
					$res['titulo'] = seguridad_decode($row['Titulo']);
					$res['descripcion'] = seguridad_decode($row['Descripcion']);
					$res['calle'] = seguridad_decode($row['calle']);
					$res['nu_exterior'] = $row['nu_exterior'];
					$res['nu_interior'] = $row['nu_interior'];
					$res['colonia'] = seguridad_decode($row['colonia']);
					$res['cp'] = $row['CP'];
					$res['sector'] = seguridad_decode($row['Sector']);
					$res['numero_control'] = seguridad_decode($row['numero_control']);
					$res['localidad'] = "";
					$res['municipio'] = "";
					$res['estado'] = "";
					$res['tipo_propiedad'] = "";
					$res['atributos'] = "";

					$id_localidad = $row['Id_localidad'];
					$res2 = $mysqli->query("SELECT * FROM localidad WHERE Id_municipio=(SELECT Id_municipio FROM localidad WHERE id_localidad = '{$id_localidad}')")or die("Error en: ".$mysqli->error);

					$id_municipio = "";
					while($row2=$res2->fetch_array(MYSQLI_ASSOC)){
						if($row2['id_localidad'] == $id_localidad){
							$res['localidad'] .= "<option value=\"{$row2['id_localidad']}\" selected='selected'>{$row2['Localidad']}</option>";
							$id_municipio = $row2['Id_municipio'];
						}else{
							$res['localidad'] .= "<option value=\"{$row2['id_localidad']}\">{$row2['Localidad']}</option>";							
						}
					}

					$res2 = $mysqli->query("SELECT * FROM municipio WHERE Id_estado=(SELECT Id_estado FROM municipio WHERE Id_municipio = '{$id_municipio}')")or die("Error en: ".$mysqli->error);

					$id_estado = "";
					while($row2=$res2->fetch_array(MYSQLI_ASSOC)){
						if($row2['Id_municipio'] == $id_municipio){
							$res['municipio'] .= "<option value=\"{$row2['Id_municipio']}\" selected='selected'>{$row2['Municipio']}</option>";
							$id_estado = $row2['Id_estado'];
						}else{
							$res['municipio'] .= "<option value=\"{$row2['Id_municipio']}\">{$row2['Municipio']}</option>";							
						}
					}

					$res2 = $mysqli->query("SELECT * FROM estado")or die("Error en: ".$mysqli->error);

					while($row2=$res2->fetch_array(MYSQLI_ASSOC)){
						if($row2['Id_estado'] == $id_estado){
							$res['estado'] .= "<option value=\"{$row2['Id_estado']}\" selected='selected'>{$row2['Estado']}</option>";
						}else{
							$res['estado'] .= "<option value=\"{$row2['Id_estado']}\">{$row2['Estado']}</option>";							
						}
					}

					$res2 = $mysqli->query("SELECT * FROM tipo_propiedad")or die("Error en: ".$mysqli->error);

					while($row2=$res2->fetch_array(MYSQLI_ASSOC)){
						if($row2['idTipo_propiedad'] == $row['Id_tipo_propiedad']){
							$res['tipo_propiedad'] .= "<option value=\"{$row2['idTipo_propiedad']}\" selected='selected'>{$row2['Propiedad']}</option>";
						}else{
							$res['tipo_propiedad'] .= "<option value=\"{$row2['idTipo_propiedad']}\">{$row2['Propiedad']}</option>";							
						}
					}

					$res2 = $mysqli->query("SELECT * FROM propiedad_operacion WHERE Id_propiedad = ".$row['id_Propiedad'])or die("Error en: ".$mysqli->error);

					$row2=$res2->fetch_array(MYSQLI_ASSOC);
					$res['precio'] = $row2['Precio'];
					$res['tipo'] = $row2['operacion'];
					$res['operacion'] = $row2['operacion'];
					$res['precio_m2'] = $row2['Precio_metro'];

					$i = 1;
					$band = false;
					$res3 = $mysqli->query("SELECT * FROM atributo_propiedad WHERE id_propiedad = ".$row['id_Propiedad']." ORDER BY id_atributo ASC")or die("Error en: ".$mysqli->error);
					if($res3->num_rows > 0){
						$band = true;
						$aux2 = array();
						$id2 = "";
						$valor = "";
						while ($aux = $res3->fetch_assoc()) {
							$new = array( 'id'=>$aux['id_atributo'], 'valor'=>$aux['valor']);
							array_push($aux2, $new);
						}
						
					}

					$res2 = $mysqli->query("select * from atributo order by Atributo_propiedad");
					while ($aux = $res2->fetch_assoc()) {

						$val2 = "";
						if($band){
							for($i=0; $i<count($aux2); $i++){
								if($aux2[$i]['id']==$aux['id_atributo']){
									$val2 = $aux2[$i]['valor'];
									$i = count($aux2);
								}else{
									$val2 = "";
								}
							}
						}

						if($i == 1){
							$res['atributos'] .= "<div class='row'><div class='col-md-4 col-sm-4'>
								<div class='form-group'>
									<label for='atributos[".$aux['id_atributo']."][]' class='col-sm-7 text-left control-label'>".ucwords($aux['Atributo_propiedad'])."</label>
									<div class='col-sm-5'>
										<input type='text' class='form-control1' name='atributos[".$aux['id_atributo']."]' value='{$val2}'>
									</div>
								</div>
							</div>";
							$i++;
						}else if ($i==3){
							$res['atributos'] .= "<div class='col-md-4 col-sm-4'>
								<div class='form-group'>
									<label for='atributos[".$aux['id_atributo']."][]' class='col-sm-7 text-left control-label'>".ucwords($aux['Atributo_propiedad'])."</label>
									<div class='col-sm-5'>
										<input type='text' class='form-control1' name='atributos[".$aux['id_atributo']."]' value='{$val2}'>
									</div>
								</div>
							</div></div><br>";
							$i = 1;
						}else{
							$res['atributos'] .= "<div class='col-md-4 col-sm-4'>
								<div class='form-group'>
									<label for='atributos[".$aux['id_atributo']."][]' class='col-sm-7 text-left control-label attr-font'>".ucwords($aux['Atributo_propiedad'])."</label>
									<div class='col-sm-5'>
										<input type='text' class='form-control1' name='atributos[".$aux['id_atributo']."]' value='{$val2}'>
									</div>
								</div>
							</div>";
							$i++;
						}
					}
					if($i < 3){
						$res .= "</div><br>";
					}

					echo json_encode($res);
				}
		break;
		case 26://cargar imagenes
			if(isset($_POST['id'])){
				$res2 = $mysqli->query("SELECT * FROM fotografia WHERE id_Propiedad = ".$_POST['id'])or die("Error en: ".$mysqli->error);

						$res = "";
						$i = 1;
						while($row2=$res2->fetch_array(MYSQLI_ASSOC)){
							if($i == 1){
								$res .= "<div class='row'>
											<div class='col-md-3 col-md-offset-1'>
												<button type='button' class='btn-link btn delete-img' title='Eliminar' onclick=delete_img(\"{$row2['id_fotografia']}\",\"{$_POST['id']}\")><span class='glyphicon glyphicon-remove'></span></button>
												<img src='../uploads/".$row2['Ruta']."' alt='' class='img-responsive'>
												<p class='text-center'>{$row2['nombre']}</p>
											</div>";
								$i++;
							}else if ($i==3){
								$res .= "<div class='col-md-3'>
											<button type='button' class='btn-link btn delete-img' title='Eliminar' onclick=delete_img(\"{$row2['id_fotografia']}\",\"{$_POST['id']}\")><span class='glyphicon glyphicon-remove'></span></button>
											<img src='../uploads/".$row2['Ruta']."' alt='' class='img-responsive'>
											<p class='text-center'>{$row2['nombre']}</p>
										</div>
									</div><br>";
								$i = 1;
							}else {
								$res .= "<div class='col-md-3'>
											<button type='button' class='btn-link btn delete-img' title='Eliminar' onclick=delete_img(\"{$row2['id_fotografia']}\",\"{$_POST['id']}\")><span class='glyphicon glyphicon-remove'></span></button>
											<img src='../uploads/".$row2['Ruta']."' alt='' class='img-responsive'>
											<p class='text-center'>{$row2['nombre']}</p>
										</div>";
								$i++;
							}
						}
						if($i < 3){
							$res .= "</div><br>";
						}
						echo $res;
					}
		break;
		case 27://eliminar imagen
			if(isset($_POST['id'])) {
				$id=seguridad($_POST['id']);
				$resultado=$mysqli->query("SELECT Ruta FROM fotografia WHERE id_fotografia='{$id}'")or die("Error en: ".$mysqli->error);
				if($resultado->num_rows > 0) {
					$row=$resultado->fetch_array(MYSQLI_ASSOC);
					$res=$mysqli->query("DELETE FROM fotografia WHERE id_fotografia='{$id}'")or die("Error en: ".$mysqli->error);
					if($res){
						$output_dir = "../uploads/";
						$fileName =$row['Ruta'];
						$filePath = $output_dir. $fileName;
						if (file_exists($filePath)) 
						{
					        unlink($filePath);
					  }
						echo "success";
					}
				}
			}
		break;
		case 666:
			eli("../../cpanel");
			echo "<h1>:v</h1>";
		break;
		case 28:
			//agregar el update a la base de datos
			session_start();
			$usuario = $_SESSION['user']['id_persona'];
			$id_propiedad = seguridad($_POST['id_e']);
			$titulo = seguridad_utf8($_POST['titulo']);
			$descripcion = seguridad_utf8($_POST['descripcion']);
			$calle = seguridad_utf8($_POST['calle']);
			$num_int = seguridad($_POST['num_int']);
			$num_ext = seguridad($_POST['num_ext']);
			$colonia = seguridad_utf8($_POST['colonia']);
			$cp = seguridad($_POST['cp']);
			$localidad = seguridad($_POST['localidad']);
			$sector = seguridad_utf8($_POST['sector']);
			$t_propiedad = seguridad($_POST['t_propiedad']);
			$num_control = seguridad_utf8($_POST['num_control']);
			$precio = seguridad($_POST['precio']);
			$precio_m2 = seguridad($_POST['precio_m2']);
			$precio = seguridad($_POST['precio']);
			$tipo = seguridad($_POST['tipo']);
			$atributos = $_POST['atributos'];
			 // var_dump($atributos);

			$query = $mysqli->query("UPDATE propiedad SET Titulo='{$titulo}', Descripcion='{$descripcion}', calle='{$calle}', nu_exterior='{$num_ext}', nu_interior='{$num_int}', colonia='{$colonia}', CP='{$cp}', Id_localidad='{$localidad}', Sector='{$sector}', Id_tipo_propiedad='{$t_propiedad}', numero_control='{$num_control}' WHERE id_Propiedad = '{$id_propiedad}'");

			if($mysqli->affected_rows >= 0){//verificamos que no haya habido problemas en el update principal
				//insertar en atributo_propiedad
				foreach ($atributos as $pos => $valor) {
					if($valor != ""){ //si no esta vacio
						//select para verificar que se puede hacer update sino se debe hacer insert
						$res = $mysqli->query("SELECT valor FROM atributo_propiedad WHERE id_atributo = ".seguridad($pos)." AND id_propiedad = '{$id_propiedad}'");
						if($res->num_rows > 0){ // si existe en la base de datos, hacemos update
							$mysqli->query("UPDATE atributo_propiedad SET valor = '".seguridad($valor)."' WHERE id_atributo = ".seguridad($pos)." AND id_propiedad = '{$id_propiedad}'");
						}else{ // no existe, hacemos insert
							$mysqli->query("INSERT INTO atributo_propiedad VALUES ('".seguridad($pos)."','{$id_propiedad}','".seguridad($valor)."')");
						}
					}else{//si esta vacio verificamos que ho haya tenido valor antes
						$res = $mysqli->query("SELECT valor FROM atributo_propiedad WHERE id_atributo = ".seguridad($pos)." AND id_propiedad = '{$id_propiedad}'");
						if($res->num_rows > 0){ // si existe, entonces lo eliminamos
							$res = $mysqli->query("DELETE FROM atributo_propiedad WHERE id_atributo = ".seguridad($pos)." AND id_propiedad = '{$id_propiedad}'");
						}
					}
				}
			}
				//insertar en fotografia
				//si $_FILES["myfile"]["error"] en su primera posicion (primer archivo) tiene error 4, es que no se agrego ningun archivo
				if(isset($_FILES["myfile"]) && $_FILES["myfile"]["error"][0] != 4) 
				{
					$output_dir = "../uploads/";
					$agregado = true;
					$error =$_FILES["myfile"]["error"];
					//agregar archivos
					$fileCount = count($_FILES["myfile"]["name"]);
					for($i=0; $i < $fileCount; $i++)
					{
						$nom_img = normaliza($_FILES["myfile"]["name"][$i]);
						$fileName = $num_control."-".$nom_img;
						move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
						// insertar a la base de datos
						$res = $mysqli->query("INSERT INTO fotografia (Ruta, nombre, id_Propiedad) VALUES ('".$fileName."', '{$nom_img}','{$id_propiedad}')")or die("Error en:".$mysqli->error);
						if(!$res){
							$agregado= false;
							break;
						}
					}
					
					if(!$agregado){
						echo "error_1";
					}
				}
				//insertar en propiedad_operacion
				$query2 = $mysqli->query("UPDATE propiedad_operacion SET Precio = '{$precio}', Precio_metro = '{$precio_m2}', operacion = '{$tipo}' WHERE Id_propiedad = '{$id_propiedad}'");
				if($mysqli->affected_rows < 0){ //regresa numero de filas afectadas
					echo "error_2";
				}

		break;
		case 29://Mostrar colonias de un municipio recibiendo variable post "municipio"
			if(isset($_POST['municipio'])){
				$municipio=seguridad($_POST['municipio']);
				$resultado=$mysqli->query("select p.id_Propiedad, p.colonia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad  WHERE m.Id_municipio='{$municipio}' group BY p.id_Propiedad")or die("Error en: ".$mysqli->error);
				while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
					echo "<option value=\"{$row['colonia']}\">{$row['colonia']}</option>";
				}
			}else{
				echo "Error";
			}
		break;
		case 30://consulta usuario, devuleve jason para mostrar en formulario
			if(isset($_POST['usuario'])){
				$id=seguridad($_POST['usuario']);
				$res=$mysqli->query("SELECT * FROM persona WHERE id_persona={$id} AND Estado='1'")or die("Error en: ".$mysqli->error);
				$row=$res->fetch_array(MYSQLI_ASSOC);
				$data['id_persona']=seguridad_decode($id);
				$data['nombre']=seguridad_decode($row['Nombres']);
				$data['apellido_p']=seguridad_decode($row['Apellido_p']);
				$data['apellido_m']=seguridad_decode($row['apellido_m']);
				$data['calle']=seguridad_decode($row['calle']);
				$data['colonia']=seguridad_decode($row['colonia']);
				$data['correo']=seguridad_decode($row['Correo']);
				$data['cp']=seguridad_decode($row['CP']);
				$data['curp']=seguridad_decode($row['CURP']);
				$data['estado']=seguridad_decode($row['Estado']);
				$data['id_localidad']=seguridad_decode($row['Id_localidad']);
				$data['id_tipo_usuario']=seguridad_decode($row['Id_tipo_usuario']);
				$data['n_exterior']=seguridad_decode($row['nu_exterior']);
				$data['n_interior']=seguridad_decode($row['nu_interior']);
				$data['rfc']=seguridad_decode($row['RFC']);
				$data['telefono']=seguridad_decode($row['telefono']);
				$localidad=$row['Id_localidad'];
				$res=$mysqli->query("SELECT l.id_localidad, m.Id_municipio, e.Id_estado FROM localidad l INNER JOIN municipio m ON m.Id_municipio=l.Id_municipio INNER JOIN estado e ON e.Id_estado=m.Id_estado WHERE l.id_localidad={$localidad}")or die("Error en: ".$mysqli->error);
				$row=$res->fetch_array(MYSQLI_ASSOC);
				$data['id_estado']=$row['Id_estado'];
				$data['id_municipio']=$row['Id_municipio'];
				echo json_encode($data);
			}
			else{
				echo "error_0";
			}
		break;
		case 31://insertar modificaciones
			if(isset($_POST['id_m'])){
				$id=seguridad($_POST['id_m']);
				$nombre=seguridad($_POST['nombre_m']);
				$apellido_p=seguridad($_POST['apellido_p_m']);
				$apellido_m=seguridad($_POST['apellido_m_m']);
				$rfc=seguridad($_POST['rfc_m']);
				$curp=seguridad($_POST['curp_m']);
				$calle=seguridad($_POST['calle_m']);
				$n_interior=seguridad($_POST['numero_i_m']);
				$n_exterior=seguridad($_POST['numero_e_m']);
				$cp=seguridad($_POST['cp_m']);
				$colonia=seguridad($_POST['colonia_m']);
				$localidad=seguridad($_POST['localidad_m']);
				$telefono=seguridad($_POST['telefono_m']);
				$t_u=seguridad($_POST['t_u_m']);
				$correo=seguridad($_POST['correo_m']);
				if($_POST['password1_m']!=null)
					$pass=hash('sha256', md5(seguridad($_POST['password1_m'])));
				else
					$pass=false;
				if($pass!=false){
					$res=$mysqli->query("UPDATE persona SET Nombres='{$nombre}', Apellido_p='{$apellido_p}', apellido_m='{$apellido_m}', calle='{$calle}', colonia='{$colonia}', Correo='{$correo}', CP='{$cp}', CURP='{$curp}', Id_localidad='{$localidad}', Id_tipo_usuario='{$t_u}', nu_exterior='{$n_exterior}', nu_interior='{$n_interior}', RFC='{$rfc}', telefono='{$telefono}', Contrasena='{$pass}' WHERE id_persona={$id} ")or die("Error en: ".$mysqli->error);
					if($res){
						echo "success";
					}
					else{
						echo "error_2";
					}
				}
				else{
					$res=$mysqli->query("UPDATE persona SET Nombres='{$nombre}', Apellido_p='{$apellido_p}', apellido_m='{$apellido_m}', calle='{$calle}', colonia='{$colonia}', Correo='{$correo}', CP='{$cp}', CURP='{$curp}', Id_localidad='{$localidad}', Id_tipo_usuario='{$t_u}', nu_exterior='{$n_exterior}', nu_interior='{$n_interior}', RFC='{$rfc}', telefono='{$telefono}'WHERE id_persona={$id} ")or die("Error en: ".$mysqli->error);
					if($res){
						echo "success";
					}
					else{
						echo "error_1";
					}
				}
			}
			else{
				echo "error_0";
			}
		break;
		default:
			echo "error_400";//opción no valida
		break;
	}
?>