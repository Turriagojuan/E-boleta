-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-10-2024 a las 04:59:00
-- Versión del servidor: 8.0.39
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eboleta2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

CREATE TABLE `boleta` (
  `idBoleta` int NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `Evento_idEvento` int NOT NULL,
  `Cliente_idCliente` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`idBoleta`, `nombre_usuario`, `Evento_idEvento`, `Cliente_idCliente`) VALUES
(1, 'jperez', 1, 1),
(2, 'agomez', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`) VALUES
(1, 'Conciertos'),
(2, 'Teatro'),
(3, 'Deportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `telefono` int NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombre`, `correo`, `telefono`, `direccion`, `clave`) VALUES
(1, 'Juan Pérez', 'juan.perez@gmail.com', 321654987, 'Carrera 10 #45-78', '56e044c0ec3f8ce92fdab721f26aea0a'),
(2, 'Ana Gómez', 'ana.gomez@gmail.com', 987321654, 'Calle 22 #33-44', 'a93b0d88486eb6677b3934e389bc7c81');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idEvento` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `aforo` int NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `Proveedor_idProveedor` int NOT NULL,
  `Tipo_evento_idCategoria` int NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`idEvento`, `nombre`, `aforo`, `ciudad`, `direccion`, `fecha`, `hora`, `descripcion`, `Proveedor_idProveedor`, `Tipo_evento_idCategoria`, `precio`) VALUES
(1, 'Concierto Rock', 5000, 'Bogotá', 'Estadio XYZ', '2024-11-01', '19:00:00', 'Un concierto de rock con bandas nacionales.', 1, 1, 150000),
(2, 'Obra de Teatro', 300, 'Medellín', 'Teatro ABC', '2024-12-05', '20:00:00', 'Una obra de teatro clásica.', 2, 2, 50000),
(10, 'Bogotafes', 500, 'Medellin', 'calle de la muelte #4', '2024-10-16', '14:33:00', 'jkbnkjn jknknk kjnk', 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int NOT NULL,
  `total` float NOT NULL,
  `subtotal` float NOT NULL,
  `iva` int NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `Cliente_idCliente` int NOT NULL,
  `Evento_idEvento` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `total`, `subtotal`, `iva`, `fecha`, `hora`, `Cliente_idCliente`, `Evento_idEvento`) VALUES
(1, 170000, 150000, 20000, '2024-10-01', '15:30:00', 1, 1),
(2, 50000, 45000, 5000, '2024-10-05', '18:00:00', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_boleta`
--

CREATE TABLE `factura_boleta` (
  `Boleta_idBoleta` int NOT NULL,
  `Factura_idFactura` int NOT NULL,
  `cantidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `factura_boleta`
--

INSERT INTO `factura_boleta` (`Boleta_idBoleta`, `Factura_idFactura`, `cantidad`) VALUES
(1, 1, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `telefono` int NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `correo`, `telefono`, `direccion`, `clave`) VALUES
(1, 'Proveedor 1', 'contacto@proveedor1.com', 123456789, 'Calle 123', 'eb52fc9a4b3a81a2000a9e774d5aa515'),
(2, 'Proveedor 2', 'contacto@proveedor2.com', 987654321, 'Avenida 456', 'b984fe77863037ddeb9be2ad7dfb246e');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD PRIMARY KEY (`idBoleta`),
  ADD KEY `fk_Boleta_Evento1` (`Evento_idEvento`),
  ADD KEY `fk_Boleta_Cliente1` (`Cliente_idCliente`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `fk_Evento_Proveedor` (`Proveedor_idProveedor`),
  ADD KEY `fk_Evento_Tipo_evento1` (`Tipo_evento_idCategoria`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_Factura_Cliente1` (`Cliente_idCliente`),
  ADD KEY `fk_Factura_Evento1` (`Evento_idEvento`);

--
-- Indices de la tabla `factura_boleta`
--
ALTER TABLE `factura_boleta`
  ADD PRIMARY KEY (`Boleta_idBoleta`,`Factura_idFactura`),
  ADD KEY `fk_Factura_Boleta_Factura1` (`Factura_idFactura`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idEvento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `fk_Boleta_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_Boleta_Evento1` FOREIGN KEY (`Evento_idEvento`) REFERENCES `evento` (`idEvento`);

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_Evento_Proveedor` FOREIGN KEY (`Proveedor_idProveedor`) REFERENCES `proveedor` (`idProveedor`),
  ADD CONSTRAINT `fk_Evento_Tipo_evento1` FOREIGN KEY (`Tipo_evento_idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_Factura_Evento1` FOREIGN KEY (`Evento_idEvento`) REFERENCES `evento` (`idEvento`);

--
-- Filtros para la tabla `factura_boleta`
--
ALTER TABLE `factura_boleta`
  ADD CONSTRAINT `fk_Factura_Boleta_Boleta1` FOREIGN KEY (`Boleta_idBoleta`) REFERENCES `boleta` (`idBoleta`),
  ADD CONSTRAINT `fk_Factura_Boleta_Factura1` FOREIGN KEY (`Factura_idFactura`) REFERENCES `factura` (`idFactura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
