<?php
function bd_guardar_clientes($d)
{
    $id=$d['id'];
	$n=sql2value("SELECT COUNT(*) FROM clientes WHERE id LIKE '$id'");
	
	if ($n==0)
	{
	enviar_sql("
		INSERT INTO clientes (id, nacionalidad, apellido, nombre,domicilio, estadocivil, telfij, telmo, correo) 
		VALUES ('$d[id]', '$d[nacionalidad]', '$d[apellido]', '$d[nombre]', 
			'$d[domicilio]', '$d[estadocivil]', '$d[telfij]', '$d[telmo]', '$d[correo]');
		");	
	$cliente_id=$d['id'];
	foreach($d['abogado'] as $personal_id)
		{
			$sql="
				INSERT INTO personal_clientes ( id , cliente_id , personal_id )
				VALUES (NULL , '$cliente_id', '$personal_id')
			";
			enviar_sql($sql);
		}
	}
    else
	{  
	   enviar_sql(
	   "UPDATE clientes 
	   SET apellido    =  '$d[apellido]',
           nombre      =  '$d[nombre]',
           domicilio   =  '$d[domicilio]',
           estadocivil =  '$d[estadocivil]',
           telfij      =  '$d[telfij]',
           telmo       =  '$d[telmo]',
           correo      =  '$d[correo]'
		   WHERE CONVERT(`clientes`.`id` USING utf8 ) = '$id' LIMIT 1 ;");
	$cliente_id=$d['id'];	   
	enviar_sql("DELETE personal_clientes.*
	FROM `personal_clientes` 
	WHERE `personal_clientes`.`cliente_id` = '$cliente_id'");
	foreach($d['abogado'] as $personal_id)
		{
			$sql="
				INSERT INTO personal_clientes ( id , cliente_id , personal_id )
				VALUES (NULL , '$cliente_id', '$personal_id')
			";
			enviar_sql($sql);
		}
	} 
}