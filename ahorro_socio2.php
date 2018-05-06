<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_obt_tipo_nomina.php';
include './phpExcelReader/Excel/reader.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('ahorro_socio2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$fecha_ini = $_REQUEST['fecha_ini']; 
$fecha_fin = $_REQUEST['fecha_fin']; 
$tipo = $_REQUEST['tipo']; 
$fecha_ini = f2f($_REQUEST['fecha_ini']); 
$fecha_fin = f2f($_REQUEST['fecha_fin']); 

$tipo_20 = $_REQUEST['tipo']; 
function f2f2($fecha){
   $f=explode('-',$fecha);
   return $f[2].'/'.$f[1].'/'.$f[0];
}
enviar_sql("DELETE FROM asociados_caprof;");
enviar_sql("DELETE FROM docentes_iutet; ");
enviar_sql("DELETE FROM nomina; ");

/////// nomina de iutet todos los docentes que le hicieron descuentos
$nominas_iutet = sql2array("SELECT id,nomb_arch,fecha_ini,fecha_fin FROM archivos WHERE tipo = 'UPT' AND (fecha_ini between '$fecha_ini' and '$fecha_fin') 
																			AND (fecha_fin between '$fecha_ini' and '$fecha_fin') AND tipo_id = '$tipo'");
																		
$z = 0;
foreach ($nominas_iutet as $m=>$n)
{
	$a = $nominas_iutet[$m]['nomb_arch'];																		
	$excel_reader = new Spreadsheet_Excel_Reader(); 
	$excel_reader->read("./upload/nominas_iutet/$a");
	$datos1 = $excel_reader->sheets[0]; 
	$numRows = $datos1['numRows'];
	for($i=6; $i<=$numRows; $i++)
	{
		$datos[$z]['cedulas'] = $excel_reader->sheets[0]['cells'][$i][2];
		if (isset($excel_reader->sheets[0]['cells'][$i][6]))
		{
			$datos[$z]['ahorro'] = $excel_reader->sheets[0]['cells'][$i][6];
		}
		$cedula = $datos[$z]['cedulas'];
		$exist = 0;
		//guarda docentes
		$exist = sql2value("SELECT COUNT(*) FROM docentes_iutet WHERE cedula = '$cedula'");
		if ($exist < 1)
		{
			enviar_sql("INSERT INTO docentes_iutet (cedula) 
					VALUES ('$cedula');");
		}
		$id_archivo = $nominas_iutet[$m]['id'];
		if (!empty($datos[$z]['ahorro']))
		{	
			$ahorro = $datos[$z]['ahorro'];
		}
		else
		{
			$ahorro = 0;
		}
		//guarda docentes en nomina
		$exist_arch = sql2value("SELECT COUNT(*) FROM nomina WHERE archivo_id = '$id_archivo'");
		if ($exist < 1)
		{
			enviar_sql("INSERT INTO nomina (id,archivo_id,ahorro,docente_id) 
					VALUES ('','$id_archivo','$ahorro','$cedula');");
		}
		$z = $z + 1;
	}
}

$datos_total = sql2array("SELECT docentes_iutet.cedula, nomina.ahorro FROM docentes_iutet INNER JOIN nomina ON nomina.docente_id = docentes_iutet.cedula
						WHERE nomina.ahorro > 0");
$fecha_ini1 = f2f2($fecha_ini);
$fecha_fin1 = f2f2($fecha_fin);
$tipo = bd_obt_tipo_nomina($tipo);

foreach ($datos_total as $g=>$t)
{
	$lista[$g] = array ($datos_total[$g]['cedula'],$fecha_ini1,$fecha_fin1,$datos_total[$g]['ahorro'],0);
}

$fp = fopen('./upload/archivos_figs/ahorro_socio'."$fecha_ini"."$fecha_fin"."$tipo".'.xls','w');
foreach ($lista as $campos) {
    fputcsv($fp, $campos);
}
fclose($fp);
$nombre_archivo = "ahorro_socio"."$fecha_ini"."$fecha_fin"."$tipo".".xls";
$fecha = date('Y-m-d');
$usuario = $_SESSION['usuario']['id'];

$n=sql2value("SELECT COUNT(*) FROM archivos WHERE nomb_arch LIKE '$nombre_archivo'");
if ($n==0)
{
	enviar_sql("INSERT INTO archivos (id,usuario,fecha,nomb_arch,fecha_ini,fecha_fin,tipo,tipo_id) 
	VALUES ('','$usuario','$fecha','$nombre_archivo','$fecha_ini','$fecha_fin','SISTEMA','$tipo_20');");
}

$smarty->assign('datos',$datos_total);
$smarty->assign('fecha_ini',$fecha_ini1);
$smarty->assign('fecha_fin',$fecha_fin1);
$smarty->assign('tipo',$tipo);
$smarty->assign('nombre_archivo',$nombre_archivo);
$smarty->disp();