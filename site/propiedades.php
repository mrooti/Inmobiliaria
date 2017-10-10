<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
        include("php/head.php");
        include("cpanel/control/connection.php"); 
        include("cpanel/control/security.php"); 
                $precioinicio=0;
                $res20=$mysqli->query("select max(po.Precio) from propiedad p INNER JOIN propiedad_operacion po on p.id_Propiedad = po.Id_propiedad");
                    while ($aux = $res20->fetch_assoc()) {
                        $preciofin=$aux['max(po.Precio)'];
                    }

                if(isset($_GET['todas']))
                {
                    //precio minimo en 0 precio maximo selecciona el mayor de la bd
                    $preciodesde=$precioinicio;
                    $preciohasta=$preciofin;
                    $res2 = $mysqli->query("select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad where p.Aprobado='1' group by p.id_Propiedad ");
                    
                }
                else 
                {
                    if(isset($_GET['tipooperacion'])&&isset($_GET['tipoinmueble'])&&isset($_GET['estado'])&&isset($_GET['municipio'])&&isset($_GET['colonia']))
                    {    
                        $consulta="";  
                        if(isset($_GET['preciodesde'])&&isset($_GET['preciohasta']))
                        {
                            $preciodesde=seguridad($_GET['preciodesde']);
                            $preciohasta=seguridad($_GET['preciohasta']);
                        }
                        else
                        {
                            $preciodesde=0;
                            $res9=$mysqli->query("select max(po.Precio) from propiedad p INNER JOIN propiedad_operacion po on p.id_Propiedad = po.Id_propiedad ");
                            while ($aux = $res9->fetch_assoc()) {
                                $preciohasta=$aux['max(po.Precio)'];
                            }
                        }
                        //1.- consulta para solo tipo de operacion
                        if(($_GET['tipooperacion']!=0)&&($_GET['tipoinmueble']==0)&&($_GET['estado']==0)&&($_GET['municipio']==0)&&($_GET['colonia']=='0'))
                        {
                           $tipooperacion = seguridad($_GET['tipooperacion']);
                           $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_Propiedad from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad  WHERE po.operacion='".$tipooperacion."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //2.- consulta para solo tipo de inmueble
                        else if(($_GET['tipoinmueble']!=0)&&($_GET['tipooperacion']==0)&&($_GET['estado']==0)&&($_GET['municipio']==0)&&($_GET['colonia']=='0'))
                        {
                            $tipoinmueble = seguridad($_GET['tipoinmueble']);
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE p.Id_tipo_propiedad='".$tipoinmueble."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //3.- consulta para solo estado
                        else if(($_GET['estado']!=0)&&($_GET['tipooperacion']==0)&&($_GET['tipoinmueble']==0)&&($_GET['municipio']==0)&&($_GET['colonia']=='0'))
                        {
                            $estado = seguridad($_GET['estado']);
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE e.Id_estado='".$estado."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //4.- consulta para municipio y estado
                        else if(($_GET['estado']!=0)&&($_GET['municipio']!=0)&&($_GET['tipooperacion']==0)&&($_GET['tipoinmueble']==0)&&($_GET['colonia']=='0'))
                        {
                            $estado = seguridad($_GET['estado']);
                            $municipio = seguridad($_GET['municipio']);
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad ";
                        }
                        //5.- consulta para municipio estado y colonia
                        else if(($_GET['colonia']!='0')&&($_GET['estado']!=0)&&($_GET['municipio']!=0)&&($_GET['tipooperacion']==0)&&($_GET['tipoinmueble']==0))
                        {
                            $estado = seguridad($_GET['estado']);
                            $municipio = seguridad($_GET['municipio']);
                            $colonia = seguridad($_GET['colonia']); 
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' and p.colonia='".$colonia."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //6.- consulta para tipo de operacion y tipo de inmueble
                         else if(($_GET['tipooperacion']!=0)&&($_GET['tipoinmueble']!=0)&&($_GET['estado']==0)&&($_GET['municipio']==0)&&($_GET['colonia']=='0'))
                        {
                           $tipooperacion = seguridad($_GET['tipooperacion']);
                           $tipoinmueble = seguridad($_GET['tipoinmueble']);
                           $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.operacion='".$tipooperacion."' and p.Id_tipo_propiedad='".$tipoinmueble."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //7.- consulta para tipo de operacion y estado
                        else  if(($_GET['tipooperacion']!=0)&&($_GET['estado']!=0)&&($_GET['tipoinmueble']==0)&&($_GET['municipio']==0)&&($_GET['colonia']=='0'))
                        {
                           $tipooperacion = seguridad($_GET['tipooperacion']);
                           $estado = seguridad($_GET['estado']);
                           $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.operacion='".$tipooperacion."' AND e.Id_estado='".$estado."'  AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //8.- consulta para tipo de operacion y municipio
                        else if(($_GET['tipooperacion']!=0)&&($_GET['municipio']!=0)&&($_GET['estado']!=0)&&($_GET['tipoinmueble']==0)&&($_GET['colonia']=='0'))
                        {
                           $tipooperacion = seguridad($_GET['tipooperacion']);
                           $estado = seguridad($_GET['estado']);
                           $municipio = seguridad($_GET['municipio']);
                           $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.operacion='".$tipooperacion."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //9.- consulta para tipo de operacion y colonia
                         else if(($_GET['tipooperacion']!=0)&&($_GET['municipio']!=0)&&($_GET['estado']!=0)&&($_GET['colonia']!='0')&&($_GET['tipoinmueble']==0))
                        {
                           $tipooperacion = seguridad($_GET['tipooperacion']);
                           $colonia = seguridad($_GET['colonia']);
                           $estado = seguridad($_GET['estado']);
                            $municipio = seguridad($_GET['municipio']);
                           $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.operacion='".$tipooperacion."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND p.colonia='".$colonia."' po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //10.- consulta para tipo de inmueble y estado
                        else if(($_GET['tipoinmueble']!=0)&&($_GET['estado']!=0)&&($_GET['tipooperacion']==0)&&($_GET['municipio']==0)&&($_GET['colonia']=='0'))
                        {
                            $tipoinmueble = seguridad($_GET['tipoinmueble']);
                            $estado = seguridad($_GET['estado']);
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //11.- consulta para tipo de inmueble y municipio
                         else if(($_GET['tipoinmueble']!=0)&&($_GET['municipio']!=0)&&($_GET['estado']!=0)&&($_GET['tipooperacion']==0)&&($_GET['colonia']=='0'))
                        {
                            $tipoinmueble = seguridad($_GET['tipoinmueble']);
                            $estado = seguridad($_GET['estado']);
                            $municipio = seguridad($_GET['municipio']);
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //12.- consulta para tipo de inmueble y colonia
                        else if(($_GET['tipoinmueble']!=0)&&($_GET['colonia']!='0')&&($_GET['municipio']!=0)&&($_GET['estado']!=0)&&($_GET['tipooperacion']==0))
                        {
                            $tipoinmueble = seguridad($_GET['tipoinmueble']);
                            $estado = seguridad($_GET['estado']);
                            $municipio = seguridad($_GET['municipio']);
                            $colonia = seguridad($_GET['colonia']);
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_fotografia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND p.colonia='".$colonia."'AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //13.- consulta para tipo de operacion ,tipo de inmueble y estado
                        else if(($_GET['tipooperacion']!=0)&&($_GET['tipoinmueble']!=0)&&($_GET['estado']!=0)&&($_GET['municipio']==0)&&($_GET['colonia']=='0'))
                        {
                            $tipooperacion = seguridad($_GET['tipooperacion']);
                            $tipoinmueble = seguridad($_GET['tipoinmueble']);
                            $estado = seguridad($_GET['estado']);
                           $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_Propiedad from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.operacion='".$tipooperacion."'AND p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        //14.- consulta para tipo de operacion ,tipo de inmueble y municipio
                        else if(($_GET['tipooperacion']!=0)&&($_GET['tipoinmueble']!=0)&&($_GET['municipio']!=0)&&($_GET['estado']!=0)&&($_GET['colonia']=='0'))
                        {
                           $tipooperacion = seguridad($_GET['tipooperacion']);
                            $tipoinmueble = seguridad($_GET['tipoinmueble']);
                            $estado = seguridad($_GET['estado']);
                            $municipio = seguridad($_GET['municipio']);
                           $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_Propiedad from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.operacion='".$tipooperacion."'AND p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";

                        }
                        //15.- consulta para tipo de operacion ,tipo de inmueble y colonia
                        else if(($_GET['tipooperacion']!=0)&&($_GET['tipoinmueble']!=0)&&($_GET['municipio']!=0)&&($_GET['estado']!=0)&&($_GET['colonia']!='0'))
                        {
                           $tipooperacion = seguridad($_GET['tipooperacion']);
                            $tipoinmueble = seguridad($_GET['tipoinmueble']);
                            $estado = seguridad($_GET['estado']);
                            $municipio = seguridad($_GET['municipio']);
                            $colonia = seguridad($_GET['colonia']);
                            $consulta="select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, f.id_Propiedad from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.operacion='".$tipooperacion."'AND p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND p.colonia='".$colonia."' AND po.Precio>='".$preciodesde."' AND po.Precio<='".$preciohasta."' group BY p.id_Propiedad";
                        }
                        $res2 = $mysqli->query($consulta);
                    }
                }
        /*
            if(isset($_GET['todas']))
            {
                $preciodesde=0;
                $preciohasta=0;
                $res2 = $mysqli->query("select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, min(f.id_fotografia) from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad");
            }
            else if(isset($_GET['tipooperacion'])&&isset($_GET['tipoinmueble'])&&isset($_GET['estado'])&&isset($_GET['municipio'])&&isset($_GET['localidad']))
                {
                    $tipooperacion = seguridad($_GET['tipooperacion']);
                    $tipoinmueble = seguridad($_GET['tipoinmueble']);
                    $estado = seguridad($_GET['estado']); 
                    $municipio = seguridad($_GET['municipio']);
                    $localidad = seguridad($_GET['localidad']);   

                    if(isset($_GET['preciodesde'])&&isset($_GET['preciohasta']))
                    {
                        $preciodesde=seguridad($_GET['preciodesde']);
                        $preciohasta=seguridad($_GET['preciohasta']);
                        $res2 = $mysqli->query("select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, min(f.id_fotografia) from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.Id_tipo_operacion='".$tipooperacion."' AND p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND l.id_localidad='".$localidad."' AND po.Precio>'".$preciodesde."' AND po.Precio<'".$preciohasta."'");
                    }
                    else
                    {
                        $preciodesde=0;
                        $preciohasta=0;
                        $res2 = $mysqli->query("select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, po.Precio, min(f.id_fotografia) from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad WHERE po.Id_tipo_operacion='".$tipooperacion."' AND p.Id_tipo_propiedad='".$tipoinmueble."' AND e.Id_estado='".$estado."' AND m.Id_municipio='".$municipio."' AND l.id_localidad='".$localidad."'");
                    }
                }
                */

        ?>

            

        <link href="css/index.css"  rel='stylesheet' type='text/css'>
        <link href="css/propiedades.css"  rel='stylesheet' type='text/css'>
    </head>
    <body class="bg-waves">
        <?php
        include("php/menupropiedades.php");
        ?>
        <div class="container-fluid" id="propiedades">
            <div class="row">
                <div class="col-md-3 col-sm-3 nopadding">
                    <div class=" logoprop col-sm-3 col-md-3 pdtop30">
                        <form id="busqueda" action="propiedades.php" method="get" >
                    
                            <div class="col-sm-12 col-md-12 elementmenuprop">
                                <label for="">Tipo de Operación:</label>
                                <select name="tipooperacion" id="tipooperacion" class="form-control inputcolor" >
                                  <?php
                                    if($tipooperacion==1)
                                    {
                                        echo '
                                        <option value ="0">Tipo de operacion</option>
                                        <option value="1" selected>Venta</option>
                                        <option value="2">Renta</option>
                                        ';
                                    }
                                    else
                                    {
                                        echo '
                                        <option value ="0">Tipo de operacion</option>
                                        <option value="1">Venta</option>
                                        <option value="2" selected>Renta</option>
                                        ';
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 elementmenuprop">
                                <label for="">Tipo de Inmueble:</label>
                                <select name="tipoinmueble" id="tipoinmueble" class="form-control inputcolor" >
                                  <?php
                                    $i=0;
                                    $res = $mysqli->query("select * from tipo_propiedad");
                                    echo "<option value='0'>Tipo de Inmueble</option>";
                                        while ($aux = $res->fetch_assoc()) {
                                            $i++;
                                            if($tipoinmueble==$i)
                                            {
                                                echo "<option value=".$aux['idTipo_propiedad']." selected>".$aux['Propiedad']."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value=".$aux['idTipo_propiedad'].">".$aux['Propiedad']."</option>";
                                            }
                                        }
                                  ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 elementmenuprop">
                                <label for="">Estado:</label>
                                <select class="form-control inputcolor" id="estado" name="estado" >
                                  <?php
                                    $i=0;
                                    $res = $mysqli->query("select * from estado");
                                    echo "<option value='0'>Estado</option>";
                                        while ($aux = $res->fetch_assoc()) {
                                            $i++;
                                            if($estado==$i)
                                            {
                                                echo "<option value=".$aux['Id_estado']." selected>".$aux['Estado']."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value=".$aux['Id_estado'].">".$aux['Estado']."</option>";
                                            }
                                        }
                                  ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 elementmenuprop">
                                <label for="">Municipio:</label>
                                <select class="form-control inputcolor" id="municipio" name="municipio" >
                                    <?php
                                        $i=0;
                                        $res = $mysqli->query("select * from municipio where Id_estado='".$estado."'");
                                        echo "<option value='0'>Municipio</option>";
                                            while ($aux = $res->fetch_assoc()) {
                                                $i++;
                                                if($municipio==$i)
                                                {
                                                    echo "<option value=".$aux['Id_municipio']." selected>".$aux['Municipio']."</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value=".$aux['Id_municipio'].">".$aux['Municipio']."</option>";
                                                }
                                            }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 elementmenuprop">
                                <label for="">Colonia:</label>
                                <select class="form-control inputcolor" id="colonia" name="colonia" >
                                  <?php
                                        $i=0;
                                        $res = $mysqli->query("select p.id_Propiedad, p.colonia from estado e INNER JOIN municipio m INNER JOIN localidad l INNER JOIN propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON e.Id_estado=m.Id_estado AND m.Id_municipio=l.Id_municipio AND l.id_localidad=p.Id_localidad and p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad  WHERE m.Id_municipio='{$municipio}' group BY p.id_Propiedad");
                                        echo "<option value='0'>Colonia</option>";
                                            while ($aux = $res->fetch_assoc()) {
                                                $i++;
                                                if($localidad==$i)
                                                {
                                                    echo "<option value=".$aux['colonia']." selected>".$aux['colonia']."</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value=".$aux['colonia'].">".$aux['colonia']."</option>";
                                                }
                                            }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 elementmenuprop">
                                <label for="">Seleccione un rango de precio:</label>
                                <br>
                                <input type="text" class="form-control" id="example_id" name="example_name" value="" />
                                <?php 
                                echo '<input type="number" class="form-control" id="preciodesde" name="preciodesde" value="'.$preciodesde.'" hidden/>';
                                echo '<input type="number" class="form-control" id="preciohasta" name="preciohasta" value="'.$preciohasta.'" hidden/>';
                                ?>
                            </div>
                            <div class="col-sm-12 col-md-12 elementmenuprop">
                                <button class="btn btn-default form-control inputcolor" type="submit">BUSCAR</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-9 col-md-9 descripcion"> 
                    <div class="titulos"> 
                        <h1 class="mleft30">Resultados de la búsqueda</h1>
                    </div>
                    <?php
                         while ($aux = $res2->fetch_assoc()) {
                            if($aux['id_Propiedad']!=NULL)
                            {
                    ?>
                            <div class="col-sm-5 col-md-4">
                                <div class="thumbnail tarjetacasa">
                                    <div class="tarjetaimagen">
                                    <?php
                                        echo'
                                            <img src="cpanel/uploads/'.$aux['Ruta'].'" class="img-responsive" alt="...">
                                        ';
                                    ?>
                                    </div>
                                    
                                    <div class="caption tarjetainformacion">
                                        <form id="identificadorpropiedad" action="propiedad.php" method="get">
                                            <?php
                                                $descri=substr($aux['Descripcion'], 0, 60);

                                                echo "<h5><b>".ucwords($aux['Titulo'])."</b></h5>
                                                    <p class='mtop15'>Precio: $ <b class='txt-orange font16'>".number_format($aux['Precio'], 2, '.', ',')."</b></p>
                                                    <p class='mtop15'>
                                                    ".$descri."...
                                                    </p>
                                                    <input name='idprop' id='idprop' type='text' value=".$aux['id_Propiedad'].">
                                                ";
                                            ?>
                                            <button href="#" class="btn vermas mtop15 pull-right" type="submit">Ver más...</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                            }
                            else
                            {
                                echo '<h3>No se encontraron resultados</h3>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
        include("php/foot.php");
        ?>
    </body>
    <script>
        $(document).ready(function(){
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({
                    scrollTop:$(this.hash).offset().top
                -50},800);
            });
        });

        $('#estado').change(function(){
        //limpiar el select para municipio y loclaidad
        $('#municipio').html("<option value='0'>Municipio</option>");
        $('#colonia').html("<option value='0'>Colonia</option>");
        $('#colonia, #colonia').val();
        $.ajax({
            url: "../cpanel/ajax/ajax.php?opcion=9",
            type: "POST",
            data: "estado=" + $('#estado').val(),
            success: function(data){
                var datos="<option value='0'>Municipio</option>" + data;
                $('#municipio').attr("disabled", false);
                $('#municipio').html(datos);
            },
            error: function(data){
                alert(data);
            }
        });

    });

    //Cargar el select con las localidades despues de seleccionar una opcion de municipio
    $('#municipio').change(function(){
        $('#colonia').html("<option value='0'>Colonia</option>");
        $.ajax({
            url: "../cpanel/ajax/ajax.php?opcion=29",
            type: "POST",
            data: "municipio=" + $('#municipio').val(),
            success: function(data){
                var datos="<option value='0'>Colonia</option>" + data;
                $('#colonia').attr("disabled", false);
                $('#colonia').html(datos);
            },
            error: function(data){
                alert(data);
            }
        });
    });
    </script>
    <script>
        var inicio= "<?php echo $precioinicio; ?>" ;
        var fin= "<?php echo $preciofin; ?>" ;
        var desde= "<?php echo $preciodesde; ?>" ;
        var hasta= "<?php echo $preciohasta; ?>" ;
        $("#example_id").ionRangeSlider({
            type: "double",
            min: inicio,
            max: fin,
            from: desde,
            to: hasta,
            step: 50000,
            grid: true,
            grid_snap: false
        });
        $("#example_id").on("change", function () {
            $("#preciodesde").val($(this).data("from"));
            $("#preciohasta").val($(this).data("to"));
        });
    </script>
</html>