/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de consultas sobre base de datos espacial SIMAR
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/



/*Tipos de naves arribadas al país en el periodo de estudio*/

select nom_tiponave,count(nom_tiponave)
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) inner join arribos_naves_puertos anp on (n.omimatricu=anp.omimatricu) 
group by nom_tiponave
;

/*Tipos de naves arribadas al país en un periodo de tiempo definido*/

select nom_tiponave,count(nom_tiponave)
from nave n
    inner join tiponave t on (t.cod_tiponave=n.codigotiponave) inner join arribos_naves_puertos anp on (n.omimatricu=anp.omimatricu)
where fecha_arribo <'2019-09-26' and fecha_arribo >'2015-09-26'
group by nom_tiponave
;
 
/*Arribos por capitanía en el periodo de estudio*/

select nom_capitania, count(nom_capitania) 
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania
order by count(nom_capitania) desc 
;

/*Arribos por capitanía en un periodo de tiempo definido*/

select nom_capitania, count(nom_capitania) 
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
where fecha_arribo <'2019-09-26' and fecha_arribo >'2015-09-26'
group by nom_capitania
order by count(nom_capitania) desc
;


/*Arribos totales*/
select count(*)
from arribos_naves_puertos anp;


/*Arribos para el año 2020*/
select count(*)
from(
	select *, extract (year from fecha_arribo) as year
	from arribos_naves_puertos anp) as l
where year = 2020


/*Principales puertos de origen de las naves arribadas al país"*/
select nom_puerto, count(nom_puerto)
from puertos p 
    inner join arribos_naves_puertos anp on (p.id_puerto =anp.pto_origen)
group by nom_puerto
order by count(nom_puerto) desc limit 10
;

/*Rutas que intersectan con reservas naturales*/
select pt.nom_puerto, count(pt.nom_puerto), p.nom_parque, anp.geometry 
FROM pnn p, arribos_naves_puertos anp
	inner join puertos pt on (pt.id_puerto =anp.pto_origen)
WHERE st_intersects(p.geometry, anp.geometry)
group by pt.nom_puerto, p.nom_parque,anp.geometry 
;

