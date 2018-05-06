<?php
function bd_recordatorios_obtener($id)
{
	$sql="
			SELECT id ,fecha,asunto,hora
			FROM recordatorios
			WHERE personal_id ='$id'
			AND estado        = 'PENDIENTE'
	";
	return sql2array($sql);
}