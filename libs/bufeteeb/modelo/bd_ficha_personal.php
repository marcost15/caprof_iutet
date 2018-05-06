<?php
function bd_ficha_personal($id)
{
			$sql = "SELECT  id,ipsa,apellido,nombre,domicilio,telfij,telfmo,correo,usuario,clave,acceso,
							fechaingreso,condicion 
							FROM personal 
							WHERE id=$id
							LIMIT 0,1";
	return sql2row($sql);
}