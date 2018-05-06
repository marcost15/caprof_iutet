<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_buscar_documentos.php';

$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}

$d[id] = $_SESSION['usuario']['id'];
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM documentos WHERE documentos.personal_id = '$d[id]'");
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
$bufeteeb->assign('n',$n);
$bufeteeb->assign('indice',$indice);
$bufeteeb->assign('datos',bd_buscar_documentos($_REQUEST['li'],$d));
$bufeteeb->disp();