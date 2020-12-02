/*----------------------------------------------------------------------------*/
/*Vista de arribos por capitanía*/
/*----------------------------------------------------------------------------*/
/*Vista generada para agilizar las consultas dentro de SIMAR, realiza el conteo */
/*de las capitanías dentro de la tabla de arribos---------------------------- */
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
/*Vista de rutas viales*/
/*----------------------------------------------------------------------------*/
/*Vista generada para realizar consultas espaciales, define las rutas únicas  */
/*de los puertos al país y que están presentes en la tabla de arribos-------- */
/*----------------------------------------------------------------------------*/
create or replace view trayectos as
select distinct (anp.geometry),anp.pto_origen, p.nom_puerto
from arribos_naves_puertos anp
	inner join puertos p on (p.id_puerto =anp.pto_origen)
;
/*----------------------------------------------------------------------------*/
	
	
/*----------------------------------------------------------------------------*/
/*Naves con track almacenado*/
/*----------------------------------------------------------------------------*/
/*Vista generada para realizar consultas espaciales, define las naves con las */
/*que se cuenta un trayecto asociado----------------------------------------- */
/*----------------------------------------------------------------------------*/
create or replace view naves_recorrido as
select n.nombrenave, n.omimatricula, n.trb, n.eslora, anp.geometry 
from nave n
	inner join arribos_naves_puertos anp on (anp.omimatricula=n.omimatricula) 
where anp.geometry is not null
;
/*----------------------------------------------------------------------------*/


/*----------------------------------------------------------------------------*/
/*Área de influencia de una nave en el Caribe*/
/*----------------------------------------------------------------------------*/
/*Vista generada para realizar consultas espaciales, simula un área de afectación*/
/*por el oleaje.------------------------------------------------------------- */
/*----------------------------------------------------------------------------*/
create or replace view nave_caribe as
select ST_Buffer(gc.geometry, 1, 'endcap=round join=round'),gc.point_id 
from grilla_caribe gc
;
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
/*Zona de arribo al contintente*/
/*----------------------------------------------------------------------------*/
/*Vista generada para realizar consultas espaciales, define el área de llegada*/
/*a la línea de costa.------------------------------------------------------- */
/*----------------------------------------------------------------------------*/
create or replace view aprox_costa as
select lc.id_capitania, st_buffer(lc.geometry,0.008) 
from linea_costa lc
;
/*----------------------------------------------------------------------------*/
