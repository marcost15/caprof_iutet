<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_guardar_nomina_iutet.php';
include './modelo/bd_lista_tipo_nomina.php';
include './modelo/bd_verificar_privilegios.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('cargar_nomina.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}
$archivo = array(
      "path"      =>  './upload/nominas_iutet',
	  "type"      =>  "xlsx XLSX xls XLS rar RAR zip ZIP csv CSV",
      "required"  =>   true,
	  "exists"    =>   "overwrite" 
);

$f1=new FormHandler('personal',NULL,'onclick="highlight(event)"');
$f1->setLanguage('es');
$star = '<font color="blue">*</font>';
$f1->addHTML(" <br />"."<div id='titulo'>CARGAR NÓMINAS</div>"."<td colspan='3'><hr size='1' /></td>\n"." </tr>\n");
$f1->jsDateField($star.'FECHA INICIAL NÓMINA','fecha_ini',FH_NOT_EMPTY,1,'d-m-y', "02:02");
$f1->jsDateField($star.'FECHA FINAL NÓMINA','fecha_fin',FH_NOT_EMPTY,1,'d-m-y', "02:02");
$f1->uploadField($star.'ARCHIVO DE NOMINA', 'nomb_arch', $archivo);
$f1->selectField($star."Tipo de Nomina", "tipo_id",bd_lista_tipo_nomina(),FH_NOT_EMPTY,true);
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
	$resp = comparafecha($d['fecha_ini'],$d['fecha_fin']);
	if ($resp == 1)
	{
		$_SESSION['mensaje']="LAS FECHAS NO PUEDE SER PROCESADA PORQUE LA DE INICIO ES MAYOR A LA DE FINAL";
		return false;
	}	
	else
	{
		$nombre = $d['nomb_arch'];
		$fecha_ini = f2f($d['fecha_ini']);
		$fecha_fin = f2f($d['fecha_fin']);
		$exit = sql2value("SELECT count(nomb_arch) FROM archivos WHERE nomb_arch = '$nombre' AND fecha_ini = '$fecha_ini' AND fecha_fin = '$fecha_fin'");
		if ($exit == 0)
		{
			$d['fecha_ini'] = $fecha_ini;
			$d['fecha_fin'] = $fecha_fin;
			$d['usuario'] = $_SESSION['usuario']['id'];
			bd_guardar_nomina_iutet($d);
			$_SESSION['mensaje']="NOMINA UPTT-MBI REGISTRADA CORRECTAMENTE";
			ir('cargar_nomina.php');
		}
		else
		{
			$_SESSION['mensaje']="EL ARCHIVO YA FUE CARGADO POR FAVOR VERIFIQUE";
			return false;
		}
	}
}
$smarty->assign('f1',$f1->flush(true));
$smarty->disp();
unset($_SESSION['mensaje']);