<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './modelo/bd_recordatorios_obtener.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$bufeteeb->assign('lista',bd_recordatorios_obtener($_SESSION['usuario']['id']));
$bufeteeb->disp();