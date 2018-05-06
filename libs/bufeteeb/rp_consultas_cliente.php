<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_ficha_cliente.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if(!isset($_SESSION['usuario'])) {ir('login.php');}

$consulta = sql2array("SELECT fecha,asunto
						FROM consultas
						WHERE consultas.cliente_id = '$_REQUEST[id]'
						ORDER BY `fecha` DESC LIMIT 0 , 30");

$bufeteeb->assign('ficha',bd_ficha_cliente($_REQUEST['id']));
$bufeteeb->assign('datos',$consulta);
$bufeteeb->disp();