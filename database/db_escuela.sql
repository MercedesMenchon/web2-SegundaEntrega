-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 21:37:48
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `ndni` int(20) NOT NULL,
  `materia` varchar(20) NOT NULL,
  `anio_correspondiente` varchar(20) NOT NULL,
  `docente` varchar(100) NOT NULL,
  `calificacion` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `ndni`, `materia`, `anio_correspondiente`, `docente`, `calificacion`) VALUES
(42, 47654112, 'Cs.Sociales', '6', 'Lus Lopez', 5),
(44, 47619438, 'Prácticas del lengua', '3', 'Karen Figueroa', 5),
(45, 47654112, 'Ed. Física', '2', 'Santiago Luque', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `ndni` int(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `curso` int(10) NOT NULL,
  `division` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`ndni`, `nombre`, `direccion`, `telefono`, `curso`, `division`) VALUES
(35678999, 'Marcos Urrutia', 'Machado 444', '154687822', 3, 'A'),
(35775143, 'Laureano Hidalgo', '14 de julio 102', '154771803', 4, 'A'),
(38675890, 'Camila Sanchez', 'Marconi 563', '154664228', 5, 'B'),
(43544366, 'Camila Luciani', 'Arana 12', '154321156', 1, 'A'),
(43675112, 'Luz Quiñones', 'Mexico 554', '154985437', 4, 'B'),
(44558701, 'Lourdes Di Batista', 'Marconi 1653', '154664214', 1, 'A'),
(45678641, 'Roman Rodriguez', 'Rodriguez 234', '154672348', 5, 'B'),
(46717779, 'Sandra Lopez', 'Rodriguez 39', '154672348', 5, 'B'),
(47619438, 'Rodolfo Garcia', 'Sarmiento 1254', '154541233', 3, 'A'),
(47654112, 'Marcos Lopez', 'Garibaldi 541', '154008123', 4, 'A'),
(47876123, 'Mariana Fernandez', 'Montiel 719', '2345', 5, 'B'),
(47893115, 'Santiago Fernandez', 'Arana 564', '154886412', 3, 'A'),
(49876334, 'Mariela Fontana ', '9 de Julio 563', '154776423', 2, 'A'),
(50872534, 'Pedro Gutierrez', 'Derragueira 887', '154667127', 3, 'B'),
(54167238, 'Sandra Lopez', 'Machado 456', '154687822', 5, 'A'),
(54215778, 'Monica Garmendia', 'Alsina 445', '154991455', 2, 'A'),
(55208654, 'Gaston Rodriguez', 'Arana 1123', '154451129', 6, 'B'),
(55234987, 'Ramiro Figueroa', 'Juarez 403', '154687833', 6, 'A'),
(55418924, 'Silvestre Keegan', 'Guatemala 229', '154008156', 3, 'B'),
(56261744, 'Luciano Henderson', 'Marconi 665', '154003351', 5, 'B'),
(56334322, 'Rosario Hidalgo', 'San Martin 665', '154557143', 6, 'B'),
(56336667, 'Javier Hidalgo', 'San Martin 665', '154542667', 6, 'B'),
(56782345, 'Carla Romero', 'Mitre 554', '154443216', 5, 'B'),
(77777888, 'Camila Lezcano', 'Arana 12', '4555', 5, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'directivo@escuela.com', '$2a$12$Qn5PrMy6Eki0rJ.pmdPX8uDO.8KBjm5L9GF9loRFLGKmZSVbYhO9a'),
(2, 'profesor1@escuela.com', '$2a$12$/PLk36VZ4teN09FLaeY6/.kwWCnQ9HDj.saG4I5otiBgjswB8fPWu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NDNI` (`ndni`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`ndni`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`NDNI`) REFERENCES `estudiantes` (`NDNI`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
