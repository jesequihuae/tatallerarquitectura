-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2017 a las 00:15:03
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tallerarquitectura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(4, 'Habitaciones', 'Son todas aquellas las que tienen basdasd adas dsd asda dasd ad asd asdas das dad asd asd asdas das dasd asda sdas das dsad asd asdas sad asd asd asd', '58f5595edea7cbuilding.jpg'),
(5, 'Edificios', 'asdasds', '58db2a7ccca20Captura de pantalla (5).png'),
(6, 'Pendejadas', 'sadsadasdads', '58f45b0032506Captura de pantalla (138).png'),
(7, 'asdadadasd', 'asdadad', '58f45b2618fa4Captura de pantalla (103).png'),
(8, 'sdfsdafsdafs', 'dfasdfasdfsadfasdfasdf', '58f557ff8f3e1building.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL,
  `valuacion` text NOT NULL,
  `objetivo` text NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `correo_electronico` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `mision`, `vision`, `valuacion`, `objetivo`, `ubicacion`, `correo_electronico`) VALUES
(1, 'Ser un chingon en todo lo que se hace', 'Esta es una vision', 'este es una valuacion', 'Esto es un nuevo objetivo', '19.045798541867754,-104.33170406249997', 'Jesus_equihua@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_subcategoria`
--

CREATE TABLE `imagen_subcategoria` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `subcategoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagen_subcategoria`
--

INSERT INTO `imagen_subcategoria` (`id`, `imagen`, `subcategoria_id`) VALUES
(3, '58eeab3b08820650_1200.jpg', 3),
(4, '58eeab3b422a115672773_1282394681822177_4238358639925853470_n.png', 3),
(5, '58eeab3b5eb12gradiente-de-colores-5209b2dc75151.jpg', 3),
(6, '58eeab3b9fa54programacion-en-el-aula_0.jpg', 3),
(7, '58eeab3bb9af4shutterstock-programming.jpg', 3),
(8, '58f266c97c04a58eeab3b5eb12gradiente-de-colores-5209b2dc75151.jpg', 10),
(9, '58f266c98951558eeab3b9fa54programacion-en-el-aula_0.jpg', 10),
(10, '58f266c99796e58eeab3b422a115672773_1282394681822177_4238358639925853470_n.png', 10),
(11, '58f266c9af99458eeab3b08820650_1200.jpg', 10),
(12, '58f266c9b4daf58eeab3bb9af4shutterstock-programming.jpg', 10),
(13, '58f266d658f0e58eeab3b5eb12gradiente-de-colores-5209b2dc75151.jpg', 11),
(14, '58f266d663d7d58eeab3b9fa54programacion-en-el-aula_0.jpg', 11),
(15, '58f266d66bdd858eeab3b422a115672773_1282394681822177_4238358639925853470_n.png', 11),
(16, '58f266d673bae58eeab3b08820650_1200.jpg', 11),
(17, '58f266d6794da58eeab3bb9af4shutterstock-programming.jpg', 11),
(18, '58f29b45cc36c58eea8c62fc10gradiente-de-colores-5209b2dc75151.jpg', 2),
(19, '58f579ab54532building.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id` int(11) NOT NULL,
  `nombreCompleto` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `profesion` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id`, `nombreCompleto`, `foto`, `profesion`, `descripcion`, `empresa_id`) VALUES
(1, 'Jesus Equihua Equihua', '58d9c0c67dcf2IMG_1265.JPG', 'Vale vergas', 'Es un pendejo XD', 1),
(2, 'Miguel Angel Rodriguez Cornejo', '58d9c0fbf1b85IMG_1516.JPG', 'Pendejo', 'Valer verga nuevamente', 1),
(3, 'Leopoldo Mora Sosa', 'polo.jpg', 'Ingeniero en Gestion Empresarial', 'Ha trabajado en distintos proyectos, valiendo verga como solo el sabe, asi que no representa ningun problema el tener otro trabajo donde valer verga', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redsocial`
--

CREATE TABLE `redsocial` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `redsocial`
--

INSERT INTO `redsocial` (`id`, `nombre`, `url`, `empresa_id`) VALUES
(3, 'Youtube', 'www.youtube.com', 1),
(4, 'Facebook', 'www.facebook.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `destacado` varchar(1) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `nombre`, `descripcion`, `destacado`, `categoria_id`) VALUES
(2, 'Edificio', 'asdasd', '1', 5),
(3, 'HabitacionA', 'Este proyecto trata de muchas cosas wuu! xd jasdasdjsafnsdfnsadjfnsfnsadfnadsjfn', '1', 4),
(10, 'EdificioPrueba', 'sdf', '1', 4),
(11, 'sdfsdfsdfsadfs', 'sdfasdfs', '1', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `password`, `tipo`) VALUES
(1, 'administrador', '12345', '0'),
(4, 'memuerdes', '12345', '1'),
(6, 'adafa', 'fadfa', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video_subcategoria`
--

CREATE TABLE `video_subcategoria` (
  `id` int(11) NOT NULL,
  `video` varchar(255) NOT NULL,
  `subcategoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen_subcategoria`
--
ALTER TABLE `imagen_subcategoria`
  ADD PRIMARY KEY (`id`,`subcategoria_id`),
  ADD KEY `fk_imagen_subcategoria_subcategoria1_idx` (`subcategoria_id`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`,`empresa_id`),
  ADD KEY `fk_miembros_empresa_idx` (`empresa_id`);

--
-- Indices de la tabla `redsocial`
--
ALTER TABLE `redsocial`
  ADD PRIMARY KEY (`id`,`empresa_id`),
  ADD KEY `fk_redsocial_empresa1_idx` (`empresa_id`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`,`categoria_id`),
  ADD KEY `fk_subcategoria_categoria1_idx` (`categoria_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `video_subcategoria`
--
ALTER TABLE `video_subcategoria`
  ADD PRIMARY KEY (`id`,`subcategoria_id`),
  ADD KEY `fk_video_subcategoria_subcategoria1_idx` (`subcategoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `imagen_subcategoria`
--
ALTER TABLE `imagen_subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `redsocial`
--
ALTER TABLE `redsocial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `video_subcategoria`
--
ALTER TABLE `video_subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen_subcategoria`
--
ALTER TABLE `imagen_subcategoria`
  ADD CONSTRAINT `fk_imagen_subcategoria_subcategoria1` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD CONSTRAINT `fk_miembros_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `redsocial`
--
ALTER TABLE `redsocial`
  ADD CONSTRAINT `fk_redsocial_empresa1` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_subcategoria_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `video_subcategoria`
--
ALTER TABLE `video_subcategoria`
  ADD CONSTRAINT `fk_video_subcategoria_subcategoria1` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
