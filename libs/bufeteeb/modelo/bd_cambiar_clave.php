<?php
function bd_cambiar_clave($d)
{
  	$id_usuario=$d['id'];
	$clave=$d['clave_nueva'];
	enviar_sql("
		UPDATE personal 
		SET clave = MD5('$clave') 
		WHERE id = $id_usuario LIMIT 1;"
	);
}