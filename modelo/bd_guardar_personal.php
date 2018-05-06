<?php
function bd_guardar_personal($d)
{
	enviar_sql("INSERT INTO usuarios (id,nombre,correo,login,password,nivel_id,estado)
	VALUES ('','$d[nombre]','$d[correo]','$d[login]',MD5('$d[clave]'),'$d[nivel]','ACTIVO');");
}