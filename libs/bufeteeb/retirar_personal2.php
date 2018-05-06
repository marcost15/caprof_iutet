<?php
session_start();
include './configs/bd.php';
include './configs/funciones.php';
include './modelo/bd_retirar_personal.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

bd_retirar_personal($_REQUEST['id']);
$_SESSION['mensaje']="Personal retirado correctamente";
ir('consulta_personal.php');
