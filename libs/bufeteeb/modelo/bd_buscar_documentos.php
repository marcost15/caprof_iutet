<?php
function bd_buscar_documentos($li,$d)
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
	
	$sql = "SELECT id,fecha,tipod_id,archivo,descripcion,ente_id,personal_id,cliente_id
        	FROM documentos WHERE documentos.personal_id = '$d[id]' ORDER BY `fecha` DESC "."$limite";
			
	return sql2array($sql);
	
}