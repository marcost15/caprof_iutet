<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_honorarios.php';
include './modelo/bd_obt_tipo_honorarios.php';

$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$d[id] = $_SESSION['usuario']['id'];
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM honorarios WHERE honorarios.personal_id = '$d[id]'");
$indice=array();
$li=0;
while($li<$n)
{
	$ls=$li+$delta-1;
	if($ls>$n)
	{
		$ls=$n;
	}
	$indice[]=array('li'=>$li,'ls'=>$ls);
	$li=$ls+1;
}
$honorario = bd_buscar_honorarios($_REQUEST['li'],$d);
foreach ($honorario as $i=>$h)
{
	$honorario[$i]['tipo_honorario']=bd_obt_tipo_honorarios($h['tipohonorario_id']);
}
$bufeteeb->assign('n',$n);
$bufeteeb->assign('indice',$indice);
$bufeteeb->assign('datos',$honorario);
$bufeteeb->disp();