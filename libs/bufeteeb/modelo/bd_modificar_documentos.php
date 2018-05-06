<?php
function bd_modificar_documentos($d)
{
	   enviar_sql(
	   "UPDATE entes 
	   SET fecha          ='$d[fecha]',
	       tipod_id       ='$d[tipod_id]',
		   archivo        ='$d[archivo]',
		   descripcion    ='$d[descripcion]',
		   ente_id        ='$d[ente_id]',
		   personal_id    ='$d[personal_id]'
		   cliente_id     ='$d[cliente_id]'
	   WHERE CONVERT(`documentos`.`id` USING utf8 ) = '$d[id]' LIMIT 1 ;");
}