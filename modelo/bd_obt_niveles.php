<?php
function bd_obt_niveles($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id,nombre FROM niveles ORDER BY id ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM niveles WHERE id = $id");
	}
}
