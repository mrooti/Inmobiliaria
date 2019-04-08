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
     $auxB = $res2->fetch_assoc();
     $titulo = $auxB['Titulo'];

     $res3 = $mysqli->query("select * from fotografia f inner join propiedad p on f.id_Propiedad=p.id_Propiedad where p.id_Propiedad='".$idprop."'");
     $res4 = $mysqli->query("select ap.valor, a.Atributo_propiedad from atributo a inner join atributo_propiedad ap 
        inner join propiedad p on p.id_Propiedad=ap.id_propiedad and ap.id_atributo=a.id_atributo 
        where p.id_Propiedad='".$idprop."'");
     $caracteristicas="";
     $caracteristicas2="";
    while ($aux = $res4->fetch_assoc()) {
        if($aux['valor'] == trim('*')) {
          $caracteristicas2 .= " ".$aux['valor']." ".$aux['Atributo_propiedad']." <br>";
        }else{
          $caracteristicas.=" ".$aux['valor']." ".$aux['Atributo_propiedad']." <br>";          
        }
    }
    $caracteristicas .= $caracteristicas2;
?>
<html lang="es">
    <head>
        <?php
        include("php/head.php");
        ?>
        <link href="css/index.css"  rel='stylesheet' type='text/css'>
        <link href="css/propiedad.css"  rel='stylesheet' type='text/css'>
    </head>
    <body class="bg-waves">
        <?php
        include("php/menupropiedades.php");
        ?>
        <div class="container cuerpo" id="propiedad">
            <div class="row">
                <div class="col-md-12 titulos"> 
                    <h1><?php echo ucwords($titulo); ?></h1>
                </div>
                <div class="col-md-5 col-sm-6 foto-album mb-30"> 
                    <div id="content">
                        <div  class="col-md-2 col-sm-2 col-xs-2 caption nopadding">
                            <div class="carrusel">
                                <?php
                                $i=0;
                                    while ($aux = $res3->fetch_assoc())
                                    {
                                        $i++;
                                        echo '
                                            <div id="imagen_'.$i.'" class="border-color">
                                                <img class="img_carrusel" src="cpanel/uploads/'.$aux['Ruta'].'" />
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-10 nopadding border-color">
                        <?php
                            while ($aux = $res1->fetch_assoc())
                            {
                                echo '<img id="bigimage" class="bigimage img-responsive" src="cpanel/uploads/'.$aux['Ruta'].'"/>';
                            }
                        ?>
                        </div>
                    </div>
                    
                </div>
                <div class="clearfix visible-xs"></div>
                <div class="col-md-7 col-sm-6 descripcion nopadding"> 
                    <div class="panel panel-default nomargin">
                      <?php 
                          echo '
                              <div class="panel-heading">
                                  <h3 class="panel-title text-center text-uppercase">detalles</h3>
                              </div>
                              <div class="panel-body nopadding">
                                  <div class="col-md-6 border-right mt-10">
                                  <p class="p-10 text-justify">'.str_replace("\r\n", "", stripcslashes($auxB['Descripcion'])).'</p>
                                  </div>                                    
                                  <div class="col-md-6 mt-10" >                                  
                                  <p class="text-left">'.$caracteristicas.'</p>
                                  </div>
                                  <div class="col-md-12">
                                  <hr>
                                  <h2 class="orange text-shadow">$ '.number_format($auxB['Precio'], 2, '.', ',').'</h2>
                                  </div>
                                  <div class="col-md-12">
                                  <hr>
                                  <a class="btn btn-success" href="#contacto_1">Contactar</a>
                                  <a class="btn btn-danger" href="javascript:history.go(-1);">Volver</a>
                                  </div>
                              </div><br>';
                          
                      ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php
            include("php/contacto.php");
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

            $("#form").submit(function(){
                var datos=$("#form").serialize();
                $.ajax({
                    url: "php/sendemail.php",
                    method: "POST",
                    data: datos
                }).done(function(data){
                    if(data=="success"){
                        $(".mensaje").show("slow");
                        setTimeout(function(){ $(".mensaje").hide("slow"); },3000);
                        $('#form')[0].reset();
                    }
                    else{
                        $(".error").show("slow");
                        setTimeout(function(){ $(".error").hide("slow"); },3000);
                    }
                });
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
 $("#form").submit(function(){
        var datos=$("#form").serialize();
        $.ajax({
            url: "php/sendemail.php",
            method: "POST",
            data: datos
        }).done(function(data){
            if(data=="success"){
                $(".mensaje").show("slow");
                setTimeout(function(){ $(".mensaje").hide("slow"); },3000);
                $('#form')[0].reset();
            }
            else{
                $(".error").show("slow");
                setTimeout(function(){ $(".error").hide("slow"); },3000);
            }
        });
        return false;
    });
    </script>
</html>