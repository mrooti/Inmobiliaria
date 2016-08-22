<!DOCTYPE html>
<?php 
include("cpanel/control/connection.php"); 
include("cpanel/control/security.php");
$res=$mysqli->query("SELECT p.Descripcion, p.id_Propiedad, p.titulo, f.ruta FROM `propiedad` p INNER JOIN fotografia f on f.id_Propiedad=p.id_Propiedad where destacada=1 group BY p.id_Propiedad DESC limit 3");
$i=1;
while ($aux = $res->fetch_assoc()) {
    $source[$i]['id']=$aux['id_Propiedad'];
    $source[$i]['img']="cpanel/uploads/".$aux['ruta'];
    $source[$i]['titulo']=$aux['titulo'];
    $source[$i]['descripcion']=$aux['Descripcion'];
    $i++;
}
?>
<html lang="es">
<head>
    <?php
    include("php/head.php");
    ?>
    <link href="css/index.css"  rel='stylesheet' type='text/css'>
</head>
<body>
    <?php
    include("php/menu.php");
    include("php/cuerpo.php");
    include("php/nosotros.php"); 
    include("php/preguntas-frecuentes.php");
    include("php/contacto.php");
    include("php/foot.php");

    ?>
</body>
<!-- <script src="js/jquery.backstretch.min.js"></script> -->
<script src="js/masterslider/masterslider.min.js"></script> 
<script type="text/javascript">
    (function($) {
     "use strict";
     var slider = new MasterSlider();
    // adds Arrows navigation control to the slider.
    slider.control('arrows');
    slider.control('bullets');
    
    slider.setup('masterslider' , {
         width:1400,    // slider standard width
         height:600,   // slider standard height
         space:0,
         speed:45,
         layout:'fillwidth',
         loop:true,
         preload:0,
         autoplay:true,
         view:"parallaxMask"
     });
})(jQuery);
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


        //Cargar el select con los municipios despues de seleccionar una opcion de estado
        $('#estado').change(function(){
        //limpiar el select para municipio y loclaidad
        $('#municipio').html("<option value='0'>Municipio</option>");
        $('#colonia').html("<option value='0'>Colonia</option>");
        $('#colonia, #colonia').val();
        $.ajax({
            url: "cpanel/ajax/ajax.php?opcion=9",
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
            url: "cpanel/ajax/ajax.php?opcion=29",
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