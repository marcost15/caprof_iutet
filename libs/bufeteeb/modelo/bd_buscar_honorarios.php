<?php
function bd_buscar_honorarios($li,$d)
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
	
	$sql = "SELECT id,personal_id,xcolabog,precioserv,fecha,tipohonorario_id
        	FROM honorarios 
			WHERE personal_id = '$d[id]' ORDER BY `fecha` DESC "."$limite";
	return sql2array($sql);
	
}