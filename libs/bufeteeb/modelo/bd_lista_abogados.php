<?php
function bd_lista_abogados()
{
		 	$sql = "SELECT id,CONCAT(apellido,', ',nombre) as nmb
			FROM personal 
			WHERE condicion LIKE 'ACTIVO'
			AND acceso LIKE '2'
			ORDER BY apellido ASC";
 	return sql2opciones($sql);
}