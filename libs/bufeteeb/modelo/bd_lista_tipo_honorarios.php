<?php
function bd_lista_tipo_honorarios()
{
	return sql2opciones("SELECT id,descripcion FROM tipo_honorarios ORDER BY id DESC");
}