<!DOCTYPE html>
<?php 
    include("cpanel/control/connection.php"); 
    include("cpanel/control/security.php");
    if(isset($_GET['idprop']))
    {
        $idprop = seguridad($_GET['idprop']); 
    }
     $res1 = $mysqli->query("select min(f.id_fotografia), f.Ruta from propiedad p INNER JOIN fotografia f ON f.id_Propiedad=p.id_Propiedad where p.id_Propiedad='".$idprop."'");
     $res2 = $mysqli->query("select * from propiedad p INNER JOIN propiedad_operacion po ON p.id_Propiedad=po.Id_propiedad where p.id_Propiedad='".$idprop."'");
     $res3 = $mysqli->query("select * from fotografia f inner join propiedad p on f.id_Propiedad=p.id_Propiedad where p.id_Propiedad='".$idprop."'");
     $res4 = $mysqli->query("select ap.valor, a.Atributo_propiedad from atributo a inner join atributo_propiedad ap 
        inner join propiedad p on p.id_Propiedad=ap.id_propiedad and ap.id_atributo=a.id_atributo 
        where p.id_Propiedad='".$idprop."'");
     $caracteristicas="";
    while ($aux = $res4->fetch_assoc()) {
        $caracteristicas.="- ".$aux['valor']." ".$aux['Atributo_propiedad']." <br>";
    }
?>
<html lang="es">
    <head>
        <?php
        include("php/head.php");
        ?>
        <link href="css/index.css"  rel='stylesheet' type='text/css'>
        <link href="css/propiedad.css"  rel='stylesheet' type='text/css'>
    </head>
    <body>
        <?php
        include("php/menupropiedad.php");
        ?>
        <div class="container-fluid cuerpo" id="propiedad">
            <div class="row">
                <div class="col-md-8 col-md-offset-3 titulos"> 
                    <h1>Detalles de Inmueble</h1>
                </div>
                <div class="col-md-4 col-sm-5 foto-album"> 
                    <div id="content">
                        <?php
                            while ($aux = $res1->fetch_assoc())
                            {
                                echo '<img id="bigimage" class="bigimage" src="cpanel/uploads/'.$aux['Ruta'].'"/>';
                            }
                        ?>
                        <div id="carrusel" class="caption">
                            <div class="carrusel">
                                <?php
                                $i=0;
                                    while ($aux = $res3->fetch_assoc())
                                    {
                                        $i++;
                                        echo '
                                            <div id="imagen_'.$i.'">
                                                <img class="img_carrusel" src="cpanel/uploads/'.$aux['Ruta'].'" />
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 descripcion"> 
                    <div class="panel panel-default">
                        <?php 
                            while ($aux = $res2->fetch_assoc())
                            {
                                echo '
                                    <div class="panel-heading">
                                        <h3 class="panel-title">'.$aux['Titulo'].'</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4><i>'.$aux['Descripcion'].'</i></h4>
                                        <hr>
                                        <h4><i> Domicilio: </i></h4>
                                        <p> '.$aux['calle'].' Int. '.$aux['nu_interior'].' Ext. '.$aux['nu_exterior'].' Col. '.$aux['colonia'].' Sector '.$aux['Sector'].'</p>
                                        <h4><i> Características: </i></h4>
                                        <p>'.$caracteristicas.'</p>
                                        <hr>
                                        <h3> Precio: $'.$aux['Precio'].'</h3>
                                        <hr>
                                        <a class="btn btn-success" href="index.php#contacto_1">Contactar</a>
                                        <a class="btn btn-danger" href="javascript:history.go(-1);">Volver</a>
                                    </div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include("php/foot.php");
        ?>
    </body>
    <script src="js/jquery.backstretch.min.js"></script>
    <script>
         var posicion = 0;
         var imagenes = new Array();
         $(document).ready(function() {
           var numeroImatges = 4;
           if(numeroImatges<=3){
               $('.derecha_flecha').css('display','none');
            $('.izquierda_flecha').css('display','none');
           }

             $('.img_carrusel').on('click',function(){
                 $('#bigimage').attr('src',$(this).attr('src'));
                return false;
             });

             $('.izquierda_flecha').on('click',function(){
                 if(posicion>0){
                    posicion = posicion-1;
                }else{
                    posicion = numeroImatges-3;
                }
                $(".carrusel").animate({"left": -($('#imagen_'+posicion).position().left)}, 600);
                return false;
             });

             $('.izquierda_flecha').hover(function(){
                 $(this).css('opacity','0.5');
             },function(){
                 $(this).css('opacity','1');
             });

             $('.derecha_flecha').hover(function(){
                 $(this).css('opacity','0.5');
             },function(){
                 $(this).css('opacity','1');
             });

             $('.derecha_flecha').on('click',function(){
                if(numeroImatges>posicion+3){
                    posicion = posicion+1;
                }else{
                    posicion = 0;
                }
                $(".carrusel").animate({"left": -($('#imagen_'+posicion).position().left)}, 600);
                return false;
             });

         });
        </script>
    <script>
        $(document).ready(function(){
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({
                    scrollTop:$(this.hash).offset().top
                -50},800);
            });
        });
    </script>
</html>