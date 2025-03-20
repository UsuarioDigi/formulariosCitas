/*Agegrar campo de identificación del complejo al que pertenece*/
/*valor cai:1, valor cahj: 2*/
/*Tabla form_datos_facturacion*/
alter table form_datos_facturacion
add column complejo_id integer; 

update form_datos_facturacion set complejo_id=1;

/*Tabla usuarios*/
alter table usuarios
add column complejo_id integer; 

update usuarios set complejo_id=1;

/*Tabla form_horarios*/
alter table form_horarios
add column complejo_id integer; 

update form_horarios set complejo_id=1;

/*Tabla form_tipo_visitante*/
alter table form_tipo_visitante
add column complejo_id integer; 

update form_tipo_visitante set complejo_id=1;