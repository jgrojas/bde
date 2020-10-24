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
COPY tiponave(cod_tiponave, nom_tiponave)
FROM '/mnt/c/wamp64/www/bde/SQL/csv/tiponave.csv'
DELIMITER ';'
CSV HEADER;
/*----------------------------------------------------------------------------*/

