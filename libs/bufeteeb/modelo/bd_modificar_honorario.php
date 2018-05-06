<?php
function bd_modificar_honorario($d)
{   
   $xcolabog=$d[precioserv]*0.10;
    switch($d[xcolabog])
	{
		case 1:
			enviar_sql(
				"UPDATE honorarios 
				SET personal_id   ='$d[personal_id]',
				xcolabog          ='$xcolabog',
				precioserv        ='$d[precioserv]',
				fecha             ='$d[fecha]',
				tipohonorario_id  ='$d[tipohonorario_id]'
			WHERE CONVERT(`honorarios`.`id` USING utf8 ) = '$d[id]' LIMIT 1 ;");
			break;
		case 2:
			enviar_sql(
				"UPDATE honorarios 
				SET personal_id   ='$d[personal_id]',
				xcolabog          ='NULL',
				precioserv        ='$d[precioserv]',
				fecha             ='$d[fecha]',
				tipohonorario_id  ='$d[tipohonorario_id]'
			WHERE CONVERT(`honorarios`.`id` USING utf8 ) = '$d[id]' LIMIT 1 ;");
			break;
	}
}