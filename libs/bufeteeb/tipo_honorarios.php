<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_tipo_honorarios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$f1=new dbFormHandler('tipo_honorarios');
$f1->setConnectionResource($link,'tipo_honorarios','mysql');
$f1->borderStart('Agregar/Modificar Tipos de Honorarios');
$f1->textField('Tipo de Honorario','descripcion',FH_NOT_EMPTY);
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
  $_SESSION['mensaje']="Tipo de Honorario procesado correctamente";
	ir('tipo_honorarios.php');
}

$bufeteeb->assign('tipo_honorarios',bd_obt_tipo_honorarios());
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);