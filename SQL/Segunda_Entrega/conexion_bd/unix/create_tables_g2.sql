/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de creacion de base de datos espacial 2020
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de base de datos simar*/
/*----------------------------------------------------------------------------*/
--CREATE DATABASE simar ENCODING 'UTF8' OWNER postgres;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de esquema simar*/
/*----------------------------------------------------------------------------*/
CREATE SCHEMA simar;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de extensi�n postgis para tablas espaciales*/
/*----------------------------------------------------------------------------*/
CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA simar;
/*----------------------------------------------------------------------------*/



/*----------------------------------------------------------------------------*/
/*-------------------------Creacion de tablas simar---------------------------*/
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla agencianave*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.agencianave (
    id_agencia_arribo character(50) PRIMARY KEY,
    agencia_arribo character(100) NOT NULL
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla tiponave*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.tiponave (
    cod_tiponave integer PRIMARY KEY,
    nom_tiponave character(100) NOT NULL,
    categoria_trb character(1),
    categoria_eslora character(1)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla paises*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.paises (
    abreviatura_pais character(3) PRIMARY KEY,
    nombre character(50) NOT NULL
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla naves*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.nave (
    omimatricula character(20) PRIMARY KEY,
    nombrenave character(40) NOT NULL,
    codigo_pais character(3) REFERENCES paises(abreviatura_pais),
    id_agencia_arribo character(20) NOT NULL REFERENCES agencianave(id_agencia_arribo),
    codigotiponave integer REFERENCES tiponave(cod_tiponave),
    anoconstru character(4),
    trb numeric,
    dwt numeric,
    eslora numeric
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla nave_agencianave*/
/*----------------------------------------------------------------------------*/ 
CREATE TABLE simar.nave_agencianave (
    id_agencia_arribo character(50) REFERENCES agencianave(id_agencia_arribo),
    omimatricula character(20) REFERENCES nave(omimatricula),
    PRIMARY KEY(id_agencia_arribo,omimatricula)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla categoria_pnn*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.categoria_pnn (
    id_categoria character(2) PRIMARY KEY,
    nom_categoria character(50) NOT NULL
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla pnn*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.pnn (
    id_pnn text PRIMARY KEY,
    id_categoria text REFERENCES categoria_pnn(id_categoria),
    nom_parque text,
    geometry geometry(Geometry,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla capitanias*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.capitanias (
    id_capitania text PRIMARY KEY,
    nom_capitania text,
    geometry geometry(Polygon,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla linea_costa*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.linea_costa (
    id_linea bigint PRIMARY KEY,
    id_capitania text REFERENCES capitanias(id_capitania),
    geometry geometry(Geometry,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla puertos*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.puertos (
    id_puerto text PRIMARY KEY,
    nom_puerto text,
    abreviatura_pais text REFERENCES paises(abreviatura_pais),
    geometry geometry(Point,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla razon_arribos*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.razon_arribos (
    id_razon character(1) PRIMARY KEY,
    nom_razon character(25)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla arribos_naves_puertos*/
/*----------------------------------------------------------------------------*/
CREATE TABLE simar.arribos_naves_puertos (
    id_capitania text NOT NULL REFERENCES capitanias(id_capitania),
    omimatricula text NOT NULL REFERENCES nave(omimatricula),
    id_razonarribo text REFERENCES razon_arribos(id_razon),
    pto_origen text NOT NULL REFERENCES puertos(id_puerto),
    geometry geometry(LineString,4326),
    fecha_arribo timestamp NOT NULL,
    PRIMARY KEY(id_capitania,omimatricula,pto_origen,fecha_arribo)
);


/*----------------------------------------------------------------------------*/
/*-------------------Creacion de �ndices sobre las tablas---------------------*/
/*----------------------------------------------------------------------------*/
create unique index tiponave_id_idx on simar.tiponave (cod_tiponave);
create unique index nave_id_idx on simar.nave (omimatricula);
create unique index categoria_pnn_id_idx on simar.categoria_pnn (id_categoria);
create unique index pnn_id_idx on simar.pnn (id_pnn);
create unique index agencianave_id_idx on simar.agencianave (id_agencia_arribo);
create unique index nav_agennav_id_idx on simar.nave_agencianave (id_agencia_arribo,omimatricula);
create unique index paises_id_idx on simar.paises (abreviatura_pais);
create unique index capitania_id_idx on simar.capitanias (id_capitania);
create unique index puertos_id_idx on simar.puertos (id_puerto);
create unique index arribos_id_idx on simar.arribos_naves_puertos (id_capitania,omimatricula,pto_origen,fecha_arribo);
create index id_pnn_geom on simar.pnn using GIST (geometry);
create index id_arribos_geom on simar.arribos_naves_puertos using GIST (geometry);
create index id_capitanias_geom on simar.capitanias using GIST (geometry);
