<?php
function bd_guardar_honorario($d)
{   
   $xcolabog=$d[precioserv]*0.10;
    switch($d[xcolabog])
	{
		case 1:
	    enviar_sql("INSERT INTO honorarios (id,personal_id,xcolabog,precioserv,fecha,tipohonorario_id)
	               VALUES ('','$d[personal_id]','$xcolabog','$d[precioserv]','$d[fecha]',
				   '$d[tipohonorario_id]');");
			break;
		case 2:
		enviar_sql("INSERT INTO honorarios (id,personal_id,xcolabog,precioserv,fecha,tipohonorario_id)
		            VALUES ('','$d[personal_id]','NULL','$d[precioserv]','$d[fecha]','$d[tipohonorario_id]');");
			break;
	}
}