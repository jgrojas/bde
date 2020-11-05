/*----------------------------------------------------------------------------*/
/*Documentacion del codigo SQL de consultas sobre base de datos espacial SIMAR
Autores: Angie Montoya, Gabriel Rojas */
/*----------------------------------------------------------------------------*/

/*Tipos de naves disponibles arribadas al país en el periodo de estudio*/

select nom_tiponave,count(nom_tiponave)
from
    nave n
    inner join tiponave t on t.cod_tiponave=n.codigotiponave 
group by nom_tiponave
;



