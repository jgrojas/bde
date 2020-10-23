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
 nom_tiponave char(50) not null,
 categoria_trb char(1),
 categoria_eslora char(1)
 );
/*Prueba 1 de cargue*/
copy tiponave 
from '/csv/tiponave.csv' header csv delimiter ';';

/*Prueba 2 de cargue*/
\copy tiponave FROM PROGRAM 'dir C:\wamp64\www\bde\SQL\csv\tiponave.csv' WITH (format 'csv');

/*Prueba 3 de cargue*/
COPY tiponave(cod_tiponave, nom_tiponave, categoria_trb, categoria_eslora)
FROM '\csv\tiponave.csv'
DELIMITER ';'
CSV HEADER;

