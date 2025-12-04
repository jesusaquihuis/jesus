-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2025 a las 05:04:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confi`
--

CREATE TABLE `confi` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `youtube` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `confi`
--

INSERT INTO `confi` (`id`, `numero`, `facebook`, `youtube`) VALUES
(2, 123, 'dsds', 'sdsd'),
(3, 123, 'f', 'f'),
(4, 12345, 'dsds', 'sdsd'),
(5, 123, 'dsds', 'sdsd'),
(6, 123, 'dsds', 'sdsd'),
(7, 123456789, 'dsds', 'sdsd'),
(8, 123456789, 'dsds', 'sdsd'),
(9, 123456789, 'dsds', 'sdsd'),
(10, 123, 'dsds', 'sdsd'),
(11, 123, 'dsds', 'sdsd'),
(12, 123, 'dsds', 'sdsd'),
(13, 123, 'dsds', 'sdsd'),
(14, 12345, 'dsds', 'sdsd'),
(15, 123, 'dsds', 'sdsd'),
(16, 123, 'dsds', 'sdsd'),
(17, 123, 'dsds', 'sdsd'),
(18, 123, 'dsds', 'sdsd'),
(19, 123, 'dsds', 'sdsd'),
(20, 123, 'dsds', 'sdsd'),
(21, 123, 'dsds', 'sdsd'),
(22, 123, 'dsds', 'sdsd'),
(23, 123, 'dsds', 'sdsd'),
(24, 123, 'dsds', 'sdsd'),
(25, 123, 'dsds', 'sdsd'),
(26, 123, 'dsds', 'sdsd'),
(27, 123, 'dsds', 'sdsd'),
(28, 123, 'dsds', 'sdsd'),
(29, 123, 'dsds', 'sdsd'),
(30, 123, 'dsds', 'sdsd'),
(31, 12345, 'dsds', 'sdsd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `idjugador` int(11) NOT NULL,
  `punto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`id`, `nombre`, `idjugador`, `punto`) VALUES
(1, 'adrian', 100, '1000'),
(2, 'qqqq', 100, '1000'),
(7, 'fgffg', 10, '2000'),
(8, 'adrian', 1001, '5000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rankin`
--

CREATE TABLE `rankin` (
  `id` int(11) NOT NULL,
  `playerId` varchar(50) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rankin`
--

INSERT INTO `rankin` (`id`, `playerId`, `puntuacion`, `fecha`) VALUES
(4, '1000', 12, '2025-12-02 08:49:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE `ranking` (
  `id` int(11) NOT NULL,
  `playerId` varchar(50) NOT NULL,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `email` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `password` varchar(250) NOT NULL,
  `playerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`email`, `password`, `playerId`) VALUES
('jesusqarriola@gmail.com', '1', 1),
('jesusqarriola@gmail.com', '123456789', 2),
('jesusqarriola@gmail.com', '123456789', 3),
('j67707987@gmail.com', '111111111111', 4),
('j67707987@gmail.com', '111111111111', 5),
('mokeyggboy@gmail.com', '111111111', 6),
('jesusqarriola@gmail.com', '11111111111111111', 7),
('jesusqarriola@gmail.com', '11111111111111111', 8),
('jesusqarriola@gmail.com', '2222222222222222222222', 9),
('jesusqarriola@gmail.com', '2222222222222222222222', 10),
('jesusqarriola@gmail.com', '2222222222222222222222', 11),
('jesusqarriola@gmail.com', '333333333333333333333333', 12),
('dfdfffff@gmail.com', '44444444444444444444', 13),
('jesusqarriola@gmail.com', '12345678', 1000),
('jesusqarriola@gmail.com', '12345678', 1001),
('mokeyggboy@gmail.com', '12345678', 2002),
('jesusqarriola@gmail.com', '123456789', 9999);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `confi`
--
ALTER TABLE `confi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rankin`
--
ALTER TABLE `rankin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `playerId` (`playerId`);

--
-- Indices de la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`playerId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `confi`
--
ALTER TABLE `confi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rankin`
--
ALTER TABLE `rankin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
