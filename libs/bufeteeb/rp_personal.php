<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_personal.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$f1  = new formHandler('busqueda');
$f1 -> borderStart('Busqueda de personal');
$f1 -> textField('Texto a buscar','texto');
$f1 -> submitButton('Continuar');
$f1 -> borderStop();
$f1->onCorrect('procesar');

if (isset($_REQUEST['accion']))
{
	$accion=$_REQUEST['accion'];
	switch($accion)
	{
		case 'letra':
			$bufeteeb->assign('datos',bd_buscar_personal(1,$_REQUEST['letra']));
			break;
	}
}

function procesar($d)
{
	global $bufeteeb;
	$texto=$d['texto'];
	$bufeteeb->assign('datos',bd_buscar_personal(2,$texto));
	return false;
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
