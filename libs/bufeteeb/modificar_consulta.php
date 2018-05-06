<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_modificar_consulta.php';
include './modelo/bd_buscar_consulta.php';
include './modelo/bd_ficha_cliente.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$eb  = bd_buscar_consulta($_REQUEST['id']);
$eb2 = bd_ficha_cliente($eb['cliente_id']);
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

$f1=new formHandler('consulta');
$f1->borderStart('Registro de Consultas');
$f1->HiddenField("id","id");
$f1->setValue('id', $eb['id']);
$f1->textField("Cliente", "cliente_id", FH_DIGIT,15,8,"onClick=\"window.open('ventana_clientes.php','sopa','fullscreen');\"");
$f1->textField("", "cliente_nombre", FH_STRING,40,40);
$f1->setValue('cliente_id',$eb2['id']);
$f1->setValue('cliente_nombre', $eb2['apellido'].$eb2['nombre']);
$f1->jsDateField('Fecha de Consulta','fecha','validafecha');
$f=explode('-',$eb['fecha']);
$eb2= $f[0].'-'.$f[1].'-'.$f[2];
$f1->setValue('fecha', $eb2);
$f1->textarea('Asunto','asunto',FH_STRING,40,3);
$f1->setMaxLength("asunto", 255);
$f1->setValue('asunto', $eb['asunto']);
$f1->submitButton('Modificar','modificar');
$f1->borderStop();
$f1->onCorrect('proceso');

function proceso($d)
{   
    $d['fecha'] = f2f($d['fecha']);
	bd_modificar_consulta($d);
	ir('modificar2_consultas.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
