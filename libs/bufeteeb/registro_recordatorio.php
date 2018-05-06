<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './modelo/bd_lista_abogados.php';
include './modelo/bd_guardar_recordatorio.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

$f1=new formHandler('recordatorio');
$f1->borderStart('Registro de Recordatorio');
$f1->selectField("Abogado", "personal_id", bd_lista_abogados(), FH_NOT_EMPTY, true);
$f1->jsDateField('Fecha','fecha');
$f1->timeField('Hora','hora');
$f1->textarea('Asunto','asunto',FH_TEXT,50,2);
$f1->setMaxLength("asunto", 255);
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
   $d['fecha'] = f2f($d['fecha']);
   bd_guardar_recordatorio($d);
   $_SESSION['mensaje']="Datos del Recordatorio procesado correctamente";
   ir('registro_recordatorio.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);