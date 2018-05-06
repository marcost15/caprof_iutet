<?php
function bd_obt_niveles()
{
	return sql2array("SELECT id,nivel FROM niveles ORDER BY id DESC");
}