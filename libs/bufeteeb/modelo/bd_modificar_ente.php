<?php
function bd_modificar_ente($d)
{
	   enviar_sql(
	   "UPDATE entes 
	   SET nombre      ='$d[nombre]',
	       direccion   ='$d[direccion]',
		   tipo        ='$d[tipo]',
		   descripcion ='$d[descripcion]',
		   telfij      ='$d[telfij]',
		   otrotelf    ='$d[otrotelf]'
	   WHERE CONVERT(`entes`.`id` USING utf8 ) = '$d[id]' LIMIT 1 ;");
}