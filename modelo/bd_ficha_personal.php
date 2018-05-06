<?php
function bd_ficha_personal($id)
{
	$sql = "SELECT  id,apellido,nombre,login,nivel_id,estado,direccion,tlf_fijo,tlf_movil,correo
					FROM personal,personal_datos
					WHERE id = '$id' and personal_id = '$id'
					LIMIT 0,1";
	return sql2row($sql);
}