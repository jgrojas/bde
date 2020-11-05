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
where fecha_arribos <'2018-01-16' and fecha_arribos > '2015-01-16'
group by nom_tiponave
;
 
/*Arribos por capitanía en el periodo de estudio*/

select nom_capitania, count(nom_capitania) 
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
group by nom_capitania
order by count(nom_capitania) 
;

/*Arribos por capitanía en un periodo de tiempo definido*/

select nom_capitania, count(nom_capitania) 
from capitanias c
	inner join arribos_naves_puertos anp on (c.id_capitania=anp.id_capitania)
where fecha_arribos <'2018-01-16' and fecha_arribos > '2015-01-16'
group by nom_capitania
order by count(nom_capitania) 
;

/*Arribos por mes*/
select anual, count(anual)
from(
	select fecha_arribos, extract (year from fecha_arribos) as anual
	from arribos_naves_puertos anp) as sub
;	
