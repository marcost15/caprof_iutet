<?php

function bd_modificar_recordatorio($d)
{
   enviar_sql(
	   "UPDATE recordatorios 
	   SET fecha       ='$d[fecha]',
	       asunto      ='$d[asunto]',
		   personal_id ='$d[personal_id]',
		   hora        ='$d[hora]'
	   WHERE recordatorios.id = '$d[id]' LIMIT 1 ;");
}