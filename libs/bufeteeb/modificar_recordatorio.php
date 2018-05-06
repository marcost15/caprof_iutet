<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './modelo/bd_lista_abogados.php';
include './modelo/bd_buscar_recordatorio.php';
include './modelo/bd_modificar_recordatorio.php';

$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

$eb = bd_buscar_recordatorio($_REQUEST['id']);

$f1=new formHandler('recordatorio');
$f1->borderStart('Registro de Recordatorio');
$f1->HiddenField("id","id");
$f1->setValue('id', $eb['id']);
$f1->selectField("Abogado", "personal_id", bd_lista_abogados(), FH_NOT_EMPTY, true);
$f1->setValue('personal_id', $eb['personal_id']);
$f1->jsDateField('Fecha','fecha');
$f=explode('-',$eb['fecha']);
$eb2= $f[0].'-'.$f[1].'-'.$f[2];
$f1->setValue('fecha', $eb2);
$f1->timeField('Hora','hora');
$f1->setValue('hora', $eb['hora']);
$f1->textarea('Asunto','asunto',FH_TEXT,50,2);
$f1->setValue('asunto', $eb['asunto']);
$f1->setMaxLength("asunto", 255);
$f1->onCorrect('proceso');

$f1->submitButton('Modificar','modificar');
$f1->borderStop();

function proceso($d)
{  
   $d['fecha'] = f2f($d['fecha']);
   bd_modificar_recordatorio($d);
   ir('modificar2_recordatorio.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
