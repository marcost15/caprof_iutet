<?php
function bd_guardar_recordatorio($d)
{
	$sql = "INSERT INTO recordatorios (id,fecha,asunto,personal_id,hora)
	         	VALUES ('','$d[fecha]','$d[asunto]','$d[personal_id]','$d[hora]');
		";
 enviar_sql($sql);
}
	
