<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './modelo/bd_guardar_ente.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if(!isset($_SESSION['usuario'])) {ir('login.php');}
$tipo = array(
"0" => "- - Seleccione - -",
"PUBLICO" => "Publico",
"PRIVADO" => "Privado"
);
$f1=new formHandler('entes');
$f1->borderStart('Registro de Ente Jurídico');
$f1->textField('Nombre','nombre',FH_STRING, 50,80);
$f1->textField('Dirección','direccion',_FH_STRING,50,90);
$f1->selectField("Tipo de Ente", "tipo", $tipo,FH_NOT_EMPTY, true);
$f1->textField('Descripción','descripcion',_FH_STRING, 50,255);
$f1->textField('Teléfono Fijo','telfij',_FH_DIGIT,15,11);
$f1->textField('Otro Teléfono','otrotelf',_FH_DIGIT,15,11);
$f1->onCorrect('proceso');
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Registrar','registrar');
$f1->resetButton('Limpiar','limpiar'); 
$f1->borderStop();
function proceso($d)
{
   bd_guardar_ente($d);
   $_SESSION['mensaje']="Datos del Ente jurídico procesado correctamente";
   ir('registro_entes.php');
}
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();