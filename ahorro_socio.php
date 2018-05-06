<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
include './modelo/bd_lista_tipo_nomina.php';
if (bd_verificar_privilegios('ahorro_socio.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$f1=new FormHandler('personal',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->addHTML(" <br />"."<div id='titulo'>GENERAR ARCHIVO FIGS SOCIOS</div>"."<td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f1->jsDateField($star.'FECHA INICIAL NÓMINA','fecha_ini',FH_NOT_EMPTY,1,'d-m-y', "02:02");
$f1->jsDateField($star.'FECHA FINAL NÓMINA','fecha_fin',FH_NOT_EMPTY,1,'d-m-y', "02:02");
$f1->selectField($star."Tipo de Nomina", "tipo_id",bd_lista_tipo_nomina(),FH_NOT_EMPTY,true);
$f1->setMask(
     " <tr>\n".
     "   <td> </td>\n".
     "   <td> </td>\n".
     "   <td>%field% %field%</td>\n".
   " </tr>\n"
);
$f1->submitButton('Generar','generar');
$f1->resetButton();
$f1->addHTML("<br />"." <td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f1->onCorrect("procesar");

function procesar($d)
{
	$resp = comparafecha($d['fecha_ini'],$d['fecha_fin']);
	if ($resp == 1)
	{
		$_SESSION['mensaje']="LAS FECHAS NO PUEDE SER PROCESADA PORQUE LA DE INICIO ES MAYOR A LA DE FINAL";
		return false;
		ir("ahorro_socio.php");
	}
	else
	{
		$fecha_ini = $d['fecha_ini'];
		$fecha_fin = $d['fecha_fin'];
		$tipo = $d['tipo_id'];
		ir("ahorro_socio2.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&tipo=$tipo");
	}
}
$smarty->assign('f1',$f1->flush(true));
$smarty->disp();
unset($_SESSION['mensaje']);