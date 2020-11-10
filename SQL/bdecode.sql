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
create unique index tiponave_id_idx on tiponave (cod_tiponave);
/*Cargue*/
COPY tiponave(cod_tiponave, nom_tiponave,categoria_trb,categoria_eslora)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/tiponave.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de tabla nave
/*----------------------------------------------------------------------------*/
--drop table nave cascade;
create table nave(
 omimatricu char(20) primary key,
 nombrenave char(40) not null,
 codigo_pais char(3) not null,
 id_agencia_arribo char(20) not null,
 codigotiponave int,
 anoconstru char(4),
 trb numeric,
 dwt numeric,
 eslora numeric
 );
create unique index nave_id_idx on nave (omimatricu);
/*Limpieza de los registros de la tabla naves*/
DELETE FROM nave; 

/*Actalización de llaves foráneas sobre la tabla naves*/
alter table nave add constraint codigotiponave FOREIGN KEY (codigotiponave) REFERENCES tiponave (cod_tiponave);
alter table nave add constraint codigo_pais FOREIGN KEY (codigo_pais) REFERENCES paises (abreviatura_pais);
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
create unique index categoria_pnn_id_idx on categoria_pnn (id_categoria);
/*Cargue*/
COPY categoria_pnn(id_categoria, nom_categoria)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/categoria_pnn.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de capa parque nacional natural
/*----------------------------------------------------------------------------*/
--truncate table pnn;
create table pnn(
 id_pnn char(10) primary key,
 nom_parque char(100) not null,
 id_categoria char(2) references categoria_pnn
 );
create unique index pnn_id_idx on pnn (id_pnn);
alter table pnn add constraint id_categoria FOREIGN KEY (id_categoria) REFERENCES categoria_pnn (id_categoria);


/*Cargue*/
select AddGeometryColumn ('pnn','geometry',4326,'POLYGON',2, false);
--ogr2ogr -f 'PostgreSQL' PG:'dbname=simar user=postgres' '/mnt/c/wamp64/www/bde/SQL/shp/Parques.shp' -skip-failures
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
create unique index agencianave_id_idx on agencianave (id_agencia_arribo);
/*Cargue*/
COPY agencianave(id_agencia_arribo, agencia_arribo)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/agencianave.csv'
DELIMITER ';'
CSV HEADER;
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
create unique index nav_agennav_id_idx on nave_agencianave (id_agencia_arribo,omimatricu);

/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla paises
/*----------------------------------------------------------------------------*/
drop table paises cascade; 
create table paises(
 abreviatura_pais char(3) primary key ,
 nombre char(50) not null
);
create unique index paises_id_idx on paises (abreviatura_pais);
/*Cargue*/
COPY paises(abreviatura_pais, nombre)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/paises.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/
insert into paises (abreviatura_pais, nombre)values('CAF','Republica Centroafricana')
		

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla capitanias
/*----------------------------------------------------------------------------*/
--drop table capitanias cascade;
create table capitanias(
	id_capitania char(4) primary key,
	nom_capitania char(15) unique	
);
select AddGeometryColumn ('capitanias','geometry',4326,'POLYGON',2, false);
create unique index capitania_id_idx on capitanias (id_capitania);
/*Cargue*/
COPY capitanias(id_capitania, nom_capitania,geometry)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/capitanias.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla puerto
/*----------------------------------------------------------------------------*/
drop table puertos cascade;
create table puertos(
 id_puerto char(5),
 nom_puerto char(10) not null,
 abreviatura_pais char(3),
 foreign key (id_capitania) references capitanias (id_capitania),
 foreign key (abreviatura_pais) references paises (abreviatura_pais),
 primary key (id_puerto)
);

select AddGeometryColumn ('puertos','geometry',4326,'POINT',2, false);
create unique index puertos_id_idx on puertos (id_puerto);
/*----------------------------------------------------------------------------*/
alter table puertos add column id_capitania char(4);
alter table puertos add constraint id_capitania FOREIGN KEY (id_capitania) REFERENCES capitanias (id_capitania);
alter table puertos add constraint id_puerto primary KEY (id_puerto)
alter table puertos add constraint abreviatura_pais FOREIGN KEY (abreviatura_pais) REFERENCES paises (abreviatura_pais);


/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla razon_arribos
/*----------------------------------------------------------------------------*/

create table razon_arribos(
	id_razon char(1) primary key,
	nom_razon char(25)
);
create unique index razon_arribo_idx on razon_arribos (id_razon);
/*Cargue*/
COPY razon_arribos(id_razon, nom_razon)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/razon_arribos.csv'
DELIMITER ';'
CSV HEADER;

/*----------------------------------------------------------------------------*/



/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla arribos_naves_puertos
/*----------------------------------------------------------------------------*/
drop table arribos_naves_puertos
create table arribos_naves_puertos(
	pto_origen char(5), 
	id_capitania char(4),
	omimatricu char(20),
	id_razon char(1),
	fecha_arribo timestamp,	
	foreign key (pto_origen) references puertos (id_puerto),
	foreign key (id_capitania) references capitanias (id_capitania),
	foreign key (omimatricu) references nave (omimatricu),
	foreign key (id_razon) references razon_arribos (id_razon),
	primary key(pto_origen,id_capitania,omimatricu,fecha_arribos)
);
alter table arribos_naves_puertos add constraint pto_origen FOREIGN KEY (pto_origen) REFERENCES puertos (id_puerto);
alter table arribos_naves_puertos add constraint id_capitania FOREIGN KEY (id_capitania) REFERENCES capitanias (id_capitania);
alter table arribos_naves_puertos add constraint omimatricu FOREIGN KEY (omimatricu) REFERENCES nave (omimatricu);
alter table arribos_naves_puertos add constraint id_razon FOREIGN KEY (id_razon) REFERENCES razon_arribos (id_razon);
alter table arribos_naves_puertos add constraint id_arribo primary KEY (pto_origen,id_capitania,omimatricu,fecha_arribo)

create unique index arribo_nave_puerto_idx on arribos_naves_puertos (pto_origen,id_capitania,omimatricu,fecha_arribo);
/*Cargue*/
SET datestyle = dmy;
COPY arribos_naves_puertos(pto_origen, id_capitania,omimatricu,id_razon,fecha_arribos)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/arribos.csv'
DELIMITER ';'
CSV HEADER;


/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla linea de costa
/*----------------------------------------------------------------------------*/
create table linea_costa(
	id_linea int primary key
);
alter table linea_costa add column id_capitania char(4);
alter table linea_costa add constraint id_capitania FOREIGN KEY (id_capitania) REFERENCES capitanias (id_capitania);
select AddGeometryColumn ('linea_costa','geometry',4326,'LINESTRING',2, false);
create unique index linea_costa_idx on linea_costa (id_linea);
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Creacion y cargue de la tabla instalación portuaria
/*----------------------------------------------------------------------------*/

create table instalacion_portuaria(
	codigoinst char(6) primary key, 
	instalacion char (100)
);
alter table instalacion_portuaria add column id_capitania char(4);
alter table instalacion_portuaria add constraint id_capitania FOREIGN KEY (id_capitania) REFERENCES capitanias (id_capitania);
select AddGeometryColumn ('instalacion_portuaria','geometry',4326,'POLYGON',2, false);
create unique index codigoinst_idx on instalacion_portuaria (codigoinst);
/*----------------------------------------------------------------------------*/


--ogr2ogr shp2pgsql
--ogr2ogr.exe -f 'PostgreSQL' PG:'dbname=simar user=postgres' '/mnt/c/wamp64/www/bde/SQL/shp/Parques.shp' -skip-failures

