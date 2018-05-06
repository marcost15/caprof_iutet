<?php
function bd_guardar_personal($d)
{
	$id=$d['id'];
	$n=sql2value("SELECT COUNT(*) FROM personal WHERE id LIKE '$id'");
	if ($n==0)
	{
		$sql = "INSERT INTO personal (id,ipsa,apellido,nombre,domicilio,telfij,telfmo,correo,usuario,clave,acceso, 
				fechaingreso,condicion) 
				VALUES ('$d[id]','$d[ipsa]','$d[apellido]','$d[nombre]','$d[domicilio]','$d[telfij]','$d[telfmo]', 
				'$d[correo]','$d[usuario]',MD5('$d[clave]'),'$d[acceso]','$d[fecha]','ACTIVO');
		";
	}
    else
	{  
	$sql= "UPDATE personal 
	       SET ipsa         =  '$d[ipsa]',
		       apellido     =  '$d[apellido]',
               nombre       =  '$d[nombre]',
               domicilio    =  '$d[domicilio]',
               telfij       =  '$d[telfij]',
               telfmo       =  '$d[telfmo]',
               correo       =  '$d[correo]',
		       fechaingreso =  '$d[fecha]'
		       WHERE CONVERT(`personal`.`id` USING utf8 ) = '$id' LIMIT 1 ;";
	}
 enviar_sql($sql);
}
	
