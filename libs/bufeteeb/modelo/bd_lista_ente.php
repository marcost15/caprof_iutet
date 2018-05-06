<?php
function bd_lista_ente()
{
	return sql2opciones("SELECT id,nombre FROM entes ORDER BY id DESC");
}