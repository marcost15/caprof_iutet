<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_ficha_documentos.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$documentos = bd_ficha_documentos($_REQUEST['id']);
$documentos[tipod_id] = sql2value("SELECT nombre FROM tipo_documentos 
									WHERE id = '$documentos[tipod_id]' LIMIT 1");
$documentos[ente_id] = sql2value("SELECT nombre FROM entes
									WHERE id = '$documentos[ente_id]' LIMIT 1");
$documentos[nombre] = sql2value("SELECT nombre FROM clientes
									WHERE id = '$documentos[cliente_id]' LIMIT 1");
$documentos[apellido] = sql2value("SELECT apellido FROM clientes
									WHERE id = '$documentos[cliente_id]' LIMIT 1");
									
$bufeteeb->assign('ficha',$documentos);
$bufeteeb->disp();