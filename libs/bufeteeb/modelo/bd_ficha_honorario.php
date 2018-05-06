<?php
function bd_ficha_honorario($id)
{
			$sql = "SELECT id,personal_id,xcolabog,precioserv,fecha,tipohonorario_id
			FROM honorarios 
			WHERE id='$id' LIMIT 0,1";
	return sql2row($sql);
}