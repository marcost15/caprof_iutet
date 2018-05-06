<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_niveles.php';
include './modelo/bd_ficha_personal.php';
include './modelo/bd_guardar_personal.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$eb  = bd_ficha_personal($_REQUEST['id']);

function validafecha($fecha)
{
	$hoy=date('Y-m-d');
	$hoy=explode('-',$hoy);
	$hoy=$hoy[0]*10000+$hoy[1]*100+$hoy[2];
	$fecha=explode('-',$fecha);
	$fecha=$fecha[2]*10000+$fecha[1]*100+$fecha[0];
	if ($hoy<=$fecha)
	{
		return 'Revise la fecha';
	}	
	return true;
}

$f1=new formHandler('registro_personal');
$f1->borderStart('Registro del Personal Bufete Estrada Barrios');
$f1->HiddenField("id","id");
$f1->setValue('id', $eb['id']);
$f1->textField('Ipsa','ipsa',FH_STRING, 15,10);
$f1->setValue('ipsa', $eb['ipsa']);
$f1->textField('Apellido(s)','apellido',FH_STRING,40,30);
$f1->setValue('apellido', $eb['apellido']);
$f1->textField('Nombre(s)','nombre',FH_STRING,40,30);
$f1->setValue('nombre', $eb['nombre']);
$f1->textField('Domicilio','domicilio',FH_STRING,50,90);
$f1->setValue('domicilio', $eb['domicilio']);
$f1->textField('Teléfono Fijo','telfij',_FH_DIGIT,15,11);
$f1->setValue('telfij', $eb['telfij']);
$f1->textField('Teléfono Movil','telfmo',_FH_DIGIT,15,11);
$f1->setValue('telfmo', $eb['telfmo']);
$f1->textField('E-mail','correo',_FH_EMAIL, 50,50);
$f1->setValue('correo', $eb['correo']);
$f1->jsDateField('Fecha de Ingreso','fechaingreso','validafecha');
$f=explode('-',$eb['fechaingreso']);
$eb2= $f[0].'-'.$f[1].'-'.$f[2];
$f1->setValue('fechaingreso', $eb2);
$f1->selectField("Tipo de Acceso", "acceso", bd_lista_niveles(),FH_NOT_EMPTY);
$f1->setValue('acceso', $eb['acceso']);
$f1->onCorrect('proceso');
$f1->submitButton('Modificar','registrar');
$f1->borderStop();

function proceso($d)
{  
   $d['fecha'] = f2f($d['fechaingreso']);
   bd_guardar_personal($d);
   ir('modificar_personal.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();