-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2014 a las 21:56:20
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `capro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE IF NOT EXISTS `archivos` (
`id` int(6) NOT NULL,
  `usuario` int(6) NOT NULL,
  `fecha` date NOT NULL,
  `nomb_arch` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `tipo` enum('UPT','CAPROF','SISTEMA') COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_id` int(6) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `usuario`, `fecha`, `nomb_arch`, `fecha_ini`, `fecha_fin`, `tipo`, `tipo_id`) VALUES
(1, 1, '2014-11-27', 'AUXILIAR DOCENTE CONTRATADO PNF MASCULINO.xls', '2014-11-27', '2014-11-27', 'UPT', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociados_caprof`
--

CREATE TABLE IF NOT EXISTS `asociados_caprof` (
  `cedula` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ing` date NOT NULL,
  `archivo_id` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_iutet`
--

CREATE TABLE IF NOT EXISTS `docentes_iutet` (
  `cedula` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `apell_nomb` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE IF NOT EXISTS `niveles` (
`id` int(6) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'CAPROF'),
(3, 'UPTT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE IF NOT EXISTS `nomina` (
`id` int(6) NOT NULL,
  `archivo_id` int(6) NOT NULL,
  `sueldo` float NOT NULL,
  `aporte_patronal` float NOT NULL,
  `ahorro` float NOT NULL,
  `docente_id` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE IF NOT EXISTS `privilegios` (
`id` int(6) NOT NULL,
  `pagina` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nivel_id` int(11) NOT NULL,
  `acceso` enum('CONCEDER','DENEGAR') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`id`, `pagina`, `nivel_id`, `acceso`) VALUES
(1, 'ahorro_socio.php', 1, 'CONCEDER'),
(2, 'ahorro_socio2.php', 1, 'CONCEDER'),
(3, 'aporte_patronal.php', 1, 'CONCEDER'),
(4, 'aporte_patronal2.php', 1, 'CONCEDER'),
(5, 'cambiar_clave.php', 1, 'CONCEDER'),
(6, 'cargar_nomina.php', 1, 'CONCEDER'),
(7, 'cargar_socio.php', 1, 'CONCEDER'),
(8, 'casiajax.php', 1, 'CONCEDER'),
(9, 'consmod_socio.php', 1, 'CONCEDER'),
(10, 'consmod_usuario.php', 1, 'CONCEDER'),
(11, 'index.php', 1, 'CONCEDER'),
(12, 'login.php', 1, 'CONCEDER'),
(13, 'modificar_usuario.php', 1, 'CONCEDER'),
(14, 'negacion_usuario.php', 1, 'CONCEDER'),
(15, 'niveles.php', 1, 'CONCEDER'),
(16, 'pdf_procesar_nominas2.php', 1, 'CONCEDER'),
(17, 'privilegios.php', 1, 'CONCEDER'),
(18, 'procesar_nominas.php', 1, 'CONCEDER'),
(19, 'procesar_nominas2.php', 1, 'CONCEDER'),
(20, 'registrar_usuario.php', 1, 'CONCEDER'),
(21, 'rp_cons_fecha.php', 1, 'CONCEDER'),
(22, 'rp_frm_archivos_fecha.php', 1, 'CONCEDER'),
(23, 'tipo_nomina.php', 1, 'CONCEDER'),
(24, 'cargar_nomina.php', 3, 'CONCEDER'),
(25, 'rp_cons_fecha.php', 3, 'CONCEDER'),
(26, 'rp_frm_archivos_fecha.php', 3, 'CONCEDER'),
(27, 'ahorro_socio.php', 2, 'CONCEDER'),
(28, 'ahorro_socio2.php', 2, 'CONCEDER'),
(29, 'aporte_patronal.php', 2, 'CONCEDER'),
(30, 'aporte_patronal2.php', 2, 'CONCEDER'),
(31, 'cambiar_clave.php', 2, 'CONCEDER'),
(32, 'cargar_nomina.php', 2, 'CONCEDER'),
(33, 'cargar_socio.php', 2, 'CONCEDER'),
(34, 'casiajax.php', 2, 'CONCEDER'),
(35, 'consmod_socio.php', 2, 'CONCEDER'),
(36, 'consmod_usuario.php', 2, 'CONCEDER'),
(37, 'index.php', 2, 'CONCEDER'),
(38, 'login.php', 2, 'CONCEDER'),
(39, 'modificar_usuario.php', 2, 'CONCEDER'),
(40, 'negacion_usuario.php', 2, 'CONCEDER'),
(41, 'niveles.php', 2, 'CONCEDER'),
(42, 'pdf_procesar_nominas2.php', 2, 'CONCEDER'),
(43, 'privilegios.php', 2, 'CONCEDER'),
(44, 'procesar_nominas.php', 2, 'CONCEDER'),
(45, 'procesar_nominas2.php', 2, 'CONCEDER'),
(46, 'registrar_usuario.php', 2, 'CONCEDER'),
(47, 'rp_cons_fecha.php', 2, 'CONCEDER'),
(48, 'rp_frm_archivos_fecha.php', 2, 'CONCEDER'),
(49, 'tipo_nomina.php', 2, 'CONCEDER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_nomina`
--

CREATE TABLE IF NOT EXISTS `tipo_nomina` (
`id` int(6) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_nomina`
--

INSERT INTO `tipo_nomina` (`id`, `nombre`) VALUES
(1, 'SUELDO BASE'),
(2, 'INCREMENTO 2015');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(6) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `login` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_spanish2_ci NOT NULL,
  `nivel_id` int(6) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `login`, `password`, `nivel_id`, `estado`) VALUES
(1, 'ADMINISTRADOR', 'admin@admin.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asociados_caprof`
--
ALTER TABLE `asociados_caprof`
 ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `docentes_iutet`
--
ALTER TABLE `docentes_iutet`
 ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_nomina`
--
ALTER TABLE `tipo_nomina`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `tipo_nomina`
--
ALTER TABLE `tipo_nomina`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
