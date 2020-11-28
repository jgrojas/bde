/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de consultas sobre base de datos espacial SIMAR
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------CONSULTAS HOME----------------------------------*/
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Tipos de naves arribadas al país en el periodo de estudio*/
/*----------------------------------------------------------------------------*/
select nom_tiponave,count(nom_tiponave) as total
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula) 
group by nom_tiponave
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Razones de arribo en el país*/
/*----------------------------------------------------------------------------*/
select ra.nom_razon ,count(ra.nom_razon) as total
from arribos_naves_puertos anp
    inner join razon_arribos ra on (anp.id_razonarribo =ra.id_razon) 
group by ra.nom_razon 
order by total desc limit 5
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Tipos de naves arribadas al país en un periodo de tiempo definido*/
/*----------------------------------------------------------------------------*/
select nom_tiponave,count(nom_tiponave)
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula)
where fecha_arribo <'2019-09-26' and fecha_arribo >'2015-09-26'
group by nom_tiponave
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos por capitanía en el periodo de estudio*/
/*----------------------------------------------------------------------------*/
select nom_capitania, count(nom_capitania) as total
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania
order by count(nom_capitania) desc limit 5
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Vista de arribos por capitanía*/
/*----------------------------------------------------------------------------*/
create view arribos_capitanias as
select nom_capitania, count(nom_capitania) as total
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania
order by count(nom_capitania) desc limit 5
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Vista de arribos anual por capitanía*/
/*----------------------------------------------------------------------------*/
create view arribos_anual as
select c.nom_capitania, extract (year from anp.fecha_arribo) as year,count(c.nom_capitania) as total
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania,year
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos anual por capitanía*/
/*----------------------------------------------------------------------------*/
select year, sum(total)
from arribos_anual aa 
group by year
order by year
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos por capitanía desde la vista*/
/*----------------------------------------------------------------------------*/
select nom_capitania, total 
from arribos_capitanias ac
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos por capitanía en un periodo de tiempo definido*/
/*----------------------------------------------------------------------------*/
select nom_capitania, count(nom_capitania) 
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
where fecha_arribo <'2019-09-26' and fecha_arribo >'2015-09-26'
group by nom_capitania
order by count(nom_capitania) desc
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos totales*/
/*----------------------------------------------------------------------------*/
select count(*)
from arribos_naves_puertos anp;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos para el año 2020*/
/*----------------------------------------------------------------------------*/
select count(*)
from(
	select *, extract (year from fecha_arribo) as year
	from arribos_naves_puertos anp) as l
where year = 2020
;
/*----------------------------------------------------------------------------*/

select count() 
/*----------------------------------------------------------------------------*/
/*Principales puertos de origen de las naves arribadas al país"*/
/*----------------------------------------------------------------------------*/
select nom_puerto, count(nom_puerto),p2.nombre, p.geometry 
from puertos p 
    inner join arribos_naves_puertos anp on (p.id_puerto =anp.pto_origen) 
    inner join paises p2 on (p.abreviatura_pais = p2.abreviatura_pais)
group by nom_puerto, p.geometry, p2.nombre 
order by count(nom_puerto) desc limit 10
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Rutas que intersectan con reservas naturales*/
/*----------------------------------------------------------------------------*/
select distinct(anp.geometry,anp.pto_origen),pt.nom_puerto,p.nom_parque,anp.geometry as ruta, p.geometry as parque
from pnn p, arribos_naves_puertos anp
	inner join puertos pt on (pt.id_puerto =anp.pto_origen)
where st_intersects(p.geometry, anp.geometry)
group by  p.nom_parque,anp.geometry,anp.pto_origen,pt.nom_puerto,p.geometry 
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Parque en el área de influencia de 10km*/
/*----------------------------------------------------------------------------*/
select st_intersection(
	ST_Transform(st_buffer(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-81.107 13.028)'),4326),3857),10000),4326),
	p.geometry), nom_parque, p.geometry 
from pnn p
order by st_intersection desc limit 1;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Puerto más cercano según la ubicación de una nave*/
/*----------------------------------------------------------------------------*/
select nom_puerto, p.geometry, 
	st_distance(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-71.107 12.028)'),4326),3857),ST_Transform(p.geometry,3857)) 
from puertos p
order by st_distance limit 1;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Embarcación a menos de 1km de costa*/
/*----------------------------------------------------------------------------*/
select st_buffer(geometry, 100)
from linea_costa;


/*----------------------------------------------------------------------------*/
/*----------------------------CONSULTAS NAVES----------------------------------*/
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Listado de Naves con geometría*/
/*----------------------------------------------------------------------------*/
select nave.omimatricula, nave.nombrenave 
from nave 
inner join arribos_naves_puertos on (arribos_naves_puertos.omimatricula =nave.omimatricula)
where arribos_naves_puertos.geometry is not null 
group by nave.omimatricula

/*----------------------------------------------------------------------------*/
/*Último recorrido*/
/*----------------------------------------------------------------------------*/

select ST_AsGeoJSON(geometry) as geometry 
from "arribos_naves_puertos" 
where "omimatricula" = '17970LX2' 
order by "fecha_arribo" desc limit 1


/*----------------------------------------------------------------------------*/
/*Naves por eslora*/
/*----------------------------------------------------------------------------*/
select count(nave.nombrenave) as total, tiponave.categoria_eslora
from nave
	inner join tiponave on (tiponave.cod_tiponave =nave.codigotiponave)
	inner join arribos_naves_puertos on (arribos_naves_puertos.omimatricula =nave.omimatricula)
group by tiponave.categoria_eslora;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Naves por trb*/
/*----------------------------------------------------------------------------*/
select count(nave.nombrenave) as total, tiponave.categoria_trb 
from nave
	inner join tiponave on (tiponave.cod_tiponave =nave.codigotiponave)
	inner join arribos_naves_puertos on (arribos_naves_puertos.omimatricula =nave.omimatricula)
group by tiponave.categoria_trb;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Puerto origen de las naves*/
/*----------------------------------------------------------------------------*/
select nave.nombrenave, puertos.nom_puerto, arribos_naves_puertos.fecha_arribo,puertos.geometry 
from nave
	inner join arribos_naves_puertos on (arribos_naves_puertos.omimatricula =nave.omimatricula)
	inner join puertos on (puertos.id_puerto =arribos_naves_puertos.pto_origen)
group by nave.nombrenave,puertos.nom_puerto,arribos_naves_puertos.fecha_arribo,puertos.geometry;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Trayectos*/
/*----------------------------------------------------------------------------*/
create view trayectos as
select distinct (arribos_naves_puertos.geometry),pto_origen
from arribos_naves_puertos 
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Punto aleatorio de la nave*/
/*----------------------------------------------------------------------------*/
select ST_GeneratePoints(geom, 1) 
from (
	select ST_Buffer(
		t.geometry,
		1, 'endcap=round join=round') AS geom from trayectos t where t.pto_origen = 'HRPUY'
) AS s 

select t.geometry, t.pto_origen 
from trayectos t 

select nom_puerto, p.geometry, 
	st_distance(ST_Transform(ST_SetSRID((select ST_GeneratePoints(geom, 1,1996) 
										from (
										select ST_Buffer(
										t.geometry, 1, 'endcap=round join=round') AS geom 
										from trayectos t where t.pto_origen = 'HRPUY'
										) AS s limit 1),4326),3857),ST_Transform(p.geometry,3857)) 
from puertos p
order by st_distance limit 1;
 
create view buffer_tracks as
select ST_Buffer(t.geometry, 1, 'endcap=round join=round') AS geom, t.pto_origen 
from trayectos t 
