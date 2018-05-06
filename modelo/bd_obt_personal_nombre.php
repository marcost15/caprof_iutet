<?php
function bd_obt_personal_nombre($id = null)
{
	if($id==NULL)
	{
		return sql2array("SELECT id, nombre FROM personal ORDER BY id ASC");
	}
	else
	{
		return sql2value("SELECT nombre FROM personal WHERE id = $id LIMIT 1");
	}
}