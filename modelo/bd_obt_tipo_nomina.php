<?php
function bd_obt_tipo_nomina($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM tipo_nomina ORDER BY id ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM tipo_nomina WHERE id = $id");
	}
}
