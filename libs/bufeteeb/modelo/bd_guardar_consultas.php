<?php
function bd_guardar_consultas($d)
{
   enviar_sql("INSERT INTO consultas (id,cliente_id,fecha,asunto,tipoconsul,apellidonombre,correo,personal_id)
   VALUES ('','$d[cliente_id]','$d[fecha]','$d[asunto]','$d[tipoconsul]','','','$d[personal_id]')");

    if($d[precioserv])
    {
		enviar_sql("INSERT INTO honorarios (id,personal_id,xcolabog,precioserv,fecha,tipohonorario_id)
		VALUES ('','$d[personal_id]','','$d[precioserv]','$d[fecha]','$d[tipohonorario_id]');");
    }
 }