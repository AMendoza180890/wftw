-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2022 a las 00:11:45
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdwftw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catbeneficiario`
--

CREATE TABLE `catbeneficiario` (
  `id` int(11) NOT NULL,
  `nombreApellido` text DEFAULT NULL,
  `fnacimiento` date DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `celular` text DEFAULT NULL,
  `telefono` text DEFAULT NULL,
  `referencia` text DEFAULT NULL,
  `tipoMedio` text DEFAULT NULL,
  `estadoMedio` text DEFAULT NULL,
  `apoyoMedio` text DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `nombreTutor` text DEFAULT NULL,
  `cedula` text DEFAULT NULL,
  `parentesco` text DEFAULT NULL,
  `institucion` text DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `fechaBaja` date DEFAULT NULL,
  `fechaAtendidos` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla base de beneficiarios para evento de Joni and friends';

--
-- Volcado de datos para la tabla `catbeneficiario`
--

INSERT INTO `catbeneficiario` (`id`, `nombreApellido`, `fnacimiento`, `direccion`, `celular`, `telefono`, `referencia`, `tipoMedio`, `estadoMedio`, `apoyoMedio`, `diagnostico`, `foto`, `nombreTutor`, `cedula`, `parentesco`, `institucion`, `fechaCreacion`, `fechaBaja`, `fechaAtendidos`) VALUES
(1, 'Gerald Canales', '2000-02-05', 'Managua, Nicaragua', '81234567', '22651234', 'Ana Jarquin', 'Silla de Ruedas', 'Problema con Medidas', 'Total', 'diagnostico1', 'app/vista/img/beneficiario/b693.png', 'Daril Garcia', '001-234567-0007E', 'tio', NULL, '2022-04-23', NULL, '2022-04-26'),
(2, 'Marvin', '2016-01-07', 'Managua', '81234567', '227654321', 'Daril', 'No Tengo', 'No Tengo', 'No Aplica', 'diagnostico1', 'app/vista/img/beneficiario/b186.png', 'Juan Castellon', '001-01011993-0087L', 'padre', NULL, '2022-04-23', NULL, '2022-04-26'),
(3, 'Ana Maria Suarez', '2000-03-16', 'Managua, en el barrio de Managua', '81234567', '227654321', 'Allan Mendoza', 'No Tengo', 'No Tengo', 'No Aplica', 'diagnostico1', 'app/vista/img/beneficiario/b886.jpg', 'Juan Castellon', '001-01011993-0087L', 'padre', NULL, '2022-04-26', NULL, '2022-04-26'),
(4, 'Oliver Obed Laguna', '2000-03-16', 'Reparto Chick', '81234567', '12345678', 'Eydy Rizo', 'No Tengo', 'No Tengo', 'No Aplica', 'Sindrome Down', NULL, 'Patricia Hernandez', '001-01011993-0087L', 'tio', 'Asambleas de Dios', '2022-04-26', NULL, '2022-04-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catroles`
--

CREATE TABLE `catroles` (
  `rolid` int(11) NOT NULL,
  `catRolesDescripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `catroles`
--

INSERT INTO `catroles` (`rolid`, `catRolesDescripcion`) VALUES
(1, 'Administrador'),
(2, 'Invitado'),
(3, 'Desactivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='estado de la seccionCampaign';

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Desactivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `rolid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='estructura de tabla de usuario';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `foto`, `rolid`) VALUES
(1, 'admin', 'tesoros', '', 1),
(2, 'guest', 'tesoros', '', 2),
(3, 'MAdams', '123456', 'app/vista/img/usuario/U33.png', 3),
(4, 'Michelle', 'tesoros', 'app/vista/img/usuario/U525.jpg', 1),
(5, 'Vantol', 'Tesoros', 'app/vista/img/usuario/U728.jpg', 2),
(6, 'AIppel', 'Tesoros', 'app/vista/img/usuario/U367.png', 2),
(7, 'BVillalobos', 'Tesoros', '', 2),
(8, 'ESanchez', 'Tesoros', '', 2),
(9, 'Alexandra', 'Tesoros', '', 2),
(10, 'pamador', 'tesoros', '', 1),
(11, 'Wendy', 'tesoros', '', 2),
(12, 'Ajarquin', 'Tesoros123', '', 2),
(13, 'Mrosales', 'Tesoros456', '', 2),
(14, 'JennyA', 'Tesoros123', '', 2),
(15, 'MilenaS', 'Tesoros123', '', 2),
(16, 'AZuniga', 'AZuniga', '', 2),
(17, 'Thamara', '2808', '', 2),
(18, 'Eydy', 'tesoros2021', '', 2),
(19, 'Camryn', 'trustnGod3!+', '', 2),
(20, 'Alexandra', 'tesoros2021', '', 2),
(21, 'phernandez', 'tesoros', '', 2),
(22, 'IvaniaAndrade', 'tesoros123', '', 2),
(23, 'AMSuarez', 'tesoros123', '', 2),
(24, 'Lordian', 'tesoros123', '', 2),
(25, 'dgarcia', 'tesoros2', 'app/vista/img/usuario/U408.jpg', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catbeneficiario`
--
ALTER TABLE `catbeneficiario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `catroles`
--
ALTER TABLE `catroles`
  ADD PRIMARY KEY (`rolid`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rolid` (`rolid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catbeneficiario`
--
ALTER TABLE `catbeneficiario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `catroles`
--
ALTER TABLE `catroles`
  MODIFY `rolid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `catroles` (`rolid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
