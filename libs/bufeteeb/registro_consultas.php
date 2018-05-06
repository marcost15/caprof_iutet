<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_guardar_consultas.php';
include './modelo/bd_lista_tipo_honorarios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

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
$f1->textField("Cliente", "cliente_id", FH_DIGIT,15,8,"onClick=\"window.open('ventana_clientes.php','sopa','fullscreen');\"");
$f1->textField("", "cliente_nombre", FH_STRING,40,40);
$f1->jsDateField('Fecha de Consulta','fecha','validafecha');
$f1->textarea('Asunto','asunto',FH_STRING,40,3);
$f1->setMaxLength("asunto", 255);
$f1->HiddenField("personal_id",$_SESSION['usuario']['id']);
$f1->HiddenField("tipoconsul","PRIVADA");
$f1->borderStart('Datos del Honorario');
$f1->selectField('Tipo de Honorario','tipohonorario_id',bd_lista_tipo_honorarios());
$f1->textField('Costo','precioserv',_FH_FLOAT,10,10);
$f1->borderStop();
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
$f1->onCorrect('proceso');

function proceso($d)
{   
    $d['fecha'] = f2f($d['fecha']);
	bd_guardar_consultas($d);
	$_SESSION['mensaje']="Datos de la consulta procesado correctamente";
	ir('registro_consultas.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);
