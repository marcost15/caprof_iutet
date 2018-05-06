<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/funciones.php';
include './configs/fh3.php';
include './modelo/bd_lista_abogados.php';
include './modelo/bd_guardar_clientes.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if(!isset($_SESSION['usuario'])) {ir('login.php');}
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
$f1->textField('Cedula','id',FH_DIGIT, 15,8);
$f1->selectField('Nacionalidad','nacionalidad', $nacio, FH_NOT_EMPTY, true);
$f1->textField('Apellidos(s)','apellido',FH_STRING,40,30);
$f1->textField('Nombre(s)','nombre',FH_STRING,40,30);
$f1->textField('Domicilio','domicilio',FH_STRING,50,90);
$f1->selectField('Estado Civil','estadocivil',$estado,FH_NOT_EMPTY, true);
$f1->textField('Teléfono Fijo','telfij',_FH_DIGIT,15,11);
$f1->textField('Teléfono Movil','telmo',_FH_DIGIT,15,11);
$f1->textField('E-mail','correo',_FH_EMAIL, 50,50);
$f1->borderStart('Registro de clientes del Bufete Estrada Barrios');
$f1->CheckBox('Abogados disponibles','abogado',bd_lista_abogados(),FH_NOT_EMPTY, true);
$f1->borderStop();
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n");
$f1->submitButton('Registrar','registrar');
$f1->resetButton('Limpiar','limpiar'); 
$f1->borderStop();
$f1->onCorrect('proceso');
function proceso($d)
{
	$id=$d['id'];
	$n=sql2value("SELECT COUNT(*) FROM clientes WHERE id LIKE '$id'");
	if ($n==0)
	{
	bd_guardar_clientes($d);
	$_SESSION['mensaje']="Datos del cliente procesado correctamente";
	ir('registro_cliente.php');
	}
	else
	{
	$_SESSION['mensaje']="Este cliente ya existe por favor dirijase a la pantalla de modificar cliente";
	ir('registro_cliente.php');
	}
}
$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);