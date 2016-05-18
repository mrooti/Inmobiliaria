<!DOCTYPE html>
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
    </script>
</html>