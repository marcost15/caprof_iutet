<?php
function bd_lista_tipo_documentos()
{
	return sql2opciones("SELECT id,nombre FROM tipo_documentos ORDER BY id DESC");
}