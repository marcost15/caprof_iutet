<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_honorarios.php';
include './modelo/bd_guardar_honorario.php';

$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$f1=new formHandler('honorarios');
$f1->borderStart('Relación de Honorarios');
$f1->jsDateField('Fecha','fecha',FH_NOT_EMPTY,1,'m-y');
$f1->onCorrect('proceso');
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Continuar','registrar');
$f1->borderStop();

function proceso($d)
{
ir('rp_honorario_mensual.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
