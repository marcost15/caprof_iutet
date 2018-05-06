<?php
function bd_buscar_personal($tipo,$texto)
{
	switch($tipo)
	{
		case 1: //Busqueda por letra de apellido
			$letra=$texto;
			$sql = "SELECT id,ipsa,apellido,nombre,correo,telfij,telfmo,acceso,usuario
							FROM personal 
							WHERE condicion LIKE 'ACTIVO'
							AND apellido    LIKE  '{$letra}%'
							ORDER BY apellido ASC";
			break;
		case 2: //Busqueda de texto completo
			$sql = "SELECT id,ipsa,apellido,nombre,telfij,telfmo,correo,acceso,usuario
							FROM personal
							WHERE condicion LIKE 'ACTIVO'
							AND(id          LIKE '%$texto%' 
 								OR ipsa     LIKE '%$texto%' 
								OR apellido LIKE '%$texto%' 
								OR nombre   LIKE '%$texto%' 
								OR correo   LIKE '%$texto%'
								OR acceso   LIKE '%$texto%' 
								OR usuario  LIKE '%$texto%')";
			break;
	}
	return sql2array($sql);
}