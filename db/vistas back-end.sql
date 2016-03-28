/* view tipo propiedad */
create view selectattr as select * from atributo;

/* view tipo propiedad */
create view selecttp as select * from tipo_propiedad;

/*notificaciones*/
create view notificacion as select * from contacto where Estado='0';

/*view usuarios*/
create view selectper as select * from persona where Estado=1;