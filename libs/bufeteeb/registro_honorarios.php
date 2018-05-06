<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_lista_tipo_honorarios.php';
include './modelo/bd_guardar_honorario.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$xcolabog = array(
"1" => "Si",
"2" => "No"
);

function validafecha($fecha)
{
	$hoy=date('Y-m-d');
	$hoy=explode('-',$hoy);
	$hoy=$hoy[0]*10000+$hoy[1]*100+$hoy[2];
	$fecha=explode('-',$fecha);
	$fecha=$fecha[2]*10000+$fecha[1]*100+$fecha[0];
	if ($hoy<$fecha)
	{
		return 'Revise la fecha';
	}	
	return true;
}

$f1=new formHandler('honorarios');
$f1->borderStart('Registro de Honorarios');
$f1->jsDateField('Fecha','fecha','validafecha');
$f1->textField('Honorario','precioserv',FH_FLOAT,10,10);
$f1->selectField('Tipo de honorario','tipohonorario_id',bd_lista_tipo_honorarios(),FH_NOT_EMPTY, true);
$f1->RadioButton("% Colegio de Abogado", "xcolabog", $xcolabog,FH_NOT_EMPTY);
$f1->HiddenField("personal_id",$_SESSION['usuario']['id']);
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
{  $d['fecha'] = f2f($d['fecha']);
   bd_guardar_honorario($d);
   $_SESSION['mensaje']="Datos del Honorario procesado correctamente";
   ir('registro_honorarios.php');
}
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);