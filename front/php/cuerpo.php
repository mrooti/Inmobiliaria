<div class="container-fluid cuerpo2" id="cuerpo">
            <!--slide-->
            <div class="row slide" id="slide"></div>
            <!--contenido-->
            <div class="row" id="contenido">
                <form id="buscar" action="propiedades.php" method="get">
                    <div class="col-md-2">
                        <select name="tipooperacion" id="tipooperacion" class="form-control filtro-inicial">
                            <option value =''>Selecione una operacion</option>
                            <option value='1'>Venta</option>
                            <option value='2'>Renta</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="tipoinmueble" id="tipoinmueble" class="form-control filtro-inicial">
                            <?php 
                            $res = $mysqli->query("select * from tipo_propiedad");
                            echo "<option value=''>Tipo de Inmueble</option>";
                                while ($aux = $res->fetch_assoc()) {
                                    echo "<option value=".$aux['idTipo_propiedad'].">".$aux['Propiedad']."</option>";
                                }

                        ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="estado" id="estado" class="form-control filtro-inicial" size="1" required>
                        <?php 
                            $res = $mysqli->query("select * from estado");
                            echo "<option value=''>Seleccione un estado</option>";
                                while ($aux = $res->fetch_assoc()) {
                                    echo "<option value=".$aux['Id_estado'].">".$aux['Estado']."</option>";
                                }

                        ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="municipio" id="municipio" class="form-control filtro-inicial"  size="1" required></select>
                    </div>
                    <div class="col-md-2">
                        <select name="localidad" id="localidad" class="form-control filtro-inicial"  size="1" required></select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-default btn-warning boton-index">BUSCAR</button>
                    </div>
                    <!--
                    <div class="col-md-12">
                        <a href="propiedades.php" type="button" class="form-control btn btn-default btn-warning boton-index-mas">BUSQUEDA AVANZADA</a>
                    </div>
                    |-->
                </form>
            </div>
        </div>