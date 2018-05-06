<?php
function bd_verifica_login($d)
{
	$login=$d['usuario'];
	$clave=$d['contrasena'];
	$sql="SELECT id,nombre,estado,nivel_id,login
		  FROM usuarios
		  WHERE login LIKE '$login' AND password LIKE MD5('$clave') AND estado = 'ACTIVO'
		  LIMIT 0,1";
	return sql2row($sql);
}