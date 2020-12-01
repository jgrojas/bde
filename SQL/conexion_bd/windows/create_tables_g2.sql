/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de creacion de base de datos espacial 2020
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/

\pset footer off
SET client_min_messages TO WARNING;
\set ON_ERROR_STOP ON


/*----------------------------------------------------------------------------*/
/*Creacion de extensión postgis para tablas espaciales*/
/*----------------------------------------------------------------------------*/
CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;
/*----------------------------------------------------------------------------*/



/*----------------------------------------------------------------------------*/
/*-------------------------Creacion de tablas simar---------------------------*/
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla agencianave*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.agencianave (
    id_agencia_arribo character(50) PRIMARY KEY,
    agencia_arribo character(100) NOT NULL
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla tiponave*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.tiponave (
    cod_tiponave integer PRIMARY KEY,
    nom_tiponave character(100) NOT NULL,
    categoria_trb character(1),
    categoria_eslora character(1)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla paises*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.paises (
    abreviatura_pais character(3) PRIMARY KEY,
    nombre character(70) NOT NULL,
	alfa_dos character(2)NOT NULL
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla naves*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.nave (
    omimatricula character(20) PRIMARY KEY,
    nombrenave character(40) NOT NULL,
    codigo_pais character(3) REFERENCES public.paises(abreviatura_pais),
    id_agencia_arribo character(20) NOT NULL REFERENCES public.agencianave(id_agencia_arribo),
    codigotiponave integer REFERENCES public.tiponave(cod_tiponave),
    anoconstru character(4),
    trb numeric,
    dwt numeric,
    eslora numeric
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla nave_agencianave*/
/*----------------------------------------------------------------------------*/ 
CREATE TABLE public.nave_agencianave (
    id_agencia_arribo character(50) REFERENCES public.agencianave(id_agencia_arribo),
    omimatricula character(20) REFERENCES public.nave(omimatricula),
    PRIMARY KEY(id_agencia_arribo,omimatricula)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla categoria_pnn*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.categoria_pnn (
    id_categoria character(2) PRIMARY KEY,
    nom_categoria character(50) NOT NULL
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla pnn*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.pnn (
    id_pnn text PRIMARY KEY,
    id_categoria text REFERENCES public.categoria_pnn(id_categoria),
    nom_parque text,
    geometry geometry(Geometry,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla capitanias*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.capitanias (
    id_capitania text PRIMARY KEY,
    nom_capitania text,
    geometry geometry(Polygon,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla linea_costa*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.linea_costa (
    id_linea bigint PRIMARY KEY,
    id_capitania text REFERENCES public.capitanias(id_capitania),
    geometry geometry(Geometry,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla puertos*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.puertos (
    id_puerto text PRIMARY KEY,
    nom_puerto text,
    abreviatura_pais text REFERENCES public.paises(abreviatura_pais),
    geometry geometry(Point,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla razon_arribos*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.razon_arribos (
    id_razon character(1) PRIMARY KEY,
    nom_razon character(25)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla arribos_naves_puertos*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.arribos_naves_puertos (
    id_capitania text NOT NULL REFERENCES public.capitanias(id_capitania),
    omimatricula text NOT NULL REFERENCES public.nave(omimatricula),
    id_razonarribo text REFERENCES public.razon_arribos(id_razon),
    pto_origen text NOT NULL REFERENCES public.puertos(id_puerto),
    geometry geometry(LineString,4326),
    fecha_arribo timestamp NOT NULL,
    PRIMARY KEY(id_capitania,omimatricula,pto_origen,fecha_arribo)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla grilla del Caribe*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.grilla_caribe (
    point_id bigint PRIMARY KEY,
    geometry geometry(Point,4326)
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Creacion de tabla oleaje*/
/*----------------------------------------------------------------------------*/
CREATE TABLE public.oleaje (
    id_oleaje bigint PRIMARY KEY,
    id_grilla bigint NOT NULL REFERENCES public.grilla_caribe(point_id),
    fecha timestamp NOT NULL,
    altura_ola numeric
);
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------Creacion de índices sobre las tablas---------------------*/
/*----------------------------------------------------------------------------*/
create unique index tiponave_id_idx on public.tiponave (cod_tiponave);
create unique index nave_id_idx on public.nave (omimatricula);
create unique index categoria_pnn_id_idx on public.categoria_pnn (id_categoria);
create unique index pnn_id_idx on public.pnn (id_pnn);
create unique index agencianave_id_idx on public.agencianave (id_agencia_arribo);
create unique index nav_agennav_id_idx on public.nave_agencianave (id_agencia_arribo,omimatricula);
create unique index paises_id_idx on public.paises (abreviatura_pais);
create unique index capitania_id_idx on public.capitanias (id_capitania);
create unique index puertos_id_idx on public.puertos (id_puerto);
create unique index lineacosta_id_idx on public.linea_costa (id_linea);
create unique index arribos_id_idx on public.arribos_naves_puertos (id_capitania,omimatricula,pto_origen,fecha_arribo);
create unique index point_id_idx on public.grilla_caribe (point_id);
create unique index oleaje_id_idx on public.oleaje (id_oleaje);
create index id_pnn_geom on public.pnn using GIST (geometry);
create index id_arribos_geom on public.arribos_naves_puertos using GIST (geometry);
create index id_capitanias_geom on public.capitanias using GIST (geometry);
create index id_linea_geom on public.linea_costa using GIST (geometry);
create index id_point_geom on public.grilla_caribe using GIST (geometry);