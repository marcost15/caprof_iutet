<?php

function bd_guardar_documento($d)
{
	$sql = "INSERT INTO documentos (id,fecha,tipod_id,archivo,descripcion,ente_id,personal_id,cliente_id)
             VALUES ('','$d[fecha]','$d[tipod_id]','$d[archivo]','$d[descripcion]','$d[ente_id]','$d[personal_id]',
			 '$d[cliente_id]');
		";
	if($d[precioserv])
    {    $xcolabog=$d[precioserv]*0.10;
		enviar_sql("INSERT INTO honorarios (id,personal_id,xcolabog,precioserv,fecha,tipohonorario_id)
		VALUES ('','$d[personal_id]','$xcolabog','$d[precioserv]','$d[fecha]','$d[tipohonorario_id]');");
    }
 enviar_sql($sql);
}