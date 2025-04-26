-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2025 a las 16:34:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `beeapp_ali`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `id_representante` int(11) NOT NULL,
  `p_nombre` varchar(20) NOT NULL,
  `s_nombre` varchar(20) NOT NULL,
  `p_apellido` varchar(20) NOT NULL,
  `s_apellido` varchar(20) NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` double NOT NULL,
  `fecha` date NOT NULL,
  `edad` int(11) NOT NULL,
  `ci_representante` int(8) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `documentos` varchar(255) NOT NULL,
  `sexo` tinyint(4) NOT NULL COMMENT '(0->M, 1->F)',
  `correo` varchar(30) NOT NULL,
  `nivel` varchar(12) NOT NULL,
  `seccion` varchar(12) NOT NULL,
  `mencion` varchar(15) NOT NULL,
  `data_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL COMMENT 'valores(0->F , 1->V)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `id_representante`, `p_nombre`, `s_nombre`, `p_apellido`, `s_apellido`, `cedula`, `telefono`, `fecha`, `edad`, `ci_representante`, `direccion`, `documentos`, `sexo`, `correo`, `nivel`, `seccion`, `mencion`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 2, 'Andry', 'Leomar', 'Bracho', 'Ordoñez', 26671559, 4129769005, '1998-10-18', 25, 6585285, 'la victoria, manzana a3, casa #11', 'partida de nacimiento, carta de vacunación', 0, 'andry@mail.com', '2°do', 'A', 'Petroquimica', '2024-09-07 00:47:18', '2025-04-22 18:28:36', 0),
(2, 2, 'Yosmar', 'Yesiver', 'Montero', 'Utria', 25779598, 4129769005, '1996-10-26', 27, 6585285, 'la victoria, manzana a3, casa #11', 'partida de nacimiento, carta de vacunación', 1, 'yosmar@mail.com', '2°do', 'B', 'Electricidad', '2024-09-07 15:26:20', '2025-04-22 18:28:36', 0),
(3, 2, 'Alayn', 'Alfredo', 'Yegres', 'Ordoñez', 32123456, 4129769005, '2005-10-24', 19, 6585285, 'la victoria, manzana a3, casa #11', 'partida de nacimiento, carta de vacunación, referencia', 0, 'alaynn@mail.com', '1°ero', 'A', 'Mecanica', '2024-09-10 00:18:45', '2025-04-26 13:10:13', 0),
(4, 2, 'Carlos', 'Miguel', 'Gomez', 'Martinez', 12345678, 4156732890, '1985-05-15', 40, 6585285, 'Calle Falsa 123', 'cedula, carnet de salud', 0, 'carlos@mail.com', '3°do', 'B', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:28:36', 0),
(5, 2, 'Luis', 'Antonio', 'Perez', 'Rivas', 23456789, 4167893456, '1990-07-20', 34, 6585285, 'Avenida Principal 45', 'partida de nacimiento, carta de vacunación', 0, 'luis@mail.com', '1°do', 'A', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:34', 0),
(6, 2, 'Marta', 'Isabel', 'Ramirez', 'Gomez', 34567890, 4212345678, '1983-12-05', 41, 6585285, 'Calle 23, Edificio A', 'carta de salud, acta de matrimonio', 0, 'marta@mail.com', '3°do', 'B', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:39', 0),
(7, 2, 'Jose', 'Luis', 'Hernandez', 'Diaz', 45678901, 4256738910, '1992-04-11', 33, 6585285, 'Calle Los Andes, Casa #5', 'carta de vacunación, registro civil', 0, 'jose@mail.com', '2°do', 'C', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:43', 0),
(8, 2, 'Ana', 'Maria', 'Lopez', 'Sanchez', 56789012, 4129769005, '1988-08-21', 36, 6585285, 'la victoria, manzana a3, casa #11', 'partida de nacimiento, carnet de salud', 0, 'ana@mail.com', '1°ero', 'A', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:29:14', 0),
(9, 2, 'Pedro', 'Antonio', 'Garcia', 'Martinez', 67890123, 4356738901, '1995-03-17', 30, 6585285, 'Av. Central, Casa #10', 'partida de nacimiento, carta de vacunación', 0, 'pedro@mail.com', '2°do', 'B', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:28:36', 0),
(10, 2, 'Maria', 'Elena', 'Cortes', 'Gonzalez', 78901234, 4467890123, '1987-09-12', 37, 6585285, 'Calle 45, Casa #9', 'carta de salud, partida de nacimiento', 0, 'maria@mail.com', '3°do', 'A', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:46', 0),
(11, 2, 'Juan', 'Carlos', 'Sierra', 'Vega', 89012345, 4578901234, '1990-02-03', 35, 6585285, 'Avenida Las Palmas, Casa #8', 'cedula, carta de vacunación', 0, 'juan@mail.com', '1°do', 'C', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:48', 0),
(12, 2, 'Patricia', 'Juliana', 'Martinez', 'Rodriguez', 90123456, 4689012345, '1994-06-25', 30, 6585285, 'Calle El Bosque, Apt 12', 'registro civil, partida de nacimiento', 0, 'patricia@mail.com', '2°do', 'B', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:52', 0),
(13, 2, 'David', 'Ezequiel', 'Ortiz', 'Flores', 12345001, 4129769005, '1982-11-01', 42, 6585285, 'la victoria, manzana a3, casa #11', 'carta de vacunación, partida de nacimiento', 0, 'david@mail.com', '1°ero', 'C', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:29:46', 0),
(14, 2, 'Isabel', 'Patricia', 'Castillo', 'Serrano', 23456002, 4234567890, '1993-10-10', 32, 6585285, 'Avenida Libertad, Apt 21', 'registro civil, carnet de salud', 0, 'isabel@mail.com', '2°do', 'A', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:54', 0),
(15, 2, 'Oscar', 'Eduardo', 'Fernandez', 'Paredes', 34567003, 4345678901, '1989-01-15', 36, 6585285, 'Calle Sol, Casa #6', 'partida de nacimiento, carta de vacunación', 0, 'oscar@mail.com', '3°do', 'B', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:28:36', 0),
(16, 2, 'Lorena', 'Delia', 'Gutierrez', 'Rojas', 45678004, 4456789012, '1997-09-28', 27, 6585285, 'Calle 56, Apt 14', 'acta de matrimonio, carnet de salud', 0, 'lorena@mail.com', '2°do', 'A', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:30:59', 0),
(17, 2, 'Ricardo', 'Jesus', 'Martinez', 'Alvarez', 56789005, 4567890123, '1984-03-13', 41, 6585285, 'Calle 78, Casa #11', 'partida de nacimiento, carta de vacunación', 0, 'ricardo@mail.com', '1°do', 'C', 'Electricidad', '2025-04-22 18:22:39', '2025-04-22 18:31:02', 0),
(18, 2, 'Joaquín', 'Antonio', 'Mendoza', 'Guzman', 67890006, 4678901234, '1991-12-02', 33, 6585285, 'Calle La Paz, Apt 9', 'carta de salud, partida de nacimiento', 0, 'joaquin@mail.com', '3°do', 'B', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:33:11', 0),
(19, 2, 'Victoria', 'Clara', 'Ruiz', 'Santos', 78901007, 4789012345, '1986-08-18', 38, 6585285, 'Calle San Juan, Casa #13', 'registro civil, carta de vacunación', 0, 'victoria@mail.com', '1°do', 'A', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:33:14', 0),
(20, 2, 'Carlos', 'Alberto', 'Vasquez', 'Castro', 89012008, 4129769005, '1992-04-28', 32, 6585285, 'la victoria, manzana a3, casa #11', 'carta de salud, partida de nacimiento', 0, 'carlos.vasquez@mail.com', '2°do', 'C', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:28:58', 0),
(21, 2, 'Gloria', 'Marina', 'Diaz', 'Torres', 90123009, 4901234567, '1985-07-19', 40, 6585285, 'Calle La Estrella, Apt 3', 'cedula, carnet de salud', 0, 'gloria@mail.com', '3°do', 'A', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:33:16', 0),
(22, 2, 'Victor', 'Manuel', 'Mora', 'Cordero', 12345010, 5012345678, '1980-02-22', 45, 6585285, 'Calle de la Plaza, Casa #8', 'acta de matrimonio, carta de vacunación', 0, 'victor@mail.com', '1°do', 'B', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:28:36', 0),
(23, 2, 'Cecilia', 'Rosa', 'Sanchez', 'Jimenez', 23456011, 4129769005, '1989-09-05', 35, 6585285, 'la victoria, manzana a3, casa #11', 'partida de nacimiento, carnet de salud', 0, 'cecilia@mail.com', '2°do', 'A', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:30:08', 0),
(24, 2, 'Hugo', 'Luis', 'Paredes', 'Morales', 34567012, 5234567890, '1994-01-25', 31, 6585285, 'Calle Central, Casa #14', 'carta de salud, partida de nacimiento', 0, 'hugo@mail.com', '3°do', 'C', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:33:20', 0),
(25, 2, 'Gabriela', 'Luisa', 'Gomez', 'Fernandez', 45678013, 5345678901, '1990-03-15', 35, 6585285, 'Calle del Sol, Apt 5', 'registro civil, carta de vacunación', 0, 'gabriela@mail.com', '1°do', 'A', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:33:24', 0),
(26, 2, 'Emilio', 'Fernando', 'Torres', 'Rivera', 56789014, 4129769005, '1982-11-30', 42, 6585285, 'la victoria, manzana a3, casa #11', 'partida de nacimiento, carta de vacunación', 0, 'emilio@mail.com', '2°do', 'B', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:29:36', 0),
(27, 2, 'Veronica', 'Elena', 'Moreno', 'Serrano', 67890015, 5567890123, '1996-05-17', 29, 6585285, 'Calle 10, Casa #11', 'cedula, partida de nacimiento', 0, 'veronica@mail.com', '3°do', 'A', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:33:36', 0),
(28, 2, 'Eduardo', 'Carlos', 'Ruiz', 'Ortiz', 78901016, 4129769005, '1993-08-21', 31, 6585285, 'la victoria, manzana a3, casa #11', 'carta de salud, acta de matrimonio', 0, 'eduardo@mail.com', '1°ero', 'B', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:29:40', 0),
(29, 2, 'Natalia', 'Delia', 'Fernandez', 'Diaz', 89012017, 5789012345, '1991-12-03', 33, 6585285, 'Calle Primavera, Casa #9', 'partida de nacimiento, carnet de salud', 0, 'natalia@mail.com', '2°do', 'C', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:28:36', 0),
(30, 2, 'Juan', 'Alberto', 'Martinez', 'Gonzalez', 90123018, 5890123456, '1984-04-22', 41, 6585285, 'Avenida 56, Casa #4', 'carta de salud, partida de nacimiento', 0, 'juan.martinez@mail.com', '3°do', 'A', 'Mecanica', '2025-04-22 18:22:39', '2025-04-22 18:33:33', 0),
(31, 2, 'Alicia', 'Cristina', 'Cordero', 'Ruiz', 12345019, 4129769005, '1988-02-10', 37, 6585285, 'la victoria, manzana a3, casa #11', 'registro civil, carnet de salud', 0, 'alicia@mail.com', '2°do', 'B', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:29:09', 0),
(32, 2, 'Felipe', 'Eduardo', 'Alvarez', 'Morales', 23456020, 6012345678, '1996-07-12', 28, 6585285, 'Calle Libertad, Casa #15', 'acta de matrimonio, carta de vacunación', 0, 'felipe@mail.com', '3°do', 'A', 'Petroquimica', '2025-04-22 18:22:39', '2025-04-22 18:28:36', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `p_nombre` varchar(20) NOT NULL,
  `s_nombre` varchar(20) NOT NULL,
  `p_apellido` varchar(20) NOT NULL,
  `s_apellido` varchar(20) NOT NULL,
  `cedula` int(11) NOT NULL,
  `telefono` double NOT NULL,
  `correo` varchar(30) NOT NULL,
  `areas_formacion` tinytext NOT NULL,
  `fecha` date NOT NULL,
  `edad` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `primero` tinyint(4) NOT NULL COMMENT 'valores (0->F, 1->V)',
  `segundo` tinyint(4) NOT NULL COMMENT 'valores (0->F, 1->V)',
  `tercero` tinyint(4) NOT NULL COMMENT 'valores (0->F, 1->V)',
  `cuarto` tinyint(4) NOT NULL COMMENT 'valores (0->F, 1->V)',
  `quinto` tinyint(4) NOT NULL COMMENT 'valores (0->F, 1->V)',
  `sexto` tinyint(4) NOT NULL COMMENT 'valores (0->F, 1->V)',
  `data_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL COMMENT 'valores(0->F , 1->V)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `p_nombre`, `s_nombre`, `p_apellido`, `s_apellido`, `cedula`, `telefono`, `correo`, `areas_formacion`, `fecha`, `edad`, `direccion`, `primero`, `segundo`, `tercero`, `cuarto`, `quinto`, `sexto`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 'Mayra', 'Gisela', 'Ordoñez', 'Torrella', 8600474, 4124586572, 'mayra@mail.com', 'ciencias', '1964-12-24', 0, 'la victoria, manzana a3, casa #11', 1, 1, 1, 0, 0, 0, '2024-08-31 12:42:31', '2025-02-08 20:52:55', 0),
(2, 'Leo', 'Rafael', 'Polaco', 'Blanco', 6585285, 4244086463, 'l@mail.com', 'electricidad', '1998-10-18', 0, 'la victoria, manzana a3, casa #11', 0, 1, 1, 0, 0, 0, '2024-09-07 15:30:21', '2024-09-07 15:31:11', 1),
(3, 'Lino', 'Rafael', 'Bracho', '', 6585285, 4126548652, 'l@mail.com', 'ciencias', '1954-06-17', 0, 'la victoria, manzana a3, casa #11', 1, 0, 1, 0, 0, 0, '2025-04-07 15:26:22', '2025-04-07 15:26:22', 0),
(4, 'yosmar', 'yesiver', 'Montero', 'Utria', 25779598, 4129769005, 'yesi@mail.com', 'salud', '1996-10-26', 0, 'san pablo de urama', 0, 0, 1, 0, 0, 0, '2025-04-07 15:34:24', '2025-04-07 15:34:24', 0),
(5, 'ovidia', 'yolanda', 'utria', 'padilla', 10627032, 4125389856, 'lacensentida_utria@hotmail.com', 'física , matemática', '1987-10-25', 0, 'la victoria, manzana a3, casa #11', 0, 0, 1, 1, 0, 0, '2025-04-07 15:36:19', '2025-04-07 15:39:04', 0),
(6, 'Carlos', 'Alberto', 'Martínez', 'Gómez', 10567983, 4123345566, 'carlos@mail.com', 'Matemáticas', '1970-04-15', 54, 'Av. Bolívar, edificio El Centro', 0, 1, 1, 0, 0, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(7, 'Luisa', 'Fernanda', 'Torres', 'Díaz', 10984567, 4141122334, 'luisa@mail.com', 'Lengua', '1982-06-10', 42, 'El Viñedo, calle 2, casa 5', 1, 0, 0, 1, 1, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(8, 'Jorge', 'Andrés', 'Pérez', 'Sánchez', 11346789, 4167788990, 'jorge@mail.com', 'Historia', '1975-08-25', 49, 'Santa Rosa, av. 5', 0, 0, 0, 0, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(9, 'Ana', 'María', 'Rodríguez', 'López', 9876543, 4121234567, 'ana@mail.com', 'Ciencias Sociales', '1988-09-12', 36, 'Las Acacias, casa 17', 1, 1, 1, 1, 1, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(10, 'Luis', 'Eduardo', 'Gutiérrez', 'Morales', 11223344, 4146677889, 'luis@mail.com', 'Física', '1979-11-30', 45, 'Los Colorados, callejón 4', 0, 0, 1, 1, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(11, 'María', 'Gabriela', 'Fernández', 'Herrera', 12345678, 4123344556, 'maria@mail.com', 'Química', '1990-01-20', 35, 'Av. Urdaneta, edificio Bolívar', 1, 1, 0, 0, 1, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(12, 'Pedro', 'José', 'Ramírez', 'Castro', 22334455, 4145566778, 'pedro@mail.com', 'Geografía', '1981-03-05', 43, 'Naguanagua, calle 3', 0, 1, 1, 1, 0, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(13, 'Elena', 'Patricia', 'Mendoza', 'Salas', 33445566, 4167788991, 'elena@mail.com', 'Biología', '1985-07-18', 39, 'El Trigal, sector 2', 1, 1, 1, 1, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(14, 'Ramón', 'David', 'Ortiz', 'Vargas', 44556677, 4129988776, 'ramon@mail.com', 'Educación Física', '1978-12-03', 46, 'Ciudad Alianza, torre 4', 0, 0, 0, 1, 1, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(15, 'Isabel', 'Rosa', 'Silva', 'Peña', 55667788, 4142233445, 'isabel@mail.com', 'Educación Especial', '1992-10-09', 32, 'Los Sauces, apto 12', 1, 1, 0, 0, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(16, 'Miguel', 'Ángel', 'Herrera', 'Linares', 66778899, 4163344556, 'miguel@mail.com', 'Informática', '1983-05-14', 41, 'Prebo, calle principal', 0, 0, 1, 1, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(17, 'Valeria', 'Inés', 'Cordero', 'Márquez', 77889900, 4125566778, 'valeria@mail.com', 'Lengua', '1987-11-22', 37, 'San Diego, callejón 7', 1, 1, 1, 0, 0, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(18, 'Diego', 'Rafael', 'Paredes', 'González', 88990011, 4147788990, 'diego@mail.com', 'Filosofía', '1974-06-02', 50, 'Centro, edificio América', 0, 0, 0, 1, 0, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(19, 'Patricia', 'Lorena', 'López', 'Gómez', 99001122, 4168899001, 'patricia@mail.com', 'Psicología', '1991-02-11', 33, 'La Isabelica, bloque 3', 1, 1, 1, 1, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(20, 'Andrés', 'Esteban', 'Quintero', 'Pérez', 10111213, 4126677889, 'andres@mail.com', 'Química', '1980-08-08', 44, 'Guacara, calle Los Almendros', 0, 0, 0, 1, 1, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(21, 'Sofía', 'Jimena', 'Acosta', 'Delgado', 11121314, 4145566887, 'sofia@mail.com', 'Educación Inicial', '1993-07-27', 31, 'Mañongo, zona norte', 1, 1, 0, 0, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(22, 'Tomás', 'Iván', 'Salazar', 'Mejías', 12131415, 4161122334, 'tomas@mail.com', 'Matemáticas', '1986-01-30', 38, 'La Michelena, casa 23', 0, 0, 1, 1, 1, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(23, 'Rosa', 'Elena', 'Delgado', 'Carrillo', 13141516, 4122233445, 'rosa@mail.com', 'Cívica', '1984-09-17', 40, 'Los Nísperos, torre A', 1, 1, 1, 1, 0, 1, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0),
(24, 'Alberto', 'Luis', 'Meza', 'Rivas', 14151617, 4149988776, 'alberto@mail.com', 'Física', '1977-04-05', 47, 'Plaza de Toros, avenida 8', 0, 1, 0, 1, 1, 0, '2025-04-22 19:12:16', '2025-04-22 19:12:16', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses_category`
--

CREATE TABLE `expenses_category` (
  `id` int(11) NOT NULL,
  `expenses` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `data_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `data_edit` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `expenses_category`
--

INSERT INTO `expenses_category` (`id`, `expenses`, `description`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 'Pago Personal Docente', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(2, 'Pago Personal Administrativo', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(3, 'Pago Personal de Apoyo(mantenimiento, limpieza, seguridad)', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(4, 'Beneficios Sociales (seguro médico, vacaciones, aguinaldo, etc.)', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(5, 'Material de Oficina (papelería, bolígrafos, etc.)', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(6, 'Material Didáctico (libros, cuadernos, mapas, etc.)', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(7, 'Material de limpieza', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(8, 'Suministros de cafetería/comedor', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(9, 'Insumos para laboratorios o talleres', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(10, 'Electricidad', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(11, 'Agua', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(12, 'Gas', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(13, 'Telefonía e internet', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(14, 'Mantenimiento de edificios e instalaciones', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(15, 'Reparación de equipos (informáticos, audiovisuales, etc.)', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(16, 'Servicio de fumigación y control de plagas', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(17, 'Alquiler de edificios o espacios adicionales', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(18, 'Alquiler de equipos (fotocopiadoras, proyectores, etc.)', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(19, 'Combustible y mantenimiento de vehículos propios', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(20, 'Pagos a servicios de transporte escolar contratados', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(21, 'Viáticos por traslados del personal', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(22, 'Salidas pedagógicas y excursiones', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(23, 'Materiales para actividades deportivas y culturales', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(24, 'Honorarios de instructores externos', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(25, 'Inscripciones a competencias o eventos', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(26, 'Servicios legales y contables', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(27, 'Publicidad y marketing', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(28, 'Seguros (de propiedad, responsabilidad civil, etc.)', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(29, 'Suscripciones a software o plataformas educativas', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(30, 'Gastos bancarios', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(31, 'Impuestos municipales, estatales o nacionales', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(32, 'Tasas y permisos de funcionamiento', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(33, 'Cursos y talleres para el personal', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0),
(34, 'Otros', '', '2025-04-21 12:27:42', '2025-04-21 12:27:42', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `dia_semana` varchar(100) NOT NULL,
  `hora_inicio` varchar(1000) NOT NULL,
  `hora_fin` varchar(1000) NOT NULL,
  `docente` varchar(255) NOT NULL,
  `materia` varchar(1000) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `seccion` varchar(50) NOT NULL,
  `mencion` varchar(50) NOT NULL,
  `data_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `data_edit` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `dia_semana`, `hora_inicio`, `hora_fin`, `docente`, `materia`, `nivel`, `seccion`, `mencion`, `data_registered`, `data_edit`, `deleted`) VALUES
(5, '[\"Martes\",\"Miercoles\",\"Lunes\",\"Jueves\",\"Viernes\",\"Viernes\",\"Lunes\",\"Martes\",\"Viernes\",\"Miercoles\",\"J', '[\"13:05\",\"13:05\",\"13:15\",\"13:15\",\"13:15\",\"14:00\",\"15:30\",\"15:30\",\"15:30\",\"16:00\",\"16:00\"]', '[\"15:30\",\"15:30\",\"15:30\",\"15:30\",\"14:00\",\"15:30\",\"17:00\",\"16:30\",\"16:00\",\"17:30\",\"17:30\"]', '[\"5\",\"3\",\"1\",\"1\",\"4\",\"5\",\"4\",\"4\",\"3\",\"3\",\"1\"]', '[\"Matematicas\",\"Musica\",\"Ciencias\",\"Educacion Fisica\",\"Ingles\",\"Arte\",\"Lengua\",\"Ciencias\",\"Matematicas\",\"Geografia\",\"Tecnologia\"]', '3°ero', 'D', 'Sistemas', '2025-04-07 11:55:25', '2025-04-07 11:55:25', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `income_source`
--

CREATE TABLE `income_source` (
  `id` int(11) NOT NULL,
  `income_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `data_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `data_edit` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `income_source`
--

INSERT INTO `income_source` (`id`, `income_name`, `description`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 'Matrícula', ' Pago uncio al inscribirse o reinscribirse.', '2025-04-21 12:38:57', '2025-04-21 13:01:44', 0),
(2, 'Mensualidades', 'Pagos mensulaes por la educación.', '2025-04-21 12:38:57', '2025-04-21 13:01:46', 0),
(3, 'Inscripciones a Actividades Extraescolares', 'Talleres, deportes, artes, etc.', '2025-04-21 12:38:57', '2025-04-21 12:59:46', 0),
(4, 'Cuotas por Servicios Adicionale', 'Transporte escolar, Comedor, Seguro escolar, etc.', '2025-04-21 12:38:57', '2025-04-21 12:59:42', 0),
(5, 'Donaciones', 'Aportaciones de padres, exalumnos, empresas locales', '2025-04-21 12:38:57', '2025-04-21 13:00:02', 0),
(6, 'Actividades de Recaudación de Fondos', 'Kermeses, bazares, Rifas, etc.', '2025-04-21 12:38:57', '2025-04-21 13:00:32', 0),
(7, 'Alquiler de Instalaciones (fuera de horario escolar)', 'Canchas, salones, etc.', '2025-04-21 12:38:57', '2025-04-21 13:00:57', 0),
(8, 'Patrocinios de Empresas Locales', 'Apoyo a eventos o actividades a cambio de publicidad.', '2025-04-21 12:38:57', '2025-04-21 13:01:24', 0),
(9, 'Convenios con Empresas o Instituciones', ' Pagos por programas o servicios específicos ofrecidos a empleados o miembros.', '2025-04-21 12:38:57', '2025-04-21 13:01:41', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id` int(11) NOT NULL,
  `nombre_institucion` varchar(200) NOT NULL,
  `director` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` double NOT NULL,
  `correo` varchar(30) NOT NULL,
  `codigo` varchar(50) NOT NULL COMMENT 'codigo del plantel o RIF',
  `alumnos_matricula` int(11) NOT NULL,
  `docentes_matricula` int(11) NOT NULL,
  `data_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id`, `nombre_institucion`, `director`, `direccion`, `telefono`, `correo`, `codigo`, `alumnos_matricula`, `docentes_matricula`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 'E.T.R.P.A Alí Primera', 'Andry Bracho', 'Morón', 4244086463, 'ali_primera@mail.com', 'J-123456789', 3, 4, '2024-09-07 13:54:55', '2025-04-07 15:36:19', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `data_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `data_edit` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_method`
--

INSERT INTO `payment_method` (`id`, `payment_method`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 'Efectivo Bs', '2025-04-21 12:19:37', '2025-04-21 12:19:37', 0),
(2, 'Efectivo Usd', '2025-04-21 12:19:37', '2025-04-21 12:19:37', 0),
(3, 'Pago Movil', '2025-04-21 12:19:37', '2025-04-21 12:19:37', 0),
(4, 'Transferencia Bancaria', '2025-04-21 12:19:37', '2025-04-21 12:19:37', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receive_payment`
--

CREATE TABLE `receive_payment` (
  `id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_revenue` int(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `id_payment_method` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL,
  `date_payment` datetime NOT NULL,
  `start_monthly_payment` datetime NOT NULL,
  `end_monthly_payment` datetime NOT NULL,
  `data_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `data_edit` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `receive_payment`
--

INSERT INTO `receive_payment` (`id`, `id_student`, `id_revenue`, `amount`, `id_payment_method`, `reference`, `note`, `date_payment`, `start_monthly_payment`, `end_monthly_payment`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 0, 1, 80.00, 2, '1030', 'pago de inscripcion', '2025-04-22 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:37:15', '2025-04-22 15:37:15', 0),
(2, 17, 2, 76.95, 1, '5786', 'pago de mensualidad', '2024-12-30 00:00:00', '2025-02-01 00:00:00', '2025-03-03 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(3, 30, 2, 85.52, 3, '5241', 'pago de mensualidad', '2024-11-04 00:00:00', '2025-04-01 00:00:00', '2025-05-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(4, 11, 1, 95.49, 4, '5259', 'pago de inscripción', '2024-10-07 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(5, 28, 2, 56.50, 3, '6667', 'pago de mensualidad', '2024-09-09 00:00:00', '2025-03-01 00:00:00', '2025-03-31 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(6, 20, 1, 85.08, 1, '6297', 'pago de inscripción', '2024-09-24 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(7, 3, 1, 60.00, 4, '8303', 'pago de inscripción', '2024-11-05 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(8, 4, 1, 61.69, 1, '5647', 'pago de inscripción', '2025-01-27 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(9, 0, 1, 82.14, 3, '5472', 'otro pago', '2025-03-07 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(10, 25, 2, 61.30, 1, '7081', 'pago de mensualidad', '2025-03-08 00:00:00', '2025-06-01 00:00:00', '2025-07-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(11, 14, 1, 63.15, 2, '9463', 'pago de inscripción', '2025-04-05 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(12, 31, 2, 80.40, 2, '6205', 'pago de mensualidad', '2025-01-02 00:00:00', '2025-01-01 00:00:00', '2025-02-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(13, 10, 2, 71.23, 2, '5389', 'pago de mensualidad', '2024-09-18 00:00:00', '2025-01-01 00:00:00', '2025-02-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(14, 0, 7, 90.13, 4, '9270', 'otro pago', '2024-10-23 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(15, 2, 2, 91.68, 3, '5037', 'pago de mensualidad', '2025-02-02 00:00:00', '2025-01-01 00:00:00', '2025-02-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(16, 6, 1, 86.11, 2, '8715', 'pago de inscripción', '2024-09-10 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(17, 24, 2, 54.65, 4, '9002', 'pago de mensualidad', '2024-09-19 00:00:00', '2025-01-01 00:00:00', '2025-02-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(18, 22, 1, 87.54, 4, '7015', 'pago de inscripción', '2024-10-19 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(19, 0, 5, 61.00, 2, '8277', 'otro pago', '2025-01-21 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(20, 1, 2, 59.78, 1, '5765', 'pago de mensualidad', '2024-10-01 00:00:00', '2025-03-01 00:00:00', '2025-03-31 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(21, 13, 2, 97.45, 3, '7294', 'pago de mensualidad', '2025-01-25 00:00:00', '2025-04-01 00:00:00', '2025-05-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(22, 12, 1, 69.99, 1, '9266', 'pago de inscripción', '2025-01-03 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(23, 19, 2, 73.92, 2, '8986', 'pago de mensualidad', '2024-11-21 00:00:00', '2025-01-01 00:00:00', '2025-02-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(24, 0, 6, 70.00, 3, '6820', 'otro pago', '2024-12-11 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(25, 9, 2, 93.02, 4, '5148', 'pago de mensualidad', '2024-11-30 00:00:00', '2025-04-01 00:00:00', '2025-05-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(26, 15, 1, 60.84, 2, '7460', 'pago de inscripción', '2025-02-06 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(27, 5, 1, 84.78, 3, '7955', 'pago de inscripción', '2025-01-16 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(28, 16, 1, 84.99, 1, '6997', 'pago de inscripción', '2025-01-07 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(29, 0, 8, 83.25, 1, '6822', 'otro pago', '2024-09-05 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(30, 8, 2, 74.64, 4, '8651', 'pago de mensualidad', '2025-01-28 00:00:00', '2025-03-01 00:00:00', '2025-03-31 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(31, 7, 1, 84.11, 3, '5128', 'pago de inscripción', '2024-09-26 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(32, 27, 2, 71.11, 4, '7362', 'pago de mensualidad', '2024-09-20 00:00:00', '2025-05-01 00:00:00', '2025-06-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(33, 26, 2, 64.14, 3, '5704', 'pago de mensualidad', '2025-03-11 00:00:00', '2025-05-01 00:00:00', '2025-06-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(34, 18, 1, 59.41, 4, '6390', 'pago de inscripción', '2024-10-11 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(35, 29, 2, 89.38, 2, '5100', 'pago de mensualidad', '2025-04-02 00:00:00', '2025-02-01 00:00:00', '2025-03-03 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(36, 21, 2, 87.74, 1, '8968', 'pago de mensualidad', '2025-01-13 00:00:00', '2025-01-01 00:00:00', '2025-02-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(37, 23, 2, 81.60, 2, '8050', 'pago de mensualidad', '2025-02-13 00:00:00', '2025-02-01 00:00:00', '2025-03-03 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0),
(38, 32, 2, 80.10, 3, '7690', 'pago de mensualidad', '2024-10-12 00:00:00', '2025-01-01 00:00:00', '2025-02-01 00:00:00', '2025-04-22 15:47:02', '2025-04-22 15:47:02', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante`
--

CREATE TABLE `representante` (
  `id` int(11) NOT NULL,
  `p_nombre_r` varchar(20) NOT NULL,
  `s_nombre_r` varchar(20) NOT NULL,
  `p_apellido_r` varchar(20) NOT NULL,
  `s_apellido_r` varchar(20) NOT NULL,
  `cedula_r` int(8) NOT NULL,
  `telefono` double NOT NULL,
  `correo` varchar(30) NOT NULL,
  `fecha_r` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `data_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL COMMENT 'valores(0->F , 1->V)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `representante`
--

INSERT INTO `representante` (`id`, `p_nombre_r`, `s_nombre_r`, `p_apellido_r`, `s_apellido_r`, `cedula_r`, `telefono`, `correo`, `fecha_r`, `direccion`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 'Jose', 'Luis', 'Perez', 'Segundo', 10123456, 4124586572, 'j@mail.com', '1964-06-30', 'la victoria, manzana a3, casa #11', '2024-08-31 12:32:47', '2024-09-07 01:15:00', 1),
(2, 'Lino', 'Rafael', 'Bracho', '', 6585285, 4129769005, 'l@mail.com', '1954-10-07', 'la victoria, manzana a3, casa #11', '2024-09-07 00:26:39', '2024-09-10 00:23:10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `send_payment`
--

CREATE TABLE `send_payment` (
  `id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `id_bills` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `id_payment_method` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date_payment` datetime NOT NULL,
  `data_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `data_edit` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `send_payment`
--

INSERT INTO `send_payment` (`id`, `id_teacher`, `id_provider`, `id_bills`, `amount`, `id_payment_method`, `reference`, `note`, `date_payment`, `data_registered`, `data_edit`, `deleted`) VALUES
(1, 0, 0, 1, 30.00, 3, '102', 'primera quicena del mes', '2025-04-21 00:00:00', '2025-04-21 15:08:59', '2025-04-21 15:08:59', 0),
(2, 0, 0, 2, 30.00, 3, '1001', 'Pago mensualidad abril', '2025-04-01 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(3, 0, 0, 3, 45.00, 1, '1002', 'Transferencia bancaria', '2025-04-02 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(4, 0, 0, 4, 60.00, 2, '1003', 'Pago puntual', '2025-04-02 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(5, 0, 0, 5, 50.00, 4, '1004', 'Pago por punto', '2025-04-03 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(6, 0, 0, 6, 75.00, 1, '1005', 'Pago con tarjeta', '2025-04-03 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(7, 0, 0, 7, 80.00, 2, '1006', 'Pago en taquilla', '2025-04-04 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(8, 0, 0, 8, 95.00, 3, '1007', 'Pago completo', '2025-04-04 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(9, 0, 0, 9, 40.00, 1, '1008', 'Pago parcial', '2025-04-05 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(10, 0, 0, 10, 35.00, 2, '1009', 'Pago en efectivo', '2025-04-05 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(11, 0, 0, 11, 100.00, 4, '1010', 'Pago quincenal', '2025-04-06 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(12, 0, 0, 12, 65.00, 1, '1011', 'Pago mensualidad', '2025-04-06 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(13, 0, 0, 13, 70.00, 3, '1012', 'Abono de deuda', '2025-04-07 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(14, 0, 0, 14, 55.00, 1, '1013', 'Pago de abril', '2025-04-07 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(15, 0, 0, 15, 30.00, 2, '1014', 'Pago móvil', '2025-04-08 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(16, 0, 0, 16, 90.00, 1, '1015', 'Pago con tarjeta', '2025-04-08 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(17, 0, 0, 17, 38.00, 4, '1016', 'Pago parcial', '2025-04-09 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(18, 0, 0, 18, 33.00, 2, '1017', 'Pago en banco', '2025-04-09 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(19, 0, 0, 19, 47.00, 1, '1018', 'Pago por caja', '2025-04-10 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(20, 0, 0, 20, 130.00, 4, '1019', 'Pago adelantado', '2025-04-10 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(21, 0, 0, 21, 95.00, 3, '1020', 'Pago normal', '2025-04-11 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(22, 0, 0, 22, 85.00, 2, '1021', 'Pago puntual', '2025-04-11 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(23, 0, 0, 23, 60.00, 1, '1022', 'Pago completo', '2025-04-12 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(24, 0, 0, 24, 48.00, 4, '1023', 'Pago móvil', '2025-04-12 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(25, 0, 0, 25, 50.00, 3, '1024', 'Pago de mes', '2025-04-13 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(26, 0, 0, 26, 72.00, 1, '1025', 'Pago parcial', '2025-04-13 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(27, 0, 0, 27, 90.00, 2, '1026', 'Pago adelantado', '2025-04-14 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(28, 0, 0, 28, 100.00, 3, '1027', 'Pago completo', '2025-04-14 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(29, 0, 0, 29, 44.00, 2, '1028', 'Pago móvil', '2025-04-15 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(30, 0, 0, 30, 55.00, 4, '1029', 'Pago de abril', '2025-04-15 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(31, 0, 0, 31, 135.00, 1, '1030', 'Pago extra', '2025-04-16 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(32, 0, 0, 32, 150.00, 1, '1031', 'Pago completo', '2025-04-16 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(33, 1, 0, 1, 30.00, 3, '1032', 'Primera quincena del mes', '2025-04-17 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(34, 2, 0, 1, 45.00, 2, '1033', 'Pago segunda quincena', '2025-04-17 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(35, 3, 0, 1, 60.00, 4, '1034', 'Pago mensual', '2025-04-18 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(36, 4, 0, 1, 40.00, 1, '1035', 'Pago puntual', '2025-04-18 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(37, 5, 0, 1, 50.00, 2, '1036', 'Pago con tarjeta', '2025-04-19 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(38, 6, 0, 1, 75.00, 3, '1037', 'Pago mensualidad abril', '2025-04-19 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(39, 7, 0, 1, 90.00, 1, '1038', 'Pago normal', '2025-04-20 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(40, 8, 0, 1, 35.00, 4, '1039', 'Pago parcial', '2025-04-20 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(41, 9, 0, 1, 80.00, 3, '1040', 'Pago completo', '2025-04-21 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(42, 10, 0, 1, 70.00, 2, '1041', 'Pago mensual', '2025-04-21 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(43, 11, 0, 1, 65.00, 1, '1042', 'Pago segunda quincena', '2025-04-22 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(44, 12, 0, 1, 47.00, 2, '1043', 'Pago móvil', '2025-04-22 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(45, 13, 0, 1, 68.00, 4, '1044', 'Pago en efectivo', '2025-04-23 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(46, 14, 0, 1, 88.00, 1, '1045', 'Pago abril', '2025-04-23 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(47, 15, 0, 1, 54.00, 3, '1046', 'Pago por transferencia', '2025-04-24 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(48, 16, 0, 1, 77.00, 1, '1047', 'Pago de docente', '2025-04-24 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(49, 17, 0, 1, 92.00, 4, '1048', 'Pago especial', '2025-04-25 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(50, 18, 0, 1, 100.00, 2, '1049', 'Pago completo', '2025-04-25 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(51, 19, 0, 1, 110.00, 1, '1050', 'Pago de abril', '2025-04-26 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0),
(52, 20, 0, 1, 35.00, 3, '1051', 'Abono de deuda', '2025-04-26 00:00:00', '2025-04-22 15:35:01', '2025-04-22 15:35:01', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `rol`) VALUES
(1, 'admin', '0221eb280b7e2407004a045837f9a574', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expenses_category`
--
ALTER TABLE `expenses_category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `income_source`
--
ALTER TABLE `income_source`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `receive_payment`
--
ALTER TABLE `receive_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `representante`
--
ALTER TABLE `representante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `send_payment`
--
ALTER TABLE `send_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `expenses_category`
--
ALTER TABLE `expenses_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `income_source`
--
ALTER TABLE `income_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `receive_payment`
--
ALTER TABLE `receive_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `representante`
--
ALTER TABLE `representante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `send_payment`
--
ALTER TABLE `send_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
