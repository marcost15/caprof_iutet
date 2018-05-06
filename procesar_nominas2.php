<?php
session_start();
include './configs/funciones.php';
include './configs/smarty.php';
include './configs/bd.php';
include './configs/bdfh3.php';
include './modelo/bd_obt_tipo_nomina.php';
include './modelo/bd_verificar_privilegios.php';
include './phpExcelReader/Excel/reader.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('procesar_nominas2.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

function f2f2($fecha){
   $f=explode('/',$fecha);
   return $f[2].'-'.$f[1].'-'.$f[0];
}

$fecha_ini = $_REQUEST['fecha_ini']; 
$fecha_fin = $_REQUEST['fecha_fin']; 
$tipo = $_REQUEST['tipo']; 
$fecha_ini = f2f($_REQUEST['fecha_ini']); 
$fecha_fin = f2f($_REQUEST['fecha_fin']); 

enviar_sql("DELETE FROM asociados_caprof;");
enviar_sql("DELETE FROM docentes_iutet; ");
enviar_sql("DELETE FROM nomina; ");

/////// nomina de iutet todos los docentes que le hicieron descuentos
$nominas_iutet = sql2array("SELECT id,nomb_arch,fecha_ini,fecha_fin FROM archivos WHERE tipo = 'UPT' AND (fecha_ini between '$fecha_ini' and '$fecha_fin') 
																			AND (fecha_fin between '$fecha_ini' and '$fecha_fin') AND tipo_id = '$tipo'");
																			
$total_archivos = sql2value("SELECT COUNT(*) FROM archivos WHERE tipo = 'UPT' AND (fecha_ini between '$fecha_ini' and '$fecha_fin') 
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
		$datos[$z]['nacionalidad'] = $excel_reader->sheets[0]['cells'][$i][1];
		$datos[$z]['cedulas'] = $excel_reader->sheets[0]['cells'][$i][2];
		$datos[$z]['nombre'] = $excel_reader->sheets[0]['cells'][$i][3];
		$datos[$z]['cargo'] = $excel_reader->sheets[0]['cells'][$i][4];
		if (isset($excel_reader->sheets[0]['cells'][$i][5]))
		{
			$datos[$z]['sueldo'] = $excel_reader->sheets[0]['cells'][$i][5];
		}
		else
		{
			$datos[$z]['sueldo'] = 0;
		}
		if (isset($excel_reader->sheets[0]['cells'][$i][6]))
		{
			$datos[$z]['ahorro'] = $excel_reader->sheets[0]['cells'][$i][6];
		}
		else
		{
			$datos[$z]['ahorro'] = 0;
		}
		if (isset($excel_reader->sheets[0]['cells'][$i][7]))
		{
			$datos[$z]['aporte'] = $excel_reader->sheets[0]['cells'][$i][7];
		}
		else
		{
			$datos[$z]['aporte'] = 0;
		}
		$nac = $datos[$z]['nacionalidad'];
		$caracter =  substr("$nac",0, -9);
		$cedula15 = $datos[$z]['cedulas'];
		$contar_cedula = strlen($cedula15);
		if ($contar_cedula < 8)
		{
			$cedula = $caracter.' '.'0'.$datos[$z]['cedulas'];
		}
		else
		{
			$cedula = $caracter.' '.$datos[$z]['cedulas'];
		}
		$nombre = $datos[$z]['nombre'];
		$cargo = $datos[$z]['cargo'];
		$exist = 0;
		//guarda docentes
		$exist = sql2value("SELECT COUNT(*) FROM docentes_iutet WHERE cedula = '$cedula'");
		if ($exist < 1)
		{
			enviar_sql("INSERT INTO docentes_iutet (cedula,apell_nomb,cargo) 
					VALUES ('$cedula','$nombre','$cargo');");
		}
		$id_archivo = $nominas_iutet[$m]['id'];
		$sueldo = $datos[$z]['sueldo'];
		$ahorro = $datos[$z]['ahorro'];
		$aporte = $datos[$z]['aporte'];
		//guarda docentes en nomina
		$exist_arch = sql2value("SELECT COUNT(*) FROM nomina WHERE archivo_id = '$id_archivo'");
		if ($exist < 1)
		{
			enviar_sql("INSERT INTO nomina (id,archivo_id,sueldo,aporte_patronal,ahorro,docente_id) 
					VALUES ('','$id_archivo','$sueldo','$aporte','$ahorro','$cedula');");
		}
		$z = $z + 1;
	}
}

// carga los socios caprof
$socios = sql2array("SELECT id,nomb_arch,fecha_ini,fecha_fin FROM archivos WHERE tipo = 'CAPROF' AND (fecha_ini between '$fecha_ini' and '$fecha_fin') 
																			AND (fecha_fin between '$fecha_ini' and '$fecha_fin')");
$z = 0;
foreach ($socios as $m=>$n)
{
	$a = $socios[$m]['nomb_arch'];																		
	$excel_reader = new Spreadsheet_Excel_Reader(); 
	$excel_reader->read("./upload/nominas_caprof/$a");
	$datos1 = $excel_reader->sheets[0]; 
	$numRows = $datos1['numRows'];
	for($i=6; $i<=$numRows; $i++)
	{
		$datos_caprof[$z]['cedulas'] = $excel_reader->sheets[0]['cells'][$i][1];
		if (isset($excel_reader->sheets[0]['cells'][$i][7]))
		{
			$datos_caprof[$z]['fecha_ing'] = $excel_reader->sheets[0]['cells'][$i][7];
			$datos_caprof[$z]['fecha_ing'] = f2f2($datos_caprof[$z]['fecha_ing']);
			$fecha_ing = $datos_caprof[$z]['fecha_ing'];
		}
		else
		{
			$fecha_ing = "0000-00-00";
		}
		$cedula_caprof = $datos_caprof[$z]['cedulas'];
		$id_archivo_caprof = $socios[$m]['id'];
		//guarda todos los socios caprof
		enviar_sql("INSERT INTO asociados_caprof (cedula,fecha_ing,archivo_id) 
					VALUES ('$cedula_caprof','$fecha_ing','$id_archivo_caprof');");
		$z = $z + 1;
	}
}


// socios de caprof con sus aportes y ahorros
$datos_upt = sql2array("SELECT DISTINCT docentes_iutet.cedula, docentes_iutet.apell_nomb, docentes_iutet.cargo, nomina.sueldo, nomina.aporte_patronal, nomina.ahorro,
					asociados_caprof.fecha_ing
					FROM asociados_caprof INNER JOIN docentes_iutet ON docentes_iutet.cedula = asociados_caprof.cedula INNER JOIN nomina ON 
					docentes_iutet.cedula = nomina.docente_id INNER JOIN archivos ON archivos.id = nomina.archivo_id
					WHERE archivos.tipo_id = '$tipo' AND (fecha_ini between '$fecha_ini' and '$fecha_fin') AND (fecha_fin between '$fecha_ini' and '$fecha_fin')");

	
// tatalizadoir de socios caprof

$total['ahorro'] = 0;
$total['aporte_patronal'] = 0;

foreach ($datos_upt as $s=>$p)
{
	if ($datos_upt[$s]['ahorro'] == 0 OR  $datos_upt[$s]['aporte_patronal'] == 0)
	{
		$datos_upt[$s]['rojo'] = 'SI';
	}
	$datos_upt[$s]['fecha_ing'] = f2f($datos_upt[$s]['fecha_ing']);
	$total['ahorro'] = $total['ahorro'] + $datos_upt[$s]['ahorro'];
	$total['aporte_patronal'] = $total['aporte_patronal'] + $datos_upt[$s]['aporte_patronal'];
	$total['reg'] = count($datos_upt);
}


// NO SON SOCIOS de caprof con sus aportes y ahorros

$datos_nocaprof = sql2array("SELECT DISTINCT docentes_iutet.cedula, docentes_iutet.apell_nomb, docentes_iutet.cargo, nomina.sueldo, nomina.aporte_patronal, 
					nomina.ahorro FROM asociados_caprof RIGHT JOIN docentes_iutet ON docentes_iutet.cedula = asociados_caprof.cedula INNER JOIN nomina ON 
					docentes_iutet.cedula = nomina.docente_id INNER JOIN archivos ON archivos.id = nomina.archivo_id 
					WHERE archivos.tipo_id = '$tipo' AND asociados_caprof.cedula IS NULL AND (fecha_ini between '$fecha_ini' and '$fecha_fin') 
					AND (fecha_fin between '$fecha_ini' and '$fecha_fin') AND (nomina.aporte_patronal <> 0 OR nomina.ahorro <> 0)");

// tatalizadoir de no socios caprof

$total1['ahorro'] = 0;
$total1['aporte_patronal'] = 0;
foreach ($datos_nocaprof as $g=>$t)
{

	$total1['ahorro'] = $total1['ahorro'] + $datos_nocaprof[$g]['ahorro'];
	$total1['aporte_patronal'] = $total1['aporte_patronal'] + $datos_nocaprof[$g]['aporte_patronal'];
	$total1['reg'] = count($datos_nocaprof);
}

$total_reg = $total['reg'] + $total1['reg'];
$total_aportes = $total['aporte_patronal'] + $total1['aporte_patronal'];
$total_ahorro = $total['ahorro'] + $total1['ahorro'];
$total_general = $total_aportes + $total_ahorro;


$fecha = date('d-m-Y');
$fecha_ini1 = $_REQUEST['fecha_ini']; 
$fecha_fin1 = $_REQUEST['fecha_fin'];
$tipo = bd_obt_tipo_nomina($tipo);

$smarty->assign('tipo',$tipo);
$smarty->assign('datos',$datos_upt);
$smarty->assign('datos1',$datos_nocaprof);
$smarty->assign('total',$total);
$smarty->assign('total1',$total1);
$smarty->assign('total_reg',$total_reg);
$smarty->assign('total_aportes',$total_aportes);
$smarty->assign('total_ahorro',$total_ahorro);
$smarty->assign('total_general',$total_general);
$smarty->assign('total_archivos',$total_archivos);
$smarty->assign('fecha_ini',$fecha_ini1);
$smarty->assign('fecha_fin',$fecha_fin1);
$smarty->assign('fecha',$fecha);
$smarty->disp();
$_SESSION['data1']=array(
	'tipo'            => $tipo,
	'datos'           => $datos_upt,
	'datos1'          => $datos_nocaprof,
	'total'           => $total,
	'total1'          => $total1,
	'total_reg'       => $total_reg,
	'total_aportes'   => $total_aportes,
	'total_ahorro'    => $total_ahorro,
	'total_general'   => $total_general,
	'total_archivos'  => $total_archivos,
	'fecha_ini1'      => $fecha_ini1,
	'fecha_fin1'      => $fecha_fin1,
	'fecha'           => $fecha
);