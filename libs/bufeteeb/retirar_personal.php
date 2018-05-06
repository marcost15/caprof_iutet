<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_ficha_personal.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$personal = bd_ficha_personal($_REQUEST['id']);
$personal[acceso] = sql2value("SELECT nivel FROM niveles WHERE id = '$personal[acceso]' LIMIT 1");

$bufeteeb->assign('ficha',$personal);
$bufeteeb->disp();