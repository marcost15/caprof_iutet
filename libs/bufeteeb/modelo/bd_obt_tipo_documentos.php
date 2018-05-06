<?php
function bd_obt_tipo_documentos($id=NULL)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre	FROM tipo_documentos ORDER BY id DESC");
	}
	else
	{
		return sql2value("SELECT nombre	FROM tipo_documentos WHERE id = $id LIMIT 1");
	}
}