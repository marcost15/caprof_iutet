<?php
session_start();
include './configs/funciones.php';
include './configs/bd.php';
include './modelo/bd_recordatorios_eliminar.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

bd_recordatorios_eliminar($_REQUEST['id']);
ir('general.php');

