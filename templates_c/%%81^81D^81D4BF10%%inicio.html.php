<?php /* Smarty version 2.6.26, created on 2017-01-23 03:12:08
         compiled from inicio.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'inicio.html', 7, false),)), $this); ?>
<html>
	<head>
		<link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon" /> 
		<link rel="icon" href="./imagenes/favicon.ico" type="image/x-icon" /> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex,nofollow"/>
		<title><?php echo ((is_array($_tmp=@$this->_tpl_vars['title'])) ? $this->_run_mod_handler('default', true, $_tmp, "IUTET-CAPROF") : smarty_modifier_default($_tmp, "IUTET-CAPROF")); ?>
</title>
		<link rel="stylesheet" type="text/css" href="./estilo/layout.css"/> 
		<link rel="stylesheet" href="./estilo/tinydropdown.css" type="text/css" /><!-- Para el Menú -->
		<link rel="stylesheet" type="text/css" href="./estilo/cnc.css"/> 
		<link rel="stylesheet" type="text/css" href="./estilo/layoutprint.css" media="print"/>
		<script type="text/javascript" src="./js/domtableenhance.js"></script>
		<script type="text/javascript" src="../libreriasphp/FH3/FHTML/overlib/overlib.js"></script>
		<script type="text/javascript" src="./js/tinydropdown.js"></script><!-- Para el Menú -->
		<script type="text/javascript" src="../libreriasjs/sortable/sortable.js"></script>
		<script type="text/javascript" src="./js/jquery/jquery.min.js"></script><!-- Jquery -->
		<script type="text/javascript" src="./js/jquery/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" type="text/css" href="./js/jquery/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	</head> 
	<body topmargin="0">
		<div id = "fondo">
		<div id="cintillo" align="center"><img src="./imagenes/cintillo.jpg" width="1050" height="160"/></div>
		<div id="titulo" align="center"> <br/> SISTEMA INTEROPERABLE SUGAU- FIGS AHORROS </br> <?php if ($_SESSION['usuario']): ?> Usuario: <?php echo $_SESSION['usuario']['nombre']; ?>
<?php endif; ?></div><!-- titulo -->	<br/>
		 <?php if ($_SESSION['usuario']): ?>
			<div id="menu">
				<ul id="mimenu" class="mimenu">
					<li><a href="cargar_nomina.php">Cargar Nóminas</a></li>
					<li><a href="cargar_socio.php">Cargar Socios</a></li>
					<li><a href="procesar_nominas.php">Procesar Nóminas</a></li>
					<li><span>Archivos FIGS</span>
						<ul>
						    <li><a href="ahorro_socio.php">Ahorro Socio</a></li>
							<li><a href="aporte_patronal.php">Aporte Patronal</a></li>
						</ul>
					</li>
					<li><span>Consulta</span>
						<ul>
							<li><a href="rp_frm_archivos_fecha.php">Archivos</a></li>
						</ul>
					</li>
					<li><span>Usuario</span>
						<ul>
							<li><a href="registrar_usuario.php">Agregar</a></li>
							<li><a href="consmod_usuario.php">Consultar - Modificar</a></li>
							<li><a href="cambiar_clave.php">Cambiar Clave</a></li>
							<li><a href="./manual/manual.pdf">Ayuda</a></li>
						</ul>
					</li>
					<li><span>Admin BD</span>
						<ul>
							<li><a href="niveles.php">Niveles</a></li>
							<li><a href="privilegios.php">Privilegios</a></li>
							<li><a href="tipo_nomina.php">Tipos de Nomina</a></li>
						</ul>
					</li>
					</li>
					<li><a href="index.php">Salir</a></li>
				</ul>
			</div><!-- menudiv -->	
				<?php endif; ?>
			<?php echo '
			<script type="text/javascript">
				var dropdown=new TINY.dropdown.init("dropdown", {id:\'mimenu\', active:\'menuhover\'});
			</script>'; ?>

			<div id="contenido"><!-- Contenido -->