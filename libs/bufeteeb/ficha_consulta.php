<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_consulta.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$consultas = bd_buscar_consulta($_REQUEST['id']);
$consultas[nombre] = sql2value("SELECT nombre FROM clientes
									WHERE id = '$consultas[cliente_id]' LIMIT 1");
$consultas[apellido] = sql2value("SELECT apellido FROM clientes
									WHERE id = '$consultas[cliente_id]' LIMIT 1");
$bufeteeb->assign('ficha',$consultas);
$bufeteeb->disp();