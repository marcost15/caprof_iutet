<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_lista_tipodocumentos.php';
include './modelo/bd_lista_ente.php';
include './modelo/bd_modificar_documentos.php';
include './modelo/bd_ficha_documentos.php';
include './modelo/bd_ficha_cliente.php';

$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

$eb=bd_ficha_documentos($_REQUEST['id']);
$eb2 = bd_ficha_cliente($eb[cliente_id]);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$cfg = array(
  "path"        => './uploads',
  "name"        => uniqid('bufeteeb'), 
  "required"    => true,
  "exists"      => "rename"
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
$f1 = new formHandler('documentos');
$f1->borderStart('Registro de Documentos');
$f1->HiddenField("id","id");
$f1->setValue('id', $eb['id']);
$f1->textField("Cliente", "cliente_id", FH_DIGIT,15,15,"onClick=\"window.open('ventana_clientes.php','sopa','fullscreen');\"");
$f1->textField("", "cliente_nombre", FH_STRING,40,40);
$f1->setValue('cliente_id',$eb2['id']);
$f1->setValue('cliente_nombre', $eb2['apellido'].$eb2['nombre']);
$f1->HiddenField("personal_id",$_SESSION['usuario']['id']);
$f1->jsDateField('Fecha del Documento','fecha','validafecha');
$f=explode('-',$eb['fecha']);
$f=explode('-',$eb['fecha']);
$eb2= $f[0].'-'.$f[1].'-'.$f[2];
$f1->setValue('fecha', $eb2);
$f1->selectField("Ente que lo Avala", "ente_id", bd_lista_ente(),FH_NOT_EMPTY,true);
$f1->setValue('ente_id', $eb['ente_id']);
$f1->selectField("Tipo de Documentos", "tipod_id", bd_lista_tipo_documentos(),FH_NOT_EMPTY);
$f1->setValue('tipod_id', $eb['tipod_id']);
$f1->textarea('Descripción','descripcion',FH_STRING,40,3);
$f1->setMaxLength("descripcion", 255);
$f1->setValue('descripcion', $eb['descripcion']);
$f1->uploadField("Seleccione el Documento", "archivo", $cfg);
$f1->setValue('archivo', $eb['archivo']);
$f1 -> submitButton('Modificar');
$f1 -> borderStop();
$f1->onCorrect('proceso');

function proceso($d)
{    
    $d['fecha'] = f2f($d['fecha']);
    bd_modificar_documento($d); 
    ir('modificar2_documentos.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);

