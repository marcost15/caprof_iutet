<?php
function bd_buscar_consulta($id)
{
  	$sql = "SELECT id,cliente_id,fecha,asunto,tipoconsul,apellidonombre,correo
        	FROM consultas WHERE id ='$id' LIMIT 0,1 ";

	return sql2row($sql);
}