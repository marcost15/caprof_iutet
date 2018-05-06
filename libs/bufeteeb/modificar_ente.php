<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './modelo/bd_ficha_ente.php';
include './modelo/bd_modificar_ente.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])){ir('login.php');}

$tipo = array(
"0" => "- - Seleccione - -",
"PUBLICO" => "Publico",
"PRIVADO" => "Privado"
);
$eb=bd_ficha_ente($_REQUEST['id']);

$f1=new formHandler('entes');
$f1->borderStart('Modificar de Ente Jurídico');
$f1->HiddenField("id","id");
$f1->setValue('id', $eb['id']);
$f1->textField('Nombre','nombre',FH_STRING, 50,80);
$f1->setValue('nombre', $eb['nombre']);
$f1->textField('Dirección','direccion',_FH_STRING,50,90);
$f1->setValue('direccion', $eb['direccion']);
$f1->selectField("Tipo de Ente", "tipo", $tipo,FH_NOT_EMPTY, true);
$f1->setValue('tipo', $eb['tipo']);
$f1->textField('Descripción','descripcion',_FH_STRING, 50,255);
$f1->setValue('descripcion', $eb['descripcion']);
$f1->textField('Teléfono Fijo','telfij',_FH_DIGIT,15,11);
$f1->setValue('telfij', $eb['telfij']);
$f1->textField('Otro Teléfono','otrotelf',_FH_DIGIT,15,11);
$f1->setValue('otrotelf', $eb['otrotelf']);
$f1->onCorrect('proceso');

$f1->submitButton('Modificar','modificar');
$f1->borderStop();

function proceso($d)
{
   bd_modificar_ente($d);
   ir('consulta_ente.php');
}
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();