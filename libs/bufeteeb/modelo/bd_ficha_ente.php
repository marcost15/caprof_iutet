<?php
function bd_ficha_ente($id)
{
			$sql = "SELECT id,nombre,direccion,tipo,descripcion,telfij,otrotelf
					FROM entes 
					WHERE id=$id LIMIT 0,1";
	return sql2row($sql);
}