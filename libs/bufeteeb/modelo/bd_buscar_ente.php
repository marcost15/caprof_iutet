<?php
function bd_buscar_ente($li)
{
    $delta=$_SESSION['ini']['global']['delta'];
	
	if ($li!='')
	{
		$limite=" LIMIT $li, $delta";
	}
	else
	{
		$limite='';
	}	
	$sql = "SELECT id,nombre,direccion,tipo,descripcion,telfij,otrotelf 
	        FROM entes" ."$limite";
	return sql2array($sql);
}