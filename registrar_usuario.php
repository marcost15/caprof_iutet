<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_personal.php';
include './modelo/bd_lista_niveles.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('registrar_usuario.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$nivel = bd_lista_niveles();
$f1=new FormHandler('usuario',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->addHTML(" <br />"."<div id='titulo'>AGREGAR USUARIO</div>"."<td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f1->textField($star.'Nombre y Apellido','nombre',FH_STRING,40,50,"onkeyup=\"usuario.nombre.value=usuario.nombre.value.toUpperCase();\"");
$f1->textField($star.'Correo Electrónico','correo',FH_EMAIL,30,50,"onkeyup=\"usuario.nombre.value=usuario.nombre.value.toUpperCase();\"");
$f1->textField($star.'Usuario','login',FH_STRING,15,20);
$f1->passField($star."Clave", "clave",FH_PASSWORD,15,20);
$f1->passField($star."Confirmar Clave", "clave2",FH_PASSWORD,15,20);
$f1->checkPassword("clave","clave2");
$f1->selectField($star."Nivel de Acceso", "nivel",$nivel,FH_NOT_EMPTY,true);
$f1->addLine($star ." = Campos Requeridos Obligatoriamente");
$f1->setMask(
  " <tr>\n".
   "   <td> </td>\n".
   "   <td> </td>\n".
   "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Registrar','registrar');
$f1->resetButton();
$f1->addHTML("<br />"." <td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f1->onCorrect("procesar");

function procesar($d)
{
	$login=$d['login'];
	$n=sql2value("SELECT COUNT(*) FROM usuarios WHERE login LIKE '$login'");
	if ($n==0)
	{
		bd_guardar_personal($d);
		$_SESSION['mensaje']="USUARIO REGISTRADO CORRECTAMENTE";	
		ir('registrar_usuario.php');
	}
	else
	{
		$_SESSION['mensaje']="EL LOGIN YA EXISTE, POR FAVOR INTRODUZCA UNO NUEVO";
		return false;
	}
}
$smarty->assign('f1',$f1->flush(true));
$smarty->disp();
unset($_SESSION['mensaje']);