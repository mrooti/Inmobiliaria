<!DOCTYPE html>
<?php 
    include("../cpanel/control/connection.php"); 
    include("../cpanel/control/security.php");
    if(isset($_GET['tipooperacion'])&&isset($_GET['tipoinmueble'])&&isset($_GET['estado'])&&isset($_GET['municipio'])&&isset($_GET['localidad']))
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
            $res2 = $mysqli->query("select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, min(f.id_fotografia) from propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad where p.Id_tipo_propiedad='".$tipoinmueble."' and p.Id_localidad='".$localidad."' and po.Id_tipo_operacion='".$tipooperacion."' and po.Precio>'".$preciodesde."' and po.Precio<'".$preciohasta."'");
        }
        else
        {
            $preciodesde=0;
            $preciohasta=0;
            $res2 = $mysqli->query("select p.id_Propiedad, p.Titulo, p.Descripcion, f.Ruta, min(f.id_fotografia) from propiedad p INNER JOIN propiedad_operacion po INNER JOIN fotografia f ON p.id_Propiedad = po.Id_propiedad and p.id_Propiedad=f.id_Propiedad where p.Id_tipo_propiedad='".$tipoinmueble."' and p.Id_localidad='".$localidad."' and po.Id_tipo_operacion='".$tipooperacion."'");
        }
    }

    
?>
<html lang="es">
    <head>
        <?php
        include("php/head.php");
        ?>
        <link href="css/index.css"  rel='stylesheet' type='text/css'>
        <link href="css/propiedades.css"  rel='stylesheet' type='text/css'>
    </head>
    <body>
        <?php
        include("php/menupropiedades.php");
        ?>
        <div class="container-fluid cuerpo" id="propiedades">
            <div class="row">
                <div class=" logoprop col-sm-5 col-md-3">
                    <form id="busqueda" action="propiedades.php" method="get">
                        <div class="col-sm-12 col-md-12">
                            <img src="./img/Logo.png" alt="">
                        </div>

                        <div class="col-sm-12 col-md-12 elementmenuprop">
                            <label for="">Tipo de Operación:</label>
                            <select name="tipooperacion" id="tipooperacion" class="form-control inputcolor">
                              <option>--Seleccione Operación--</option>
                              <?php
                                if($tipooperacion==1)
                                {
                                    echo '
                                    <option value ="">Selecione una operacion</option>
                                    <option value="1" selected>Venta</option>
                                    <option value="2">Renta</option>
                                    ';
                                }
                                else
                                {
                                    echo '
                                    <option value ="">Selecione una operacion</option>
                                    <option value="1">Venta</option>
                                    <option value="2" selected>Renta</option>
                                    ';
                                }
                              ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 elementmenuprop">
                            <label for="">Tipo de Inmueble:</label>
                            <select name="tipoinmueble" id="tipoinmueble" class="form-control inputcolor">
                              <option>--Seleccione Inmueble--</option>
                              <?php
                                $i=0;
                                $res = $mysqli->query("select * from tipo_propiedad");
                                echo "<option value=''>Tipo de Inmueble</option>";
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
                            <select class="form-control inputcolor" id="estado" name="estado">
                              <?php
                                $i=0;
                                $res = $mysqli->query("select * from estado");
                                echo "<option value=''>Estado</option>";
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
                            <select class="form-control inputcolor" id="municipio" name="municipio">
                                <?php
                                    $i=0;
                                    $res = $mysqli->query("select * from municipio where Id_estado='".$estado."'");
                                    echo "<option value=''>Municipio</option>";
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
                            <label for="">Localidad:</label>
                            <select class="form-control inputcolor" id="localidad" name="localidad">
                              <?php
                                    $i=0;
                                    $res = $mysqli->query("select * from localidad where Id_municipio='".$municipio."'");
                                    echo "<option value=''>Localidad</option>";
                                        while ($aux = $res->fetch_assoc()) {
                                            $i++;
                                            if($localidad==$i)
                                            {
                                                echo "<option value=".$aux['id_localidad']." selected>".$aux['Localidad']."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value=".$aux['id_localidad'].">".$aux['Localidad']."</option>";
                                            }
                                        }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 elementmenuprop">
                            <div class="col-sm-12 col-md-6">
                                <label for="">Precio desde:</label>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <?php
                                    echo '<input name="preciodesde" id="preciodesde" type="number" class="form-control inputcolor" size="2" value="'.$preciodesde.'">';
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 elementmenuprop">
                            <div class="col-sm-12 col-md-6">
                                <label for="">Hasta:</label>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <?php
                                    echo '<input name="preciohasta" id="preciohasta" type="number" class="form-control inputcolor" size="2" value="'.$preciohasta.'">';
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 elementmenuprop">
                            <button class="btn btn-default form-control inputcolor" type="submit">BUSCAR</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 col-md-offset-3 titulosprop"> 
                    <h1>Resultados de la búsqueda</h1>
                </div>
                <div class="col-sm-12 col-md-9  descripcion"> 
                    <?php
                         while ($aux = $res2->fetch_assoc()) {
                    ?>
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail tarjetacasa">
                                    <?php
                                        echo'
                                            <img src="'.$aux['Ruta'].'" alt="...">
                                        ';
                                    ?>
                                    <div class="caption tarjetainformacion">
                                        <form id="identificadorpropiedad" action="propiedad.php" method="get">
                                            <?php
                                                echo "<h4>".$aux['Titulo']."</h4>
                                                    <p>".$aux['Descripcion']."</p>
                                                    <input name='idprop' id='idprop' type='text' value=".$aux['id_Propiedad'].">
                                                ";
                                            ?>
                                            <p><button href="#" class="btn vermas" type="submit">Ver más...</a></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
        include("php/foot.php");
        ?>
    </body>
    <script src="js/jquery.backstretch.min.js"></script>
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
        $('#municipio, #localidad').attr("disabled", "disabled");
        $('#localidad, #localidad').val();
        $('#municipio, #localidad').html("");
        $.ajax({
            url: "../cpanel/ajax/ajax.php?opcion=9",
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
            url: "../cpanel/ajax/ajax.php?opcion=10",
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
    </script>
</html>