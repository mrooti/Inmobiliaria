
/*PROCEDURES TIPO PROPIEDAD*/
/* insert tipo propiedad*/ 
delimiter |
create procedure inserttp(dato char(255))
begin 
declare c integer;
select * from tipo_propiedad where dato = Propiedad;
set c:=(select found_rows());
if c = 0 then 
START TRANSACTION;
insert into tipo_propiedad(idTipo_propiedad,Propiedad) values(null,dato);
commit;
else 
SELECT 'valor duplicado';
end if;
 END |
delimiter ; 


/*update tipo propiedad*/
delimiter |
create procedure updatetp(nuevodato char(255),id int)
begin 
declare c integer;
set c :=(select count(Propiedad) from tipo_propiedad where idTipo_propiedad = id);
if  c=1 then
	set c :=(select count(Propiedad) from tipo_propiedad where Propiedad=nuevodato);
	if  c=0 then
START TRANSACTION;
	update tipo_propiedad set Propiedad=nuevodato where idTipo_propiedad=id;
commit;
	else 
	select 'dato ya existente';
end if ;
else
select 'id inexistente';
end if ;
 END |
delimiter ; 

/*delete tipo usuarios*/
delimiter |
create procedure deletetp(id int)
begin 
declare c integer;
set c:=(select count(idTipo_propiedad) from tipo_propiedad where idTipo_propiedad=id);
if c = 1 then 
START TRANSACTION;
delete from tipo_propiedad where idTipo_propiedad=id;
commit;
else 
SELECT 'id inexistente';
end if;
 END |
delimiter ; 



/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7*/


/*PROCEDURES ATRIBUTO*/

/* insert atributo*/ 
delimiter |
create procedure insertattr(dato char(255))
begin 
declare c integer;
select * from atributo where dato = Atributo_propiedad;
set c:=(select found_rows());
if c = 0 then 
START TRANSACTION;
insert into atributo(id_atributo,Atributo_propiedad) values(null,dato);
commit;
else 
SELECT 'valor duplicado';
end if;
 END |
delimiter ; 


/*update atributo*/
delimiter |
create procedure updateattr(nuevodato char(255),id int)
begin 
declare c integer;
set c :=(select count(Atributo_propiedad) from atributo where id_atributo = id);
if  c=1 then
	set c :=(select count(Atributo_propiedad) from atributo where Atributo_propiedad=nuevodato);
	if  c=0 then
START TRANSACTION;
	update atributo set Atributo_propiedad=nuevodato where id_atributo=id;
commit;
	else 
	select 'dato ya existente';
end if ;
else
select 'id inexistente';
end if ;
 END |
delimiter ; 

/*delete atributo*/
delimiter |
create procedure deleteattr(id int)
begin 
declare c integer;
set c:=(select count(id_atributo) from atributo where id_atributo=id);
if c = 1 then 
START TRANSACTION;
delete from atributo where id_atributo=id;
commit;
else 
SELECT 'id inexistente';
end if;
 END |
delimiter ; 


/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7*/
/*PROCEDURES PERSONA*/

/*delete persona*/
delimiter |
create procedure deleteper(id int)
begin 
declare c integer;
set c:=(select count(id_persona) from persona where id_persona=id);
if c = 1 then 
START TRANSACTION;
update persona set Estado=0 where id_persona=id;
COMMIT;
else 
SELECT 'id inexistente';
end if;
 END |
delimiter ;


/* insert persona*/ 
delimiter |
create procedure insertper(nom varchar(30),apaterno varchar(30),amaterno varchar(30), col varchar(64), klle varchar(64), interior varchar(64), exterior varchar(64),localidad int(11),codpos varchar(10), email varchar(30), tel varchar(30),cur varchar(20),rf varchar(20) , contra varchar(128), tipousuario int(11))
begin 
declare e integer;
    set e :=(select count(*) from persona where email=Correo);
	 if e = 0 then
START TRANSACTION;
	insert into persona(Nombres,Apellido_p,apellido_m,RFC,CURP,calle,nu_exterior,nu_interior,colonia,CP,Id_localidad,telefono,Id_tipo_usuario,Correo,Contrasena,estado) values(nom,apaterno,amaterno,cur,rf,klle,exterior,interior,col,codpos,localidad,tel,tipousuario,email,contra,1);
commit;
      else 
      select'correo duplicado';
	  end if;
 END |
delimiter ; 


/*update persona*/
delimiter |
create procedure updateper(id int(11),nom varchar(30),apaterno varchar(30),amaterno varchar(30), col varchar(64), klle varchar(64), interior varchar(64), exterior varchar(64),localidad int(11),codpos varchar(10), email varchar(30), tel varchar(30),cur varchar(20),rf varchar(20) , contra varchar(128), tipousuario int(11))
begin 
declare c integer;
	set c:=(select count(*) from persona where id=id_persona);
	if c=1 then
		update persona set nombres=nom, Apellido_p=apaterno, apellido_m=amaterno, RFC=rf, CURP=cur, calle=Klle, nu_interior=interior, nu_exterior=exterior, colonia=col, CP=codpos, Id_localidad=localidad, telefono=tel, Id_tipo_usuario=tipousuario, Correo=email, Contrasena=contra, estado=1 where id=id_persona;
	else
	select 'no exite esa persona';
end if;
 END |
delimiter ; 



/*////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7*/