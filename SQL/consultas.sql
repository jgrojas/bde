/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de consultas sobre base de datos espacial SIMAR
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------CONSULTAS GLOBALES------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Arribos por año*/
/*----------------------------------------------------------------------------*/
select count(id_capitania), extract (year from fecha_arribo) as year
from arribos_naves_puertos anp
group by year 
;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Capitanías en las que más arribaron embarcaciones en el periodo de estudio*/
/*----------------------------------------------------------------------------*/
select nom_capitania, total 
from arribos_capitanias 
order by total desc
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Puertos de origen de las naves que más arribaron al país"*/
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
/*Tipos de naves arribadas al país en el periodo de estudio*/
/*----------------------------------------------------------------------------*/
select nom_tiponave,count(nom_tiponave) as total
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) 
    inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula) 
group by nom_tiponave
order by total desc
limit 10
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Principales razones de arribo en el país*/
/*----------------------------------------------------------------------------*/
select ra.nom_razon ,count(ra.nom_razon) as total
from arribos_naves_puertos anp
    inner join razon_arribos ra on (anp.id_razonarribo =ra.id_razon) 
group by ra.nom_razon 
order by total desc limit 5
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*---------------------CONSULTAS GLOBALES ADICIONALES-------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Tipos de naves arribadas al país en un periodo de tiempo definido*/
/*----------------------------------------------------------------------------*/
select nom_tiponave,count(nom_tiponave)
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) 
    inner join arribos_naves_puertos anp on (n.omimatricula=anp.omimatricula)
where fecha_arribo <'2019-09-26' and fecha_arribo >'2015-09-26'
group by nom_tiponave
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Arribos mensual*/
/*----------------------------------------------------------------------------*/
select count(id_capitania), extract (month from fecha_arribo) as mes
from arribos_naves_puertos anp
group by mes
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
from arribos_naves_puertos anp
;
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
/*Rutas que intersectan con reservas naturales*/
/*----------------------------------------------------------------------------*/
select t2.pto_origen,pt.nom_puerto,p.nom_parque,t2.geometry as ruta, p.geometry as parque
from pnn p, trayectos t2 
	inner join puertos pt on (pt.id_puerto =t2.pto_origen)
where st_intersects(p.geometry, t2.geometry)
group by  p.nom_parque,t2.geometry,t2.pto_origen,pt.nom_puerto,p.geometry 
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Naves por eslora*/
/*----------------------------------------------------------------------------*/
select count(nave.nombrenave) as total, tiponave.categoria_eslora
from nave
	inner join tiponave on (tiponave.cod_tiponave =nave.codigotiponave)
	inner join arribos_naves_puertos on (arribos_naves_puertos.omimatricula =nave.omimatricula)
group by tiponave.categoria_eslora
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Naves por trb*/
/*----------------------------------------------------------------------------*/
select count(nave.nombrenave) as total, tiponave.categoria_trb 
from nave
	inner join tiponave on (tiponave.cod_tiponave =nave.codigotiponave)
	inner join arribos_naves_puertos on (arribos_naves_puertos.omimatricula =nave.omimatricula)
group by tiponave.categoria_trb
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Puerto origen de las naves*/
/*----------------------------------------------------------------------------*/
select nave.nombrenave, puertos.nom_puerto, arribos_naves_puertos.fecha_arribo,puertos.geometry 
from nave
	inner join arribos_naves_puertos on (arribos_naves_puertos.omimatricula =nave.omimatricula)
	inner join puertos on (puertos.id_puerto =arribos_naves_puertos.pto_origen)
group by nave.nombrenave,puertos.nom_puerto,arribos_naves_puertos.fecha_arribo,puertos.geometry
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Parque en el área de influencia de 10km de una nave en un punto definido*/
/*----------------------------------------------------------------------------*/
select st_intersection(
	ST_Transform(st_buffer(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-81.107 13.028)'),4326),3857),10000),4326),
	p.geometry), nom_parque, p.geometry 
from pnn p
order by st_intersection desc limit 1
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Puerto más cercano por emergencia de la nave*/
/*----------------------------------------------------------------------------*/
select nom_puerto, p.geometry, ST_GeomFromText('POINT(-73.107 13.028)'),
	st_distance(ST_Transform(ST_SetSRID(ST_GeomFromText('POINT(-73.107 13.028)'),4326),3857),ST_Transform(p.geometry,3857)) 
from puertos p
order by st_distance limit 1
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Nave que ha recorrido la ruta más larga*/
/*----------------------------------------------------------------------------*/
select nr.omimatricula, nr.nombrenave, sum(ST_Length(ST_Transform(nr.geometry,3857))) as longitud
from naves_recorrido nr
group by nr.omimatricula,nr.nombrenave 
order by longitud desc limit 10
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*----------------------------CONSULTAS NAVES---------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Características de la Nave*/
/*----------------------------------------------------------------------------*/
select paises.nombre as bandera, nave.eslora, nave.trb, nave.anoconstru, 
	agencianave.agencia_arribo, nave.dwt, agencianave.id_agencia_arribo 
from nave 
inner join agencianave on agencianave.id_agencia_arribo = nave.id_agencia_arribo 
inner join paises on paises.abreviatura_pais = nave.codigo_pais
inner join nave_agencianave na on nave.omimatricula = na.omimatricula 
where nave.omimatricula = '8003060'
;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Agencias de una nave*/
/*----------------------------------------------------------------------------*/
select nave_agencianave.omimatricula, agencianave.id_agencia_arribo,agencianave.agencia_arribo 
from nave_agencianave 
	inner join agencianave on agencianave.id_agencia_arribo = nave_agencianave.id_agencia_arribo 
where nave_agencianave.omimatricula = '030054-F'
group by nave_agencianave.omimatricula,agencianave.id_agencia_arribo,agencianave.agencia_arribo
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Último recorrido de una nave*/
/*----------------------------------------------------------------------------*/
select geometry
from arribos_naves_puertos
where omimatricula = '8003060' 
order by fecha_arribo desc limit 1
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Número de veces que ha arribado la nave al país*/
/*----------------------------------------------------------------------------*/
select count(s.omimatricula) as arribos, s.fecha   
from 
	(select omimatricula, extract (year from anp.fecha_arribo) as fecha from arribos_naves_puertos anp
	where omimatricula = '8003060') as s 
group by fecha
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Distancia entre el último trayecto de la nave y las zonas de reserva*/
/*----------------------------------------------------------------------------*/
select distinct(p2.nom_parque),nr.omimatricula,cp.nom_categoria,p2.geometry as parque,
	ST_Length(ST_Transform(ST_ShortestLine(nr.geometry ,p2.geometry),3857)) as linea_corta 
from naves_recorrido nr, pnn p2 
inner join categoria_pnn cp on (cp.id_categoria=p2.id_categoria) 
where nr.omimatricula ='8003060' and 
nr.geometry = ST_SetSRID(ST_GeomFromText('LINESTRING (-6.296899999999994 36.53243386800006, -43.78154914666101 23.70096526541994, -62.73746387979111 17.55254270476422, -71.60768689903392 12.58179021474831, -72.40728387715495 12.26752601491262, -73.09552790153975 11.70109509218872, -74.92407992533367 11.26472578064329, -75.52027850478925 10.71374171248482, -75.53260235399995 10.40628038199998)'),4326)
order by linea_corta limit 5
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*-------------------------------SIMULADOR------------------------------------*/
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Simulación de un punto en el Caribe Colombiano*/
/*----------------------------------------------------------------------------*/
select point_id
from grilla_caribe gc 
order by random()
limit 1
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Oleaje en la zona de transito de la nave*/
/*----------------------------------------------------------------------------*/
/*Fechas posibles: 2020-09-10 12:00:00,2020-09-11 12:00:00,2020-09-12 12:00:00*/
/*-------------------------------------2020-09-13 12:00:00,2020-09-14 12:00:00*/
/*Puntos de la malla del Caribe: 0 a 8357-------------------------------------*/
/*----------------------------------------------------------------------------*/
select avg(o.altura_ola) as avg, nc.st_buffer as geometry 
from nave_caribe nc, oleaje o 
	inner join grilla_caribe gc on (gc.point_id = o.id_grilla) 
where st_intersects(nc.st_buffer, gc.geometry) and 
	o.fecha = '2020-09-11 12:00:00' and 
	nc.point_id=233 
group by nc.st_buffer 
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Capitanía más cercana a una nave*/
/*----------------------------------------------------------------------------*/
select c.nom_capitania, 
	ST_Length(ST_Transform(ST_ShortestLine(ST_SetSRID(ST_GeomFromText('POINT(-73.107 13.028)'),4326) ,lc.geometry),3857)) as linea_corta 
from linea_costa lc
inner join capitanias c on (c.id_capitania=lc.id_capitania) 
order by linea_corta
limit 1
;
/*----------------------------------------------------------------------------*/
