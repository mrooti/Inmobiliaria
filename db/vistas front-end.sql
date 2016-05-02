/* view para propiedades_precios_tipo*/
create view prop_tipo_precio as select p.id_Propiedad Titulo, Descripcion, calle, nu_exterior, nu_interior,colonia,CP,sector,numero_control,Precio,Precio_metro, operacion, tp.Propiedad from propiedad p inner join propiedad_operacion po on p.id_Propiedad = po.Id_propiedad inner join tipo_propiedad tp on tp.idTipo_propiedad = p.Id_tipo_propiedad;

/*view para propiedades y fotografias*/
create view prop_foto as select p.id_Propiedad, Ruta from propiedad p inner join fotografia f on p.id_Propiedad = f.id_Propiedad;

/*view para propiedades y atributos*/
create view prop_atrib as select p.id_Propiedad, valor, Atributo_propiedad from propiedad p inner join atributo_propiedad ap on p.id_Propiedad = ap.id_propiedad inner join atributo a on ap.id_atributo = a.id_atributo

/*vista para mostrar las localidades con sus respectivos municipios y estados en una tabla*/
create view localidades as select id_localidad,Localidad, Municipio, Estado from localidad l inner join municipio m on l.Id_municipio=m.Id_municipio inner join estado e on m.Id_estado=e.Id_estado

/*vista del indexi hace referencia a la vista de las localidades*/
create view principal as select p.id_Propiedad,operacion as movimiento,l.estado,l.municipio,l.localidad  from propiedad p inner join propiedad_operacion po on p.Id_propiedad=po.id_Propiedad inner join localidades l on p.Id_Localidad= l.id_localidad
