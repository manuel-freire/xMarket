-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2019 a las 18:36:31
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `xmarket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria`) VALUES
('juguetes'),
('libros'),
('ropa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `ID` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderadores`
--

CREATE TABLE `moderadores` (
  `usuario` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moderadores`
--

INSERT INTO `moderadores` (`usuario`, `categoria`) VALUES
(2, 'libros'),
(9, 'juguetes'),
(1, 'ropa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `usuarioPropietario` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `img2` varchar(50) DEFAULT NULL,
  `img3` varchar(50) DEFAULT NULL,
  `vendido` int(11) NOT NULL,
  `pendiente` int(11) NOT NULL,
  `subasta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `nombre`, `categoria`, `descripcion`, `precio`, `usuarioPropietario`, `img`, `img2`, `img3`, `vendido`, `pendiente`, `subasta`) VALUES
(65, 'Libro Stephen King La Larga Marcha', 'libros', 'Libro de Stephen King nuevo, sin abrir.', 12, 1, 'upload/productos/65/1.png', NULL, NULL, 1, 0, 0),
(67, 'Balon de futbol', 'juguetes', 'Balon de fubol 11 amarillo. Marca Puma.', 7, 1, 'upload/productos/66/1.png', NULL, NULL, 0, 0, 0),
(68, 'Vaquero hombre. Talla 34', 'ropa', 'Ancho, no como los de ahora.', 8, 2, 'upload/productos/68/1.png', NULL, NULL, 0, 1, 0),
(69, 'Camiseta Nike', 'ropa', 'Camiseta sin estrenar de la marca Nike. Talla L.', 15, 2, 'upload/productos/69/1.png', NULL, NULL, 0, 0, 1),
(70, 'El poder de las Piezas Menores - Jan Timman', 'libros', 'Libro de ajedrez para principiantes. 250 pÃ¡ginas. Tapa blanda.', 12, 2, 'upload/productos/70/1.png', NULL, NULL, 0, 1, 0),
(71, 'Camiseta de tirantes nike blanca', 'ropa', 'Talla M', 10, 8, 'upload/productos/71/1.png', NULL, NULL, 0, 1, 0),
(72, 'Action Man', 'juguetes', 'Juguete Action Man. AÃ±o 2014.', 15, 8, 'upload/productos/72/1.png', NULL, NULL, 0, 1, 1),
(73, 'Vaquero mujer', 'ropa', 'Talla 36.', 12, 1, 'upload/productos/73/1.png', NULL, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subastas`
--

CREATE TABLE `subastas` (
  `ID` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `precioOriginal` int(11) NOT NULL,
  `ultimaPuja` int(11) NOT NULL,
  `fechaVencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subastas`
--

INSERT INTO `subastas` (`ID`, `usuario`, `producto`, `precioOriginal`, `ultimaPuja`, `fechaVencimiento`) VALUES
(18, 1, 73, 12, 12, '2019-04-17'),
(19, 1, 69, 15, 15, '2019-04-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nombreUsuario` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `imgPerfil` varchar(50) NOT NULL,
  `esAdmin` int(11) NOT NULL,
  `credito` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombreUsuario`, `password`, `direccion`, `correo`, `imgPerfil`, `esAdmin`, `credito`, `valoracion`) VALUES
(1, 'mario', '$2y$10$aDaP.kO/qjQwAVoFAxx8DOm77xi.aYiYIHd9mumDSvZp6m4or5/le', 'C/Morera N 7', 'mflore05@ucm.es', 'img/nike.png', 0, 0, 5),
(2, 'juan', '$2y$10$0HHHpKwUU3G7btW5MM85kurCLvowUzVn4Ztr26t9/V7RAZigJStzS', 'C/Morera N 7', 'juan@juan.com', 'img/usuario.png', 0, 5, 1),
(3, 'admin', '$2y$10$8at/c/MY0XABz47bJp4A7Ojy5O7ZUhLUvoaNJW2aAvFVnpf2u0J6O', 'Administrador', 'admin@admin.com', 'img/default.png', 1, 0, 0),
(8, 'bebe', '$2y$10$eUpi8J9u.7syEp3f7kPXHOj2ZLv/OLN4SqFkci0GKMz.v9MeLYHfu', 'C/Mayor N87', 'bebe@bebe.com', 'img/usuario.png', 0, 13, 0),
(9, 'ramon', '$2y$10$u3Z64thrhlzMqwe.I7gbYeX2z1L/0trK9JSKNDI9o9oGrGPAkgseS', 'C/ Los ramones N43', 'ramon@hotmail.com', 'img/usuario.png', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `fechaVenta` date NOT NULL,
  `precioVenta` int(11) NOT NULL,
  `fueSubasta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID`, `usuario`, `producto`, `fechaVenta`, `precioVenta`, `fueSubasta`) VALUES
(9, 8, 65, '2019-04-11', 12, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `moderadores`
--
ALTER TABLE `moderadores`
  ADD KEY `usuario` (`usuario`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `usuarioPropietario` (`usuarioPropietario`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `subastas`
--
ALTER TABLE `subastas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `producto` (`producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `subastas`
--
ALTER TABLE `subastas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `productos` (`ID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `moderadores`
--
ALTER TABLE `moderadores`
  ADD CONSTRAINT `moderadores_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `moderadores_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`categoria`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`categoria`);

--
-- Filtros para la tabla `subastas`
--
ALTER TABLE `subastas`
  ADD CONSTRAINT `subastas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`ID`),
  ADD CONSTRAINT `subastas_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `productos` (`ID`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `productos` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
