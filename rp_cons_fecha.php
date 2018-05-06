<?php
session_start();
include './configs/smarty.php';
include './configs/bd.php';
include './configs/fh3.php';
include './configs/funciones.php';
include './modelo/bd_verificar_privilegios.php';
include './modelo/bd_obt_tipo_nomina.php';
$_SESSION['ini']=parse_ini_file('./configs/config.ini',true);
if (bd_verificar_privilegios('rp_cons_fecha.php',$_SESSION['usuario']['nivel_id'])!='CONCEDER')
{
	ir('negacion_usuario.php');
}

$fecha_ini = $_REQUEST['fecha_ini']; 
$fecha_fin = $_REQUEST['fecha_fin']; 
$fecha_ini = f2f($_REQUEST['fecha_ini']);
$fecha_fin = f2f($_REQUEST['fecha_fin']); 

$archivos = sql2array("SELECT id,usuario,fecha,nomb_arch,fecha_ini,fecha_fin,tipo,tipo_id FROM archivos WHERE fecha BETWEEN '$fecha_ini' AND '$fecha_fin'");

foreach ($archivos as $i=>$c)
{
	$usuario_id = $archivos[$i]['usuario'];
	$archivos[$i]['usuario'] = sql2value("SELECT  nombre FROM usuarios WHERE id = '$usuario_id'");
	$archivos[$i]['fecha_ini'] = f2f($archivos[$i]['fecha_ini']);
	$archivos[$i]['fecha_fin'] = f2f($archivos[$i]['fecha_fin']);
	$archivos[$i]['fecha'] = f2f($archivos[$i]['fecha']);
	$archivos[$i]['tipo_id'] = bd_obt_tipo_nomina($archivos[$i]['tipo_id']);
}

if (isset($_REQUEST['accion']))
{
switch($_REQUEST['accion'])
{
	case 'eliminar':
	$id = $_REQUEST['id'];
	$fecha_ini = $_REQUEST['fecha_ini']; 
	$fecha_fin = $_REQUEST['fecha_fin']; 
	$creador = sql2value("SELECT usuario FROM archivos WHERE id = '$id'");
	$usu = $_SESSION['usuario']['id'];
	if ($creador == $usu)
	{
		enviar_sql("DELETE FROM archivos WHERE id = '$id'");
		ir("rp_cons_fecha.php?fecha_ini=$fecha_ini&fecha_fin=$fecha_fin");
	}
	{
		?>
			<script type="text/javascript">
			window.alert('NO TIENE LOS PERMISOS NECESARIOS PARA EJECUTAR ESTA ACCION');
			location.href='rp_frm_archivos_fecha.php';
			</script>
		<?php	
	}
}
}
$fecha_ini = f2f($fecha_ini);
$fecha_fin = f2f($fecha_fin); 
$smarty->assign('datos',$archivos);
$smarty->assign('fecha_ini',$fecha_ini);
$smarty->assign('fecha_fin',$fecha_fin);
$smarty->disp();