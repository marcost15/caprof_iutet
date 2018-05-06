<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_lista_tipo_honorarios.php';
include './modelo/bd_ficha_honorario.php';
include './modelo/bd_modificar_honorario.php';

$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$xcolabog = array(
"1" => "Si",
"2" => "No"
);

$eb=bd_ficha_honorario($_REQUEST['id']);

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
$f1->borderStart('Modificar de Honorarios');
$f1->HiddenField("id","id");
$f1->setValue('id', $eb['id']);
$f1->jsDateField('Fecha','fecha','validafecha');
$f=explode('-',$eb['fecha']);
$f=explode('-',$eb['fecha']);
$eb2= $f[0].'-'.$f[1].'-'.$f[2];
$f1->setValue('fecha',$eb2);
$f1->textField('Honorario','precioserv',FH_FLOAT,10,10);
$f1->setValue('precioserv', $eb['precioserv']);
$f1->selectField('Tipo de honorario','tipohonorario_id',bd_lista_tipo_honorarios(),FH_NOT_EMPTY, true);
$f1->setValue('tipohonorario_id', $eb['tipohonorario_id']);
$f1->RadioButton("% Colegio de Abogado", "xcolabog", $xcolabog,FH_NOT_EMPTY);
$f1->HiddenField("personal_id",$_SESSION['usuario']['id']);
$f1->onCorrect('proceso');
$f1->submitButton('Modificar','modificar');
$f1->borderStop();

function proceso($d)
{  $d['fecha'] = f2f($d['fecha']);
   bd_modificar_honorario($d);
   ir('consulta_honorarios.php');
}
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
