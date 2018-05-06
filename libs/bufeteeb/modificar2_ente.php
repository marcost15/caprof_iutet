<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './modelo/bd_buscar_ente.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);

if(!isset($_SESSION['usuario'])) {ir('login.php');}
if (isset($_REQUEST['pos']))
  $inicio=$_REQUEST['pos'];
else $inicio=0;
$delta=$_SESSION['ini']['global']['delta'];
$n=sql2value("SELECT COUNT(*) FROM entes");
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
$bufeteeb->assign('datos',bd_buscar_ente($_REQUEST['li']));
$bufeteeb->disp();