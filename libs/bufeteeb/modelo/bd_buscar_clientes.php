<?php
session_start();
function bd_buscar_clientes($tipo,$texto,$personal_id)
{
	switch($tipo)
	{
		case 1: //Busqueda por letra de apellido
			$letra=$texto;
			$sql = "
				SELECT id, CONCAT( apellido, ', ', nombre ) AS nombreape
				FROM clientes
				WHERE id
							IN (
										SELECT cliente_id
										FROM personal_clientes
										WHERE personal_id = $personal_id
								)
				AND apellido LIKE '{$texto}%'
				";
			break;
		case 2: //Busqueda de texto completo
			$sql = "
				SELECT id, CONCAT( apellido, ', ', nombre ) AS nombreape
				FROM clientes
				WHERE id
							IN (
										SELECT cliente_id
										FROM personal_clientes
										WHERE personal_id = $personal_id
								)
				AND(
				 apellido LIKE '%{$texto}%'
				 OR nombre LIKE '%{$texto}%'
				 )
			";
			break;

	}
	return sql2array($sql);
	}