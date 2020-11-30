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
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) 
    inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula) 
group by nom_tiponave
order by total desc
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
create or replace view arribos_capitanias as
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
create or replace view arribos_mensual as
select c.nom_capitania, extract (month from anp.fecha_arribo) as month,count(c.nom_capitania) as total
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania,month
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Vista de arribos mensual por capitanía*/
/*----------------------------------------------------------------------------*/
create view arribos_anual as
select c.nom_capitania, extract (year from anp.fecha_arribo) as year,count(c.nom_capitania) as total
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania,year
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Trayectos*/
/*----------------------------------------------------------------------------*/
create or replace view trayectos as
select distinct (anp.geometry),anp.pto_origen, p.nom_puerto
from arribos_naves_puertos anp
	inner join puertos p on (p.id_puerto =anp.pto_origen)
	
create or replace view buffer_tracks as
select ST_Buffer(t.geometry, 1, 'endcap=round join=round') AS geom, t.pto_origen, t.nom_puerto
from trayectos t 
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
/*Arribos mensual por capitanía*/
/*----------------------------------------------------------------------------*/
select month, sum(total)
from arribos_mensual am 
group by month
order by month
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
select count(id_capitania)
from arribos_naves_puertos anp;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos para el año 2020*/
/*----------------------------------------------------------------------------*/
select count(id_capitania)
from(
	select id_capitania, extract (year from fecha_arribo) as year
	from arribos_naves_puertos anp) as l
where year = 2020
;


/*----------------------------------------------------------------------------*/


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
create or replace view rutas_intersect as
select t2.pto_origen,pt.nom_puerto,p.nom_parque,t2.geometry as ruta, p.geometry as parque
from pnn p, trayectos t2 
	inner join puertos pt on (pt.id_puerto =t2.pto_origen)
where st_intersects(p.geometry, t2.geometry)
group by  p.nom_parque,t2.geometry,t2.pto_origen,pt.nom_puerto,p.geometry 
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
/*----------------------------CONSULTAS NAVES---------------------------------*/
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
/*Punto aleatorio de la nave*/
/*----------------------------------------------------------------------------*/
create or replace view punto_aleatorio as
select ST_GeneratePoints(geom, 1), bt.pto_origen, bt.nom_puerto 
from buffer_tracks bt  
where bt.pto_origen = 'HRPUY'
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Puerto más cercano por emergencia de la nave*/
/*----------------------------------------------------------------------------*/
select o.nom_puerto as origen, p.nom_puerto as puerto_emergencia, p.geometry, o.st_generatepoints, 
	st_distance(ST_Transform(ST_SetSRID((o.st_generatepoints),4326),3857),ST_Transform(p.geometry,3857)) 
from puertos p,punto_aleatorio o
order by st_distance limit 1;
/*----------------------------------------------------------------------------*/
 

/*----------------------------------------------------------------------------*/
/*Distancia al puerto de Cartagena*/
/*----------------------------------------------------------------------------*/
select o.nom_puerto as origen, p.nom_puerto as destino, p.geometry, o.st_generatepoints, 
	st_distance(ST_Transform(ST_SetSRID((o.st_generatepoints),4326),3857),ST_Transform(p.geometry,3857)) as distancia 
from puertos p,punto_aleatorio o
where p.id_puerto = 'COCTG'
order by distancia limit 1;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------CONSULTAS ESPACIALES----------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Ubicación de la nave en el Caribe*/
/*----------------------------------------------------------------------------*/
create or replace view nave_caribe as
select ST_Buffer(gc.geometry, 1, 'endcap=round join=round')
from grilla_caribe gc 
order by random()
limit 1 
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Oleaje en una fecha definida*/
/*----------------------------------------------------------------------------*/
create or replace view oleaje_dia as
select o2.altura_ola,gc.point_id,gc.geometry 
from grilla_caribe gc
	inner join oleaje o2 on (o2.id_grilla =gc.point_id)
where o2.fecha = '2020-09-11 12:00:00'
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Categoría del oleaje sobre la posición de una nave*/
/*----------------------------------------------------------------------------*/
select nc.st_buffer, avg(od.altura_ola)
from nave_caribe nc, oleaje_dia od 
where st_intersects(nc.st_buffer, od.geometry) 
group by nc.st_buffer  
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Tipo de embarcaciones transitaron por un puerto*/
/*----------------------------------------------------------------------------*/
select p.nom_puerto,nom_tiponave,count(nom_tiponave) 
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) 
    inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula)
    inner join puertos p on (p.id_puerto=anp.pto_origen)
where fecha_arribo <'2019-09-26' and fecha_arribo >'2015-09-26'
group by p.nom_puerto,nom_tiponave
order by p.nom_puerto 
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Nave con track almacenado*/
/*----------------------------------------------------------------------------*/
create or replace view naves_recorrido as
select n.nombrenave, n.omimatricula, anp.geometry 
from nave n
	inner join arribos_naves_puertos anp on (anp.omimatricula=n.omimatricula) 
where anp.geometry is not null




/*----------------------------------------------------------------------------*/
/*Nave que ha recorrido la ruta más larga*/
/*----------------------------------------------------------------------------*/
select nr.omimatricula, nr.nombrenave, sum(ST_Length(ST_Transform(nr.geometry,3857))) as longitud
from naves_recorrido nr
group by nr.omimatricula,nr.nombrenave 
order by longitud desc limit 10
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Número de veces que ha arribado la nave al país*/
/*----------------------------------------------------------------------------*/
select nr.nombrenave, nr.omimatricula, count(anp.omimatricula) as arribos
from naves_recorrido nr
	inner join arribos_naves_puertos anp on (anp.omimatricula=nr.omimatricula) 
group by nr.omimatricula, nr.nombrenave
order by arribos desc limit 10
/*----------------------------------------------------------------------------*/