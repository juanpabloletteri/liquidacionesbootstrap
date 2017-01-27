
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-12-2016 a las 13:59:59
-- Versión del servidor: 10.0.22-MariaDB
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u290379021_estac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eliminadas`
--

CREATE TABLE IF NOT EXISTS `eliminadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ingreso` date NOT NULL,
  `monto` int(11) NOT NULL,
  `operador` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `eliminadas`
--

INSERT INTO `eliminadas` (`id`, `empresa`, `ingreso`, `monto`, `operador`, `numero`) VALUES
(1, 'Cablevision', '2016-12-21', 0, 'cecilia', '0'),
(2, 'Cablevision', '2016-12-21', 52, 'cecilia', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(50) NOT NULL,
  `grupo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` float NOT NULL,
  `operador` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `empresa`, `grupo`, `fecha`, `monto`, `operador`, `numero`) VALUES
(41, 'Telecom', 3, '2016-11-09', 18894.2, 'cecilia', '0'),
(40, 'Telecom', 3, '2016-11-09', 18894.2, 'cecilia', '0'),
(3, 'EdesurMantenimiento', 1, '2016-10-19', 73149, 'migracion', '0'),
(47, 'Cablevision', 3, '2016-12-21', 51853, 'cecilia', '0'),
(6, 'EdesurMantenimiento', 1, '2016-11-04', 92436, 'migracion', '0'),
(7, 'Telefonica', 3, '2016-10-14', 2209, 'migracion', '0'),
(13, 'Telmex', 3, '2016-08-31', 2027, 'migracion', '0'),
(15, 'Cosugas', 2, '2016-10-19', 59662, 'migracion', '0'),
(16, 'Cosugas', 2, '2016-10-19', 66816, 'migracion', '0'),
(12, 'Telefonica', 3, '2016-11-30', 4676.75, 'migracion', '0'),
(17, 'Cosugas', 2, '2016-10-19', 85924, 'migracion', '0'),
(18, 'Cosugas', 2, '2016-10-19', 85440, 'migracion', '0'),
(19, 'Cosugas', 2, '2016-10-19', 95042, 'migracion', '0'),
(20, 'Cosugas', 2, '2016-10-19', 83601, 'migracion', '0'),
(21, 'Cosugas', 2, '2016-10-19', 78727, 'migracion', '0'),
(22, 'Cosugas', 2, '2016-10-19', 58830, 'migracion', '0'),
(23, 'Cosugas', 2, '2016-10-19', 108962, 'migracion', '0'),
(24, 'EmaServicios', 2, '2016-12-01', 26240, 'migracion', '0'),
(36, 'Inarteco', 2, '2016-12-06', 44632.8, 'dnoriega', '0'),
(37, 'Cosugas', 2, '2016-12-12', 50055.7, 'dnoriega', '0'),
(34, 'Inarteco', 2, '2016-12-06', 50589.9, 'dnoriega', '0'),
(35, 'Inarteco', 2, '2016-12-06', 44994.9, 'dnoriega', '0'),
(39, 'Cablevision', 3, '2016-12-05', 28353, 'cecilia', '0'),
(43, 'Cablevision', 3, '2016-12-13', 13665.5, 'cecilia', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `histlogin`
--

CREATE TABLE IF NOT EXISTS `histlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `ingreso` datetime NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `histlogin`
--

INSERT INTO `histlogin` (`id`, `usuario`, `ingreso`, `pass`) VALUES
(1, 'juan pablo', '2016-12-22 03:31:31', '31192'),
(2, 'juan pablo', '2016-12-22 03:33:45', '31192'),
(3, 'juan pablo', '2016-12-22 04:01:54', '3119231192'),
(4, 'juan pablo', '2016-12-22 04:02:01', '31192'),
(5, 'juan pablo', '2016-12-22 04:36:10', '31192'),
(6, 'juan pablo', '2016-12-22 11:54:52', '31192'),
(7, 'juan pablo', '2016-12-22 17:10:42', '31192'),
(8, 'juan pablo', '2016-12-23 12:54:53', '31192'),
(9, 'juan pablo', '2016-12-25 20:49:04', '31192'),
(10, 'juan pablo', '2016-12-26 12:50:10', '31192'),
(11, 'dnoriega', '2016-12-27 13:51:17', 'Dsn3344409'),
(12, 'juan pablo', '2016-12-27 13:59:10', '31192');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `histloginfail`
--

CREATE TABLE IF NOT EXISTS `histloginfail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(50) NOT NULL,
  `ingreso` date NOT NULL,
  `monto` int(11) NOT NULL,
  `operador` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `empresa`, `ingreso`, `monto`, `operador`, `numero`) VALUES
(1, 'Cablevision', '2016-10-11', 31290, 'cecilia', '0'),
(2, 'Cablevision', '2016-10-11', 31290, 'cecilia', '0'),
(3, 'Cablevision', '2016-10-11', 16603, 'cecilia', '0'),
(4, 'Cablevision', '2016-10-11', 34165, 'cecilia', '0'),
(12, 'Cablevision', '2016-12-05', 28, 'cecilia', '0'),
(13, 'EdesurAlta', '2016-10-20', 32789, 'cecilia', '0'),
(14, 'EdesurAlta', '2016-09-05', 71639, 'cecilia', '0'),
(16, 'EdesurMediaBaja', '2016-12-14', 338802, 'dnoriega', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `admin`) VALUES
(0, 'juan pablo', '31192', 1),
(1, 'dnoriega', 'Dsn3344409', 0),
(2, 'smaffione', 'Leon52195', 0),
(3, 'cecilia', '123', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
