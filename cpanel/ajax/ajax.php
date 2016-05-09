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
		case 9:
		//agregar los municipios dependiendo del estado seleccionado
		$mun = "";
		$res = $mysqli->query("select * from municipio where Id_estado =".$_POST['estado']." order by Municipio Asc");
		$mun = "<option value=''>Seleccione un municipio</option>";
		while ($aux = $res->fetch_assoc()) {
			$mun.= "<option value=".$aux['Id_municipio'].">".$aux['Municipio']."</option>";
		}
		echo $mun;
		break;
		case 10:
		//agregar las localidades dependiendo del municipio seleccionado
		$mun = "";
		$res = $mysqli->query("select * from localidad where Id_municipio =".$_POST['municipio']." order by Localidad Asc");
		$mun = "<option value=''>Seleccione una localidad</option>";
		while ($aux = $res->fetch_assoc()) {
			$mun.= "<option value=".$aux['Id_localidad'].">".$aux['Localidad']."</option>";
		}
		echo $mun;
		break;
		default:
			echo "error_400";//opción no valida
		break;
	}
?>