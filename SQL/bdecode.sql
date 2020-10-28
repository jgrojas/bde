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