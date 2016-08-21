<div class="container-fluid cuerpo2" id="cuerpo">
    <!--slide-->
    <div class="row slide" id="slide"></div>
</div>
<!--contenido-->
<div class="row contenido-busqueda pdbottom15 pdtop30">
    <form id="buscar" action="propiedades.php" method="get">
        <div class="col-md-2">
            <select name="tipooperacion" id="tipooperacion" class="form-control filtro-inicial">
                <option value='0'>Tipo de operacion</option>
                <option value='1'>Venta</option>
                <option value='2'>Renta</option>
            </select>
        </div>
        <div class="col-md-2">
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
        <div class="col-md-2">
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
        <div class="col-md-2">
            <select name="municipio" id="municipio" class="form-control filtro-inicial"  size="1">
                <option value='0'>Municipio</option>
            </select>

        </div>
        <div class="col-md-2">
            <select name="colonia" id="colonia" class="form-control filtro-inicial"  size="1">
                <option value='0'>Colonia</option>
            </select>
        </div>
        <div class="col-md-2">
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
