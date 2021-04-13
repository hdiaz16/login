-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2021 a las 22:01:54
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'hdiaz16', '$2y$10$/p6uMmlncxD8uj3Cx3sfs.1G9.ZE3Ym9dFMoGd7o4NF', '2021-04-13 13:45:22'),
(2, 'hdiaz162', '$2y$10$eaWaPrGyVf3wRYcatzukNehpcGbDq6BqIPHwDVengGX', '2021-04-13 14:17:02'),
(3, 'hdiaz', '$2y$10$vkx/dWcfi0x5NcV07LkUseaTx/jNTmFOxTXAhtlzgx0', '2021-04-13 14:23:26'),
(4, 'hdiaz1', '$2y$10$zSp98lA273bJY8Vr7OwpN.n5Je41yUs5pSRCSxMm.sRS2eRI4z19e', '2021-04-13 14:28:44'),
(5, 'hfdb16@hotmail.com', '$2y$10$4/YjD5l7Svd5QkpU.kTURO.1PXAuR08myParWGGqCdHKJCmK8i2HS', '2021-04-13 14:49:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
