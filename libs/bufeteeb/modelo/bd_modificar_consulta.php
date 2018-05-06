<?php

function bd_modificar_consulta($d)
{
   enviar_sql(
	   "UPDATE consultas
	   SET cliente_id ='$d[cliente_id]',
	       fecha      ='$d[fecha]',
		   asunto     ='$d[asunto]'	   
	   WHERE consultas.id = '$d[id]' LIMIT 1 ;");
}