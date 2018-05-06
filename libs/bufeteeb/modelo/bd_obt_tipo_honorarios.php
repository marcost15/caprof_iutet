<?php
function bd_obt_tipo_honorarios($id=NULL)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,descripcion	FROM tipo_honorarios ORDER BY id DESC");
	}
	else
	{
		return sql2value("SELECT descripcion FROM tipo_honorarios WHERE id = $id LIMIT 1");
	}
}