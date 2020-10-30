/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de creacion de base de datos espacial 2020
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de base de datos simar*/
/*----------------------------------------------------------------------------*/
create database simar;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion path de almacenamiento de info*/
/*----------------------------------------------------------------------------*/

do $$ 
declare path text := '/mnt/c/wamp64/www/bde/SQL/';	
begin
raise notice '%',path;
end $$;


do $$ 
begin
raise notice '%',path;
end $$;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de tabla tiponave
/*----------------------------------------------------------------------------*/
create table tiponave(
 cod_tiponave int primary key,
 nom_tiponave char(100) not null,
 categoria_trb char(1) ,
 categoria_eslora char(1)
 );

/*Cargue*/
COPY tiponave(cod_tiponave, nom_tiponave,categoria_trb,categoria_eslora)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/tiponave.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de tabla nave
/*----------------------------------------------------------------------------*/

create table nave(
 omimatricu char(20) primary key,
 nombrenave char(40) not null,
 codigo_pais char(6) not null,
 id_agencia_arribo char(20) not null,
 codigotiponave int,
 anoconstru char(4),
 trb numeric,
 dwt numeric,
 eslora numeric
 );

/*Limpieza de los registros de la tabla naves*/
DELETE FROM nave; 

/*Actalización de llaves foráneas sobre la tabla naves*/
alter table nave add constraint codigotiponave FOREIGN KEY (codigotiponave) REFERENCES tiponave (cod_tiponave);
alter table nave add constraint codigo_pais FOREIGN KEY (codigo_pais) REFERENCES paises (codigo_pais);
alter table nave add constraint id_agencia_arribo FOREIGN KEY (id_agencia_arribo) REFERENCES agencianave (id_agencia_arribo);

/*Cargue*/
COPY nave(omimatricu, nombrenave,codigo_pais,id_agencia_arribo,codigotiponave,anoconstru,trb,dwt,eslora)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/nave.csv'
DELIMITER ';'
CSV HEADER;


/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de capa categoria parque nacional natural
/*----------------------------------------------------------------------------*/
create table categoria_pnn(
 id_categoria char(2) primary key,
 nom_categoria char(50) not null
 );
 
/*Cargue*/
COPY categoria_pnn(id_categoria, nom_categoria)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/categoria_pnn.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de capa parque nacional natural
/*----------------------------------------------------------------------------*/
create table pnn(
 id_pnn char(10) primary key,
 nom_parque char(100) not null,
 id_categoria char(2) references categoria_pnn
 );

/*Cargue*/
COPY pnn(id_pnn, nom_parque,id_categoria)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/pnn.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla agencianave
/*----------------------------------------------------------------------------*/
create table agencianave(
 id_agencia_arribo char(20) primary key,
 agencia_arribo char(100) not null 
 );


/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla nave_agencianave
/*----------------------------------------------------------------------------*/
drop table nave_agencianave;
create table nave_agencianave(
	id_agencia_arribo char(20),
	omimatricu char(20),
	foreign key (id_agencia_arribo) references agencianave (id_agencia_arribo),
	foreign key (omimatricu) references nave (omimatricu),
	primary key (id_agencia_arribo,omimatricu)
);


/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla paises
/*----------------------------------------------------------------------------*/
drop table paises; 
create table paises(
 abreviatura_pais char(3) primary key ,
 nombre char(50) not null,
 codigo_pais char(3) unique 
);


/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla capitanias
/*----------------------------------------------------------------------------*/

create table capitanias(
	id_capitania char(4) primary key,
	nom_capitania char(15) unique	
);


/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla puerto
/*----------------------------------------------------------------------------*/

create table puertos(
 id_puerto char(5),
 nom_puerto char(10) not null,
 id_capitania char(4),
 abreviatura_pais char(3),
 foreign key (id_capitania) references capitanias (id_capitania),
 foreign key (abreviatura_pais) references paises (abreviatura_pais),
 primary key (id_puerto)
);

/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla razon_arribos
/*----------------------------------------------------------------------------*/

create table razon_arribos(
	id_razon char(1) primary key,
	nom_razon char(25)
);



/*----------------------------------------------------------------------------*/



/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla arribos_naves_puertos
/*----------------------------------------------------------------------------*/

create table arribos_naves_puertos(
	pto_origen char(5), 
	pto_destino char(5),
	omimatricu char(20),
	id_razon char(1),
	fecha_arribos date,	
	foreign key (pto_origen) references puertos (id_puerto),
	foreign key (pto_destino) references puertos (id_puerto),
	foreign key (omimatricu) references nave (omimatricu),
	foreign key (id_razon) references razon_arribos (id_razon),
	primary key(pto_origen,pto_destino,omimatricu,fecha_arribos)
);


/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla linea de costa
/*----------------------------------------------------------------------------*/

create table linea_costa(
	id_linea int
);
alter table linea_costa add column id_capitania char(4);
alter table linea_costa add constraint id_capitania FOREIGN KEY (id_capitania) REFERENCES capitanias (id_capitania);

/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla instalación portuaria
/*----------------------------------------------------------------------------*/

create table instalacion_portuaria(
	codigoinst char(6), 
	instalacion char (100)
);
alter table instalacion_portuaria add column id_capitania char(4);
alter table instalacion_portuaria add constraint id_capitania FOREIGN KEY (id_capitania) REFERENCES capitanias (id_capitania);

/*----------------------------------------------------------------------------*/