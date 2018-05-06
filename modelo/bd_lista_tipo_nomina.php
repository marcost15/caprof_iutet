<?php
function bd_lista_tipo_nomina()
{
	return sql2opciones("SELECT id,nombre FROM tipo_nomina ORDER BY id ASC");
}