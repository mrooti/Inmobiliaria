<div class="container-fluid cuerpo2" id="cuerpo">
    <!--slide-->
    <div class="row slide" id="slide">
        <div class="master-slider ms-skin-default" id="masterslider"> 

          <!-- slide 1 -->
          <div class="ms-slide slide-1" data-delay="9"> <img src="js/masterslider/blank.html" data-src="<?php echo $source[1]['img']; ?>" alt=""/> 

            <div class="ms-layer col-md-3 col-sm-3 col-xs-3"
              style="right: 120px;top: 240px;height: 300px; background: rgba(242, 89, 0, 0.5);"
              data-type="text"
              data-delay="300"
              data-ease="easeOutExpo"
              data-duration="1200"
              data-effect="scale(1.5,1.6)"></div> 

            <h3 class="ms-layer txt-white col-md-3 col-sm-3 col-xs-3 text-center"
            style="right: 120px;top: 280px;padding: 0 15px;box-sizing: border-box;text-shadow: 1px 1px 2px #FFDC00;"
            data-type="text"
            data-delay="500"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="top(45)"> <?php echo ucwords($source[1]['titulo']); ?> </h3>

            <p class="ms-layer col-md-3 col-sm-3 col-xs-3 text-center txt-gray"
            style="right: 120px;top: 380px;padding: 0 15px;box-sizing: border-box;"
            data-type="text"
            data-delay="600"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="right(250)"> <?php echo substr($source[1]['descripcion'], 0, 130); ?>... </p>

            <a href="propiedad.php?idprop=<?php echo $source[1]['id']; ?>" class="ms-layer btn btn-info"
            style="right: 250px; top: 470px; padding: 6px 12px;"
            data-type="text"
            data-delay="1000"
            data-ease="easeOutExpo"
            data-duration="1200"
            data-effect="scale(1.5,1.6)"> ¡Ver más! </a> 

          </div>
          <!-- end slide 1 --> 

          <!-- slide 2 -->
          <div class="ms-slide slide-1" data-delay="9"> <img src="js/masterslider/blank.html" data-src="<?php echo $source[2]['img']; ?>" alt=""/> 

             <div class="ms-layer col-md-3 col-sm-3 col-xs-3"
              style="right: 120px;top: 240px;height: 300px; background: rgba(242, 89, 0, 0.5);"
              data-type="text"
              data-delay="300"
              data-ease="easeOutExpo"
              data-duration="1200"
              data-effect="scale(1.5,1.6)"></div> 

            <h3 class="ms-layer txt-white col-md-3 col-sm-3 col-xs-3 text-center"
            style="right: 120px;top: 280px;padding: 0 15px;box-sizing: border-box;text-shadow: 1px 1px 2px #FFDC00;"
            data-type="text"
            data-delay="500"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="bottom(45)"> <?php echo ucwords($source[2]['titulo']); ?> </h3>

            <p class="ms-layer col-md-3 col-sm-3 col-xs-3 text-center txt-gray"
            style="right: 120px;top: 380px;padding: 0 15px;box-sizing: border-box;"
            data-type="text"
            data-delay="600"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="left(250)"> <?php echo substr($source[2]['descripcion'], 0, 130); ?>... </p>

            <a href="propiedad.php?idprop=<?php echo $source[2]['id']; ?>" class="ms-layer btn btn-info"
            style="right: 250px; top: 470px; padding: 6px 12px;"
            data-type="text"
            data-delay="1000"
            data-ease="easeOutExpo"
            data-duration="1200"
            data-effect="scale(1.5,1.6)"> ¡Ver más! </a> 

          </div>
          <!-- end slide 2 --> 

          <!-- slide 3 -->
          <div class="ms-slide slide-1" data-delay="9"> <img src="js/masterslider/blank.html" data-src="<?php echo $source[3]['img']; ?>" alt=""/> 

              <div class="ms-layer col-md-3 col-sm-3 col-xs-3"
              style="right: 120px;top: 240px;height: 300px; background: rgba(242, 89, 0, 0.5);"
              data-type="text"
              data-delay="300"
              data-ease="easeOutExpo"
              data-duration="1200"
              data-effect="scale(1.5,1.6)"></div> 

            <h3 class="ms-layer txt-white col-md-3 col-sm-3 col-xs-3 text-center"
            style="right: 120px;top: 280px;padding: 0 15px;box-sizing: border-box;text-shadow: 1px 1px 2px #FFDC00;"
            data-type="text"
            data-delay="500"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="scale(1.5,1.6)"> <?php echo ucwords($source[3]['titulo']); ?> </h3>

            <p class="ms-layer col-md-3 col-sm-3 col-xs-3 text-center txt-gray"
            style="right: 120px;top: 380px;padding: 0 15px;box-sizing: border-box;"
            data-type="text"
            data-delay="600"
            data-ease="easeOutExpo"
            data-duration="1230"
            data-effect="scale(1.5,1.6)"> <?php echo substr($source[3]['descripcion'], 0, 130); ?>... </p>

            <a href="propiedad.php?idprop=<?php echo $source[3]['id']; ?>" class="ms-layer btn btn-info"
            style="right: 250px; top: 470px; padding: 6px 12px;"
            data-type="text"
            data-delay="1000"
            data-ease="easeOutExpo"
            data-duration="1200"
            data-effect="bottom(45)"> ¡Ver más! </a> 

          </div>
          <!-- end slide 3 -->

      </div>
  </div>
</div>
<!--contenido-->
<div class="row contenido-busqueda pdbottom15 pdtop30">
    <form id="buscar" action="propiedades.php" method="get">
        <div class="col-md-2 col-sm-6">
            <select name="tipooperacion" id="tipooperacion" class="form-control filtro-inicial">
                <option value='0'>Tipo de operacion</option>
                <option value='1'>Venta</option>
                <option value='2'>Renta</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-6">
            <select name="tipoinmueble" id="tipoinmueble" class="form-control filtro-inicial">
                <?php 
                $res = $mysqli->query("select * from tipo_propiedad");
                echo "<option value='0'>Tipo de Inmueble</option>";
                while ($aux = $res->fetch_assoc()) {
                    echo "<option value=".$aux['idTipo_propiedad'].">".$aux['Propiedad']."</option>";
                }

                ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-4">
            <select name="estado" id="estado" class="form-control filtro-inicial" size="1">
                <?php 
                $res = $mysqli->query("select * from estado");
                echo "<option value='0'>Estado</option>";
                while ($aux = $res->fetch_assoc()) {
                    echo "<option value=".$aux['Id_estado'].">".$aux['Estado']."</option>";
                }

                ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-4">
            <select name="municipio" id="municipio" class="form-control filtro-inicial"  size="1">
                <option value='0'>Municipio</option>
            </select>

        </div>
        <div class="col-md-2 col-sm-4">
            <select name="colonia" id="colonia" class="form-control filtro-inicial"  size="1">
                <option value='0'>Colonia</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-6 col-sm-offset-3">
            <input type="submit" value="Buscar" class="form-control btn btn-default btn-warning boton-index">
        </div>
    </form>
</div>

<div class="row contenido-busqueda pdtop15 pdbottom30">
    <form id="buscargeneral" action="propiedades.php" method="get">
        <input type="number" value="1" name="todas" style='display:none;'>
        <div class="col-md-12">
            <input type="submit" value="MOSTRAR TODAS LAS PROPIEDADES" class="form-control btn btn-default btn-warning boton-index-mas">
        </div>
    </form>
</div>
