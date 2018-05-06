<?php
function bd_ficha_cliente($id)
{
			$sql = "SELECT id,nacionalidad,apellido,nombre,domicilio,estadocivil,telfij,telmo,correo
							FROM clientes
							WHERE id='$id'
							LIMIT 0,1";
	return sql2row($sql);
}