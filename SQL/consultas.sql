/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de consultas sobre base de datos espacial SIMAR
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Tipos de naves arribadas al pa�s en el periodo de estudio*/
/*----------------------------------------------------------------------------*/
select nom_tiponave,count(nom_tiponave)
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula) 
group by nom_tiponave
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Tipos de naves arribadas al pa�s en un periodo de tiempo definido*/
/*----------------------------------------------------------------------------*/
select nom_tiponave,count(nom_tiponave)
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula)
where fecha_arribo <'2019-09-26' and fecha_arribo >'2015-09-26'
group by nom_tiponave
;
/*----------------------------------------------------------------------------*/


 /*----------------------------------------------------------------------------*/
/*Arribos por capitan�a en el periodo de estudio*/
/*----------------------------------------------------------------------------*/
select nom_capitania, count(nom_capitania) 
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania
order by count(nom_capitania) desc limit 5
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos por capitan�a en un periodo de tiempo definido*/
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
/*Arribos para el a�o 2020*/
/*----------------------------------------------------------------------------*/
select count(*)
from(
	select *, extract (year from fecha_arribo) as year
	from arribos_naves_puertos anp) as l
where year = 2020
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Principales puertos de origen de las naves arribadas al pa�s"*/
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
select pt.nom_puerto, count(pt.nom_puerto), p.nom_parque, anp.geometry
from pnn p, arribos_naves_puertos anp
	inner join puertos pt on (pt.id_puerto =anp.pto_origen)
where st_intersects(p.geometry, anp.geometry)
group by pt.nom_puerto, p.nom_parque,anp.geometry 
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Parque en el �rea de influencia de 10km*/
/*----------------------------------------------------------------------------*/
select st_intersection(
	ST_Transform(st_buffer(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-81.107 13.028)'),4326),3857),10000),4326),
	p.geometry), nom_parque, p.geometry 
from pnn p
order by st_intersection desc limit 1;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Puerto m�s cercano seg�n la ubicaci�n de una nave*/
/*----------------------------------------------------------------------------*/
select nom_puerto, p.geometry, 
	st_distance(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-71.107 12.028)'),4326),3857),ST_Transform(p.geometry,3857)) 
from puertos p
order by st_distance limit 1;
/*----------------------------------------------------------------------------*/
