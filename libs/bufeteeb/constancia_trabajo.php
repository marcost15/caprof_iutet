<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$f1 = new formHandler('documentos');
$f1->borderStart('Registro de Documentos');
$f1->textField("Cliente", "cliente_id", FH_DIGIT,15,15,"onClick=\"window.open('ventana_clientes.php','sopa','fullscreen');\"");
$f1->textField("", "cliente_nombre", FH_STRING,40,40);
$f1->HiddenField("personal_id",$_SESSION['usuario']['id']);
$f1 -> submitButton('Continuar');
$f1 -> borderStop();
$f1->onCorrect('proceso');

function proceso($d)
{    
    bd_guardar_documento($d); 
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);