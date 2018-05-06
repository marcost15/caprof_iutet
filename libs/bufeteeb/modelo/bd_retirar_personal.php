<?php
function bd_retirar_personal($id)
{
	enviar_sql("UPDATE personal
					SET condicion = 'RETIRADO' 
					WHERE id      = '$id' LIMIT 1;");
}