-- WFTW database schema (no user passwords or PII)
-- Import: mysql -u root -p wftw_db < database/schema.sql

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `catbeneficiario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `fechaAtendidos` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Beneficiarios del evento Wheels for the World';

CREATE TABLE IF NOT EXISTS `catroles` (
  `rolid` int(11) NOT NULL AUTO_INCREMENT,
  `catRolesDescripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`rolid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Estado de seccion/campaign';

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `rolid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rolid` (`rolid`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `catroles` (`rolid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Usuarios del sistema';

INSERT INTO `catroles` (`rolid`, `catRolesDescripcion`) VALUES
(1, 'Administrador'),
(2, 'Invitado'),
(3, 'Desactivado');

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Desactivado');

-- Dev bootstrap admin (plaintext until Stage 1 password hashing).
-- Change password immediately after first login in production.
INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `foto`, `rolid`) VALUES
(1, 'admin', 'changeme', '', 1);

COMMIT;
