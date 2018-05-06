<?php
function bd_lista_niveles()
{
	return sql2opciones("SELECT id,nivel FROM niveles ORDER BY id DESC");
}