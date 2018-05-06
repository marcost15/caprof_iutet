<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_ficha_cliente.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if(!isset($_SESSION['usuario'])) {ir('login.php');}

$documentos = sql2array("SELECT fecha,tipod_id,archivo,descripcion,ente_id
						FROM documentos
						WHERE cliente_id = '$_REQUEST[id]'
						ORDER BY `fecha` DESC LIMIT 0 , 30");
						
$documentos[tipod_id] = sql2value("SELECT nombre FROM tipo_documentos 
									WHERE id = '$documentos[tipod_id]' LIMIT 1");
$documentos[ente_id] = sql2value("SELECT nombre FROM entes
									WHERE id = '$documentos[ente_id]' LIMIT 1");
						
$consulta = sql2array("SELECT fecha,asunto
						FROM consultas
						WHERE consultas.cliente_id = '$_REQUEST[id]'
						ORDER BY `fecha` DESC LIMIT 0 , 30");

$bufeteeb->assign('ficha',bd_ficha_cliente($_REQUEST['id']));
$bufeteeb->assign('datos',$consulta);
$bufeteeb->assign('datos2',$documentos);
$bufeteeb->disp();