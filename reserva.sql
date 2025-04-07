-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2025 a las 17:51:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reserva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE `rols` (
  `id_rol` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id_rol`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `fk_role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_users`, `name`, `last_name`, `username`, `email`, `password`, `status`, `fk_role_id`) VALUES
(1, 'Jonathan', 'Gomez', 'Jona28', 'jonathan@gmail.com', '$2y$10$s87N0ymHnp9qvJR.PAPddegmGOFOJFKup365b5vtU5TKah.AREhXi', 'Activo', 1),
(2, 'Janes', 'Smiths', 'jane smith', 'jane@example.com', '$2y$10$PVTx4C/LWtPE28mvFhx7begt32RHt6o7w9L5gdDo7lOVmM61NfqRO', 'Activo', 2),
(3, 'Alice', 'Jones', 'alice jones', 'alice@example.com', '$2y$10$g5pOScV4JtCGrEfOcu67guOGvVdkyJJkVezwyHO1k2ZzIdDHC/6Ge', 'Activo', 2),
(4, 'Bob', 'Brown', 'bob brown', 'bob@example.com', '$2y$10$g5pOScV4JtCGrEfOcu67guOGvVdkyJJkVezwyHO1k2ZzIdDHC/6Ge', 'Activo', 2),
(7, 'Juan', 'López', 'juan123', 'juan@gmail.com', '$2y$10$Z68voFlk5EYhlzc7gsAFEOqxvppT49bhHGbm9iC6aZIyF78aZjR22', 'Activo', 1),
(8, 'David', 'Arroyave ', 'popocho', 'darroyave882@gmail.com', '$2y$10$GfY37Xa2woVNecoIAaOdLuqNnUtlThoYtbmBOYi8PW/2nh90NLhQa', 'Activo', 2),
(9, 'Johany', 'Otalvaro', 'johanyprogamer', 'johany@gmail.com', '$2y$10$MuTtcIgWCbfZsrSCALaOd.MkWjEOlSb7Mz5EKJKIgoIha7VOV3Dt6', 'Activo', 2),
(10, 'harlyn david ', 'quiroga restrepo', 'harlyn', 'harlinasd@gmail.com', '$2y$10$I5YynS78B5lyOZ/oXLkP7uWV0pLomytkAD22t9BmtfuzdZAS.BwSy', 'Activo', 2),
(12, 'Miguela', 'Gomez', 'miguelito', 'miguel@gmail.com', '$2y$10$CERq/C61K/AMRnPRKc6eYuPoNha6P1DlXYTX4cyTdykCC9edtsXLS', 'Activo', 2),
(13, 'Ana', 'López Pamplona ', 'Fofi123', 'anasofia@gmail.com', '$2y$10$ecEfBJI5oE3Y9kqL.h6Vb.Ojgh3mNKawIj5ogsGBNhgB2pvmRmCRK', 'Activo', 2),
(14, 'Daniela', 'Puerta ', 'Nanis', 'daniela@gmail.com', '$2y$10$Oes2eSNFzf6pHwFBPaCGRujhQelI.TYSMy9zzuEhlNgJFqFAGuhvC', 'Activo', 2),
(15, '', '', '', '', '$2y$10$FlNZJMNDW8bMC4SoP97/Ee.XvSFFsPoGGsr8w4DXEfii7YrZMKFXe', 'Activo', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `fk_role_id` (`fk_role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_role_id`) REFERENCES `rols` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
