<?php
function bd_modificar_personal($d)
{
	$id  = $d['id'];
	$sql = "UPDATE usuarios
			SET nombre          =  '$d[nombre]',
				nivel_id           =  '$d[nivel]',
				correo           =  '$d[correo]'
				WHERE CONVERT(`usuarios`.`id` USING utf8 ) = '$id' LIMIT 1 ;";
	enviar_sql($sql);
 }