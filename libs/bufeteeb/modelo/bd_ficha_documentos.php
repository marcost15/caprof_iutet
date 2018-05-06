<?php
function bd_ficha_documentos($id)
{
			$sql = "SELECT id,fecha,tipod_id,archivo,descripcion,ente_id,personal_id,cliente_id
			FROM documentos 
			WHERE id='$id' LIMIT 0,1";
	return sql2row($sql);
}