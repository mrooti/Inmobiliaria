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
			//codigo para con sulta
			$resultado=$mysqli->query("SELECT id_persona, Nombres, Apellido_p, apellido_m, RFC FROM persona WHERE Estado='1'");
			while($row=$resultado->fetch_array(MYSQLI_ASSOC)){
				echo "<tr>
						<td>{$row['id_persona']}</td>
						<td>{$row['Nombres']}</td>
						<td>{$row['Apellido_p']}</td>
						<td>{$row['apellido_m']}</td>
						<td>{$row['RFC']}</td>
						<td><button type='button' class='btn-danger btn' onclick=baja(\"{$row['id_persona']}\")><span class='glyphicon glyphicon-remove'></span></button></td>
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
		default:
			echo "error_400";//opción no valida
		break;
	}
?>