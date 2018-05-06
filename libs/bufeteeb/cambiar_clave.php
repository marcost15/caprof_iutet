<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './modelo/bd_verifica_login.php';
include './modelo/bd_cambiar_clave.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$f1=new formHandler('modif_clave');
$f1->borderStart('Modificar clave');
$f1->passField('Clave actual','clave_actual',FH_STRING,15,30);
$f1->passField('Nueva clave','clave_nueva',FH_PASSWORD,15,30);
$f1->passField('Confirmar Clave','clave_conf',FH_PASSWORD,15,30);
$f1->checkPassword("clave_nueva", "clave_conf");
$f1->onCorrect('proceso');
$f1->setMask(
   " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Cambiar la clave','registrar');
$f1->borderStop();

function proceso($d)
{  
	$usuario=bd_verifica_login(array('usuario'=>$_SESSION['usuario']['usuario'],'contrasena'=>$d['clave_actual']));
	$d['usuario']=$usuario;
	$d['id']=$_SESSION['usuario']['id'];
	if(isset($usuario['id']))
	{
		 bd_cambiar_clave($d);
  		$_SESSION['mensaje']="Datos de la clave procesada correctamente";
	}
	else
	{
  		$_SESSION['mensaje']="Clave Actual Incorrecta verifique";
		
	}
		ir('cambiar_clave.php');
}

$bufeteeb->assign('f1',$f1->flush(true));
$bufeteeb->disp();
