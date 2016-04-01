/* view para propiedades_precios_tipo*/
create view prop_tipo_precio as select p.id_Propiedad Titulo, Descripcion, calle, nu_exterior, nu_interior,colonia,CP,sector,numero_control,Precio,Precio_metro, operacion, tp.Propiedad from propiedad p inner join propiedad_operacion po on p.id_Propiedad = po.Id_propiedad inner join tipo_propiedad tp on tp.idTipo_propiedad = p.Id_tipo_propiedad;

/*view para propiedades y fotografias*/
create view prop_foto as select p.id_Propiedad, Ruta from propiedad p inner join fotografia f on p.id_Propiedad = f.id_Propiedad;

/*view para propiedades y atributos*/
create view prop_atrib as select p.id_Propiedad, valor from propiedad p inner join atributo_propiedad ap on p.id_Propiedad = ap.id_propiedad;
