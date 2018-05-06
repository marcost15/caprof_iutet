<?php
function bd_guardar_nomina_iutet($d)
{
	$fecha = date('Y-m-d');
	enviar_sql("INSERT INTO archivos (id,usuario,fecha,nomb_arch,fecha_ini,fecha_fin,tipo,tipo_id) 
	VALUES ('','$d[usuario]','$fecha','$d[nomb_arch]','$d[fecha_ini]','$d[fecha_fin]','UPT','$d[tipo_id]');");
}