<?php
session_start();
$_SESSION=array();
session_destroy();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/funciones.php';
include './configs/fh3.php';
include './modelo/bd_verifica_login.php';
$f=new formHandler('login');
$f->setLanguage('es');
$f->addHTML(" <br />"."<div id='titulo'>INGRESO DE USUARIO</div>"."<td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f->textField('Login','usuario',FH_ALPHA_NUM,15,30);
$f->passField('Clave','contrasena',FH_STRING,15,30);
$f->submitButton('Aceptar','verificar');
//$f->addHTML("<br />"." <td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f->onCorrect('procesar');

function procesar($d)
{
	if($res=bd_verifica_login($d))
	{
		session_start();
		$_SESSION['usuario']=$res;
		ir('cargar_nomina.php');
	}
	else
	{   
		ir('negacion_usuario.php');
	}
}
$smarty->assign('f',$f->flush(true));
$smarty->disp();