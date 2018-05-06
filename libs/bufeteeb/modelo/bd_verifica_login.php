<?php
function bd_verifica_login($d)
{
	$login=$d['usuario'];
	$clave=$d['contrasena'];
	$sql="SELECT id,apellido,nombre,correo,acceso,condicion,usuario
		  FROM personal 
		  WHERE usuario LIKE '$login' AND clave LIKE MD5('$clave')
		  LIMIT 0,1";
	return sql2row($sql);
}