<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_lista_niveles.php';
include './modelo/bd_guardar_personal.php';
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

$f1=new formHandler('registro_personal');
$f1->borderStart('Registro del Personal Bufete Estrada Barrios');
$f1->textField('Cedula','id',FH_DIGIT, 15,8);
$f1->textField('Ipsa','ipsa',FH_STRING, 15,10);
$f1->textField('Apellido(s)','apellido',FH_STRING,40,30);
$f1->textField('Nombre(s)','nombre',FH_STRING,40,30);
$f1->textField('Domicilio','domicilio',FH_STRING,50,90);
$f1->textField('Teléfono Fijo','telfij',_FH_DIGIT,15,11);
$f1->textField('Teléfono Movil','telfmo',_FH_DIGIT,15,11);
$f1->textField('E-mail','correo',_FH_EMAIL, 50,50);
$f1->jsDateField('Fecha de Ingreso','fechaingreso','validafecha');
$f1->selectField("Tipo de Acceso", "acceso", bd_lista_niveles(),FH_NOT_EMPTY);
$f1->textField('Login','usuario',FH_STRING,20,30);
$f1->passField('Clave','contrasena',FH_PASSWORD,15,30);
$f1->passField('Confirmar Clave','re_clave',FH_PASSWORD,15,30);
$f1->checkPassword("contrasena", "re_clave");
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
   $id=$d['id'];
	$n=sql2value("SELECT COUNT(*) FROM personal WHERE id LIKE '$id'");
	if ($n==0)
	{
		$d['fecha'] = f2f($d['fechaingreso']);
		bd_guardar_personal($d);
		$_SESSION['mensaje']="Datos del Personal procesado correctamente";
		ir('registro_personal.php');
	}
	else
	{
		$_SESSION['mensaje']="Este registro ya existe por favor dirijase a la pantalla de modificar personal";
		ir('registro_personal.php');
	}
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
unset($_SESSION['mensaje']);