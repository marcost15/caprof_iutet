<?php
function bd_buscar_recordatorio($id)
{
	$sql="
			SELECT id , fecha , asunto,hora,personal_id
			FROM recordatorios
			WHERE id =$id
	";
	return sql2row($sql);
}