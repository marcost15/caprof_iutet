<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_tipo_documentos.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$f1=new dbFormHandler('tipo_documentos');
$f1->setConnectionResource($link,'tipo_documentos','mysql');
$f1->borderStart('Agregar/Modificar Tipos de Documentos');
$f1->textField('Tipo de Documento','nombre',FH_NOT_EMPTY);
$f1->submitButton('Continuar','continuar');
$f1->borderStop();
$f1->onSaved('mensaje');

function mensaje($id,$d)
{
  $_SESSION['mensaje']="Tipo de Documento procesado correctamente";
	ir('tipo_documentos.php');
}
$bufeteeb->assign('tipo_documentos',bd_obt_tipo_documentos());
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);