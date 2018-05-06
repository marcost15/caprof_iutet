<?php /* Smarty version 2.6.14, created on 2007-06-11 05:38:20
         compiled from cabecera.html */ ?>
<html>
	<head>
	<link rel="shortcut icon" href="favicon.ico">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Bufete Estrada Barrios & Asociados</title>
	<style type="text/css">
		@import url('./estilo/layout.css');
		@import url('./estilo/layoutprint.css') print;
	</style>
	<!-- load the menu stylesheet -->
  <style type="text/css">@import url("../libreriasjs/hmenu/src/skin-bufete.css");</style>
  <!-- declare the menu location -->
  <script type="text/javascript">
	 _dynarch_menu_url = "../libreriasjs/hmenu/src/";
  </script>
    <!-- load the menu program file -->
    <script type="text/javascript" src="../libreriasjs/hmenu/src/hmenu.js"></script>
    <!-- [ ... ] your HEAD declarations here -->
	</head>
	<?php echo '<body onload="DynarchMenu.setup(\'menu\');">
<!-- following there\'s an workaround to hide the UL contents while the page is loading ;-) -->
<script type="text/javascript">//<![CDATA[
  document.writeln("<style type=\'text/css\'>#menu { display: none; }</style>");
//]]></script>
<!-- workaround to hide the UL contents while the page is loading ;-) -->'; ?>

		<div id="fondo">
			<div id="banner1"><img src="./imagenes/banner.png" width="728" height="90"/></div><!-- banner2 -->
			<div id="titulo">CLIENTES, PERSONAL & SERVICIOS v1.0  <?php if ($_SESSION['usuario']): ?>[Usuario: <?php echo $_SESSION['usuario']['nombre']; ?>
 <?php echo $_SESSION['usuario']['apellido']; ?>
]<?php endif; ?></div><!-- titulo -->		
			<div id="menudiv">
 			<ul id="menu"><td class="icon" style="-moz-user-select: none;">
				<?php if ($_SESSION['usuario']): ?>
					<li title="Salir"><a href="index.php">Salir [<?php echo $_SESSION['usuario']['usuario']; ?>
]</a></li>
				<?php else: ?>
					<li title="salir"><a href="index.php">SALIR</a></li>
 				<?php endif; ?>
				<?php if ($_SESSION['usuario']['acceso'] == 2 || $_SESSION['usuario']['acceso'] == 3): ?>
				<li title="Clientes">Clientes
				      <ul>
						<li title="Agregar Clientes"><img src="./iconos/agregar.ico" width="20px" height="22px"/><a href="registro_cliente.php">Agregar</a></li>
						<li><img src="./iconos/modificar.ico" width="20px" height="22px"/><a href="modificar2_clientes.php">Modificar</a></li>
						<li><img src="./iconos/buscar.ico" width="20px" height="22px"/><a href="consulta_clientes.php">Consultar</a></li>
					</ul>
				</li>
				<li title="Servicios">Servicios
					<ul>
						<li><img src="./iconos/consultas2.ico" width="18px" height="20px"/>Consultas
 							<ul>
							    <li title="Agregar Consulta"><img src="./iconos/agregar.ico" width="20px" height="22px"/><a href="registro_consultas.php">Agregar</a></li>
							    <li title="Modificar Consulta"><img src="./iconos/modificar.ico" width="20px" height="22px"/><a href="modificar2_consultas.php">Modificar</a></li>
 	  						    <li title="Consultar Consultas"><img src="./iconos/buscar.ico" width="20px" height="22px"/><a href="consulta_consultas.php">Consultar</a></li>
					            </ul>
						</li>
 						<li><img src="./iconos/documentos.ico" width="18px" height="20px"/>Documentos
 							<ul>
							    <li title="Registrar Documentos"><img src="./iconos/agregar.ico" width="20px" height="22px"/><a href="registro_documentos.php">Agregar</a></li>
							    <li title="Modificar Documentos"><img src="./iconos/modificar.ico" width="20px" height="22px"/><a href="modificar2_documentos.php">Modificar</a></li>
 	  						    <li title="Consultar Documentos"><img src="./iconos/buscar.ico" width="20px" height="22px"/><a href="consulta_documentos.php">Consultar</a></li>
					            </ul>
						</li>
						<li><img src="./iconos/recordatorios.ico" width="18px" height="20px"/>Recordatorios
 							<ul>
							    <li title="Registrar Recordatorios"><img src="./iconos/agregar.ico" width="20px" height="22px"/><a href="registro_recordatorio.php">Agregar</a></li>
 	  						    <li title="Modificar Recordatorios"><img src="./iconos/modificar.ico" width="20px" height="22px"/><a href="modificar2_recordatorio.php">Modificar</a></li>
								<li title="Consultar Recordatorios"><img src="./iconos/buscar.ico" width="20px" height="22px"/><a href="general.php">Consultar</a></li>
							</ul>
 						</li>
					</ul>
				</li>
				<li title="Entes Jurídicos">Entes Jurídicos
 					<ul>
					    <li title="Agregar Ente Jurídico"><img src="./iconos/agregar.ico" width="20px" height="22px"/><a href="registro_entes.php">Agregar</a></li>
					    <li title="Modificar Ente Jurídico"><img src="./iconos/modificar.ico" width="20px" height="22px"/><a href="modificar2_ente.php">Modificar</a></li>
 	  				    <li title="Consultar Ente Jurídico"><img src="./iconos/buscar.ico" width="20px" height="22px"/><a href="consulta_ente.php">Consultar</a></li>
					</ul>
				</li>
				<li title="Honorarios">Honorarios
 					<ul>
					    <li title="Agregar Honorario"><img src="./iconos/agregar.ico" width="20px" height="22px"/><a href="registro_honorarios.php">Agregar</a></li>
 	  				    <li title="Consultar Honorario"><img src="./iconos/buscar.ico" width="20px" height="22px"/><a href="consulta_honorarios.php">Consultar/Modificar</a></li>
					</ul>
				</li>
				<li title="Personal">Personal
					<ul>
						<li title="Agregar Personal"><img src="./iconos/agregar.ico" width="20px" height="22px"/><a href="registro_personal.php">Agregar</a></li>
						<li title="Agregar Personal"><img src="./iconos/modificar.ico" width="20px" height="22px"/><a href="modificar_personal.php">Modificar</a></li>
						<li title="Consulta de Personal"><img src="./iconos/buscar.ico" width="20px" height="22px"/><a href="consulta_personal.php">Consultar</a></li>
					</ul>
				</li>
				<li title="Reportes">Reportes
                    <ul>
						<li title="Constancia de Trabajo"><img src="./iconos/constancia.ico" width="20px" height="22px"/><a href="rp_personal.php">Constancia de Trabajo</a></li>
	                    <li title="Historial de Clientes"><img src="./iconos/clientes.ico" width="20px" height="22px"/><a href="rp_clientes.php">Historial de Clientes</a></li>
	                    <li title="Listado de Consultas por Clientes"><img src="./iconos/consultas.ico" width="20px" height="22px"/><a href="rp_clientes2.php">Listado de Consultas por Clientes</a></li>
                        <li title="Relación de Honararios"><img src="./iconos/money.ico" width="20px" height="22px"/><a href="rp_honorario.php">Relación de Honararios</a></li>
					</ul>
                        </li>
				<li title="Admin BD">Admin BD
					<ul>
						<li title="Tipos de Honorarios"><img src="./iconos/tipohonorario.ico" width="20px" height="22px"/><a href="tipo_honorarios.php">Tipo de Honorarios</a></li>
						<li title="Niveles de Acceso"><img src="./iconos/acceso.ico" width="20px" height="22px"/><a href="niveles.php">Niveles de Acceso</a></li>
                        <li title="Tipo de Documentos"><img src="./iconos/tipodocumentos.ico" width="20px" height="22px"/><a href="tipo_documentos.php">Tipos de Documentos</a></li> 
                        <li title="Cambiar Clave de Acceso"><img src="./iconos/cambiarclave.ico" width="20px" height="22px"/><a href="cambiar_clave.php">Cambiar Clave</a></li> 
					</ul>
				</li>
				<li title="Ayuda">Ayuda
 					<ul>
					    <li title="Manual de Usuario"><img src="./iconos/ayuda.ico" width="20px" height="22px"/><a href="manual de personal.pdf">Manual de Usuario</a></li>
					    <li title="Acerca de..."><img src="./iconos/acercade.ico" width="20px" height="22px"/><a href="swf/presentation/cdpresentation.swf">Acerca de...</a></li>
					</ul>
 				</li>
				<?php endif; ?>
			</ul>
			
			</div><!-- menudiv -->		
			<div id="contenido">
<!-- Contenido -->