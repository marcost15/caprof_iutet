<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/funciones.php';
include './configs/fh3.php';
include './modelo/bd_lista_abogados.php';
include './modelo/bd_guardar_clientes.php';
include './modelo/bd_ficha_cliente.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if(!isset($_SESSION['usuario'])) {ir('login.php');}

$eb=bd_ficha_cliente($_REQUEST['id']);

$nacio = array (
"0" => "- - Seleccione - -",
"V" => "Venezolano(a)",
"E" => "Extranjero(a)"
);
$estado = array (
"0" => "- - Seleccione - -",
"S" => "Soltero(a)",
"C" => "Casado(a)",
"V" => "Viudo(a)",
"O" => "Otros"
);
$f1=new formHandler('clientes');
$f1->borderStart('Registro de clientes del Bufete Estrada Barrios');
$f1->HiddenField("id","id");
$f1->setValue('id', $eb['id']);
$f1->HiddenField("nacionalidad","nacionalidad");
$f1->setValue('nacionalidad', $eb['nacionalidad']);
$f1->textField('Apellidos(s)','apellido',FH_STRING,40,30);
$f1->setValue('apellido', $eb['apellido']);
$f1->textField('Nombre(s)','nombre',FH_STRING,40,30);
$f1->setValue('nombre', $eb['nombre']);
$f1->textField('Domicilio','domicilio',FH_STRING,50,90);
$f1->setValue('domicilio', $eb['domicilio']);
$f1->selectField('Estado Civil','estadocivil',$estado,FH_NOT_EMPTY, true);
$f1->setValue('estadocivil', $eb['estadocivil']);
$f1->textField('Teléfono Fijo','telfij',_FH_DIGIT,15,11);
$f1->setValue('telfij', $eb['telfij']);
$f1->textField('Teléfono Movil','telmo',_FH_DIGIT,15,11);
$f1->setValue('telmo', $eb['telmo']);
$f1->textField('E-mail','correo',_FH_EMAIL, 50,50);
$f1->setValue('correo', $eb['correo']);
$f1->borderStart('Registro de clientes del Bufete Estrada Barrios');
$f1->CheckBox('Abogados disponibles','abogado',bd_lista_abogados(),FH_NOT_EMPTY, true);
$f1->borderStop();
$f1->submitButton('Modificar','modificar');
$f1->borderStop();
$f1->onCorrect('proceso');
function proceso($d)
{
	bd_guardar_clientes($d);
	ir('consulta_clientes.php');
}
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);
