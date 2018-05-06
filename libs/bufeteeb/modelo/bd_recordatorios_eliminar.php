<?php
function bd_recordatorios_eliminar($id)
{
	$sql="
			UPDATE recordatorios
			SET estado='FINALIZADO'
			WHERE id=$id
			LIMIT 1
	";
	enviar_sql($sql);
}

