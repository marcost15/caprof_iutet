<?php
function bd_buscar_abogados()
{
		 	$sql = "SELECT id,ipsa,apellido,nombre,correo,acceso,usuario
			FROM personal 
			WHERE condicion LIKE 'ACTIVO'
				AND acceso LIKE  'Abogado'
			      ORDER BY apellido ASC";
	
 	return sql2array($sql);
}