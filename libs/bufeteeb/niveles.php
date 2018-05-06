<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_niveles.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$f1=new dbFormHandler('niveles');
$f1->setConnectionResource($link,'niveles','mysql');
$f1->borderStart('Agregar/Modificar Niveles');
$f1->textField('Nivel de Acceso al Sistema','nivel',FH_NOT_EMPTY);
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
    $_SESSION['mensaje']="Nivel de acceso procesado correctamente";
	ir('niveles.php');
}

$bufeteeb->assign('niveles',bd_obt_niveles());
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);