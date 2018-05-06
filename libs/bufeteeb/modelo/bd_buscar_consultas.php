<?php
function bd_buscar_consultas($li,$d,$tipo)
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
	switch($tipo)
	{
		case 1: //caso de consulta
				$sql = "SELECT id,cliente_id,fecha,asunto,tipoconsul,apellidonombre,correo
						FROM consultas WHERE consultas.personal_id = '$d[id]' 
						ORDER BY `fecha` DESC "."$limite";
		break;
		case 2: //caso de modificar consulta
				$sql = "SELECT id,cliente_id,fecha,asunto,tipoconsul,apellidonombre,correo
						FROM consultas WHERE consultas.personal_id = '$d[id]' AND tipoconsul = 'PRIVADA'
						ORDER BY `fecha` DESC "."$limite";
		break;
	}
	return sql2array($sql);
}