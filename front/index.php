<!DOCTYPE html>
<?php 
    include("../cpanel/control/connection.php"); 
    include("../cpanel/control/security.php");
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
        jQuery("#slide").backstretch([
          "img/slide1.jpg"
          , "img/slide2.jpg"
          , "img/slide3.jpg"
        ], {duration: 4000, fade: 1000});
        //Cargar el select con los municipios despues de seleccionar una opcion de estado
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