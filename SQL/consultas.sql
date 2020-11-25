/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de consultas sobre base de datos espacial SIMAR
Autores: Angie Montoya, Gabriel Rojas */
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
select nom_capitania, count(nom_capitania) 
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
select c.nom_capitania, anp.id_capitania 
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos por capitanía desde la vista*/
/*----------------------------------------------------------------------------*/
select nom_capitania, count(nom_capitania) as total 
from arribos_capitanias ac
group by(nom_capitania)
order by (total) desc limit 5
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
/*Listado de Naves*/
/*----------------------------------------------------------------------------*/

select nave.omimatricula, nave.nombrenave from nave 
