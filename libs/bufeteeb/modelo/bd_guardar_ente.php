<?php
function bd_guardar_ente($d)
{
	$sql = "INSERT INTO entes (id,nombre,direccion,tipo,descripcion,telfij,otrotelf)
            VALUES ('','$d[nombre]','$d[direccion]','$d[tipo]','$d[descripcion]','$d[telfij]','$d[otrotelf]');
		";
 enviar_sql($sql);
}
	
