-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2016 a las 21:39:38
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacen_tienda_stock`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_almacen`
--

CREATE TABLE `stock_almacen` (
  `ID` int(11) NOT NULL,
  `TELEFONO` int(11) DEFAULT NULL,
  `DIRECCION` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `PAIS` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CIUDAD` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `COD_POSTAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los almacenes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_categoria`
--

CREATE TABLE `stock_categoria` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las categorias';

--
-- Volcado de datos para la tabla `stock_categoria`
--

INSERT INTO `stock_categoria` (`ID`, `NOMBRE`) VALUES
(1, 'Calzado'),
(2, 'Pantalón'),
(3, 'Camiseta'),
(4, 'Chaqueta'),
(5, 'Sombrero'),
(6, 'Ropa interior'),
(7, 'Ropa de baño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_lineapedido`
--

CREATE TABLE `stock_lineapedido` (
  `ID_PEDIDO` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `UNIDADES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las lineas de suministros de los almacenes hacia las tiendas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_lineasuministro`
--

CREATE TABLE `stock_lineasuministro` (
  `ID_SUMINISTRO` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `UNIDADES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las lineas de suministros de los almacenes hacia las tiendas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_lineaventa`
--

CREATE TABLE `stock_lineaventa` (
  `ID_VENTA` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `UNIDADES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las lineas de venta';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_pedido`
--

CREATE TABLE `stock_pedido` (
  `ID` int(11) NOT NULL,
  `ID_ALMACEN` int(11) NOT NULL,
  `ID_PROVEEDOR` varchar(9) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los pedidos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_producto`
--

CREATE TABLE `stock_producto` (
  `ID` int(11) NOT NULL,
  `ID_CATEGORIA` int(11) DEFAULT NULL,
  `NOMBRE` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `PRECIO` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los productos';

--
-- Volcado de datos para la tabla `stock_producto`
--

INSERT INTO `stock_producto` (`ID`, `ID_CATEGORIA`, `NOMBRE`, `DESCRIPCION`, `PRECIO`) VALUES
(19, 1, 'Nike Air Zoom 2016', 'Zapatillas de running Nike Air Zoom del año 2016', '85.50'),
(20, 1, 'Adidas adizero 2016', 'Zapatillas de running Adidas adizero del año 2016', '77.50'),
(21, 2, 'Shorts Betis verde', 'Pantalón de juego del Real Betis de color verde', '25.50'),
(22, 2, 'Shorts Sevilla blanco', 'Pantalón de juego del Sevilla FC de color blanco', '25.50'),
(23, 3, 'Asics m210', 'Camiseta transpirable para training asics', '35.50'),
(24, 4, 'Marino warm Joma', 'Abrigo de pesca con exterior impermeable', '105.50'),
(25, 5, 'Gorra Lacoste minim blc', 'Gorra de golf marca Lacoste color blanco', '21.50'),
(26, 1, 'Nike Magista Azul', 'Botas de fútbol Nike Magista color azul', '45.20'),
(27, 3, 'Adidas Training T1', 'Camiseta sin mangas Adidas T1', '12.90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_producto_almacen`
--

CREATE TABLE `stock_producto_almacen` (
  `ID_ALMACEN` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `UNIDADES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar el stock de almacen';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_proveedor`
--

CREATE TABLE `stock_proveedor` (
  `ID` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TELEFONO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los proveedores';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_suministro`
--

CREATE TABLE `stock_suministro` (
  `ID` int(11) NOT NULL,
  `ID_TIENDA` int(11) NOT NULL,
  `ID_ALMACEN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los suministros de los almacenes hacia las tiendas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_tienda`
--

CREATE TABLE `stock_tienda` (
  `ID` int(11) NOT NULL,
  `TELEFONO` int(11) DEFAULT NULL,
  `DIRECCION` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `PAIS` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CIUDAD` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `COD_POSTAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las tiendas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_venta`
--

CREATE TABLE `stock_venta` (
  `ID` int(11) NOT NULL,
  `ID_TIENDA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los datos de las ventas';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `stock_almacen`
--
ALTER TABLE `stock_almacen`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `stock_categoria`
--
ALTER TABLE `stock_categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `stock_lineapedido`
--
ALTER TABLE `stock_lineapedido`
  ADD PRIMARY KEY (`ID_PEDIDO`,`ID_PRODUCTO`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `stock_lineasuministro`
--
ALTER TABLE `stock_lineasuministro`
  ADD PRIMARY KEY (`ID_SUMINISTRO`,`ID_PRODUCTO`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `stock_lineaventa`
--
ALTER TABLE `stock_lineaventa`
  ADD PRIMARY KEY (`ID_VENTA`,`ID_PRODUCTO`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `stock_pedido`
--
ALTER TABLE `stock_pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ALMACEN` (`ID_ALMACEN`),
  ADD KEY `ID_PROVEEDOR` (`ID_PROVEEDOR`);

--
-- Indices de la tabla `stock_producto`
--
ALTER TABLE `stock_producto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CATEGORIA` (`ID_CATEGORIA`);

--
-- Indices de la tabla `stock_producto_almacen`
--
ALTER TABLE `stock_producto_almacen`
  ADD PRIMARY KEY (`ID_ALMACEN`,`ID_PRODUCTO`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `stock_proveedor`
--
ALTER TABLE `stock_proveedor`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `stock_suministro`
--
ALTER TABLE `stock_suministro`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_TIENDA` (`ID_TIENDA`);

--
-- Indices de la tabla `stock_tienda`
--
ALTER TABLE `stock_tienda`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `stock_venta`
--
ALTER TABLE `stock_venta`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_TIENDA` (`ID_TIENDA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `stock_almacen`
--
ALTER TABLE `stock_almacen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `stock_categoria`
--
ALTER TABLE `stock_categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `stock_pedido`
--
ALTER TABLE `stock_pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `stock_producto`
--
ALTER TABLE `stock_producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `stock_suministro`
--
ALTER TABLE `stock_suministro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `stock_tienda`
--
ALTER TABLE `stock_tienda`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `stock_venta`
--
ALTER TABLE `stock_venta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `stock_lineapedido`
--
ALTER TABLE `stock_lineapedido`
  ADD CONSTRAINT `stock_lineapedido_ibfk_1` FOREIGN KEY (`ID_PEDIDO`) REFERENCES `stock_pedido` (`ID`),
  ADD CONSTRAINT `stock_lineapedido_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `stock_producto` (`ID`);

--
-- Filtros para la tabla `stock_lineasuministro`
--
ALTER TABLE `stock_lineasuministro`
  ADD CONSTRAINT `stock_lineasuministro_ibfk_1` FOREIGN KEY (`ID_SUMINISTRO`) REFERENCES `stock_suministro` (`ID`),
  ADD CONSTRAINT `stock_lineasuministro_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `stock_producto` (`ID`);

--
-- Filtros para la tabla `stock_lineaventa`
--
ALTER TABLE `stock_lineaventa`
  ADD CONSTRAINT `stock_lineaventa_ibfk_1` FOREIGN KEY (`ID_VENTA`) REFERENCES `stock_venta` (`ID`),
  ADD CONSTRAINT `stock_lineaventa_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `stock_producto` (`ID`);

--
-- Filtros para la tabla `stock_pedido`
--
ALTER TABLE `stock_pedido`
  ADD CONSTRAINT `stock_pedido_ibfk_1` FOREIGN KEY (`ID_ALMACEN`) REFERENCES `stock_almacen` (`ID`),
  ADD CONSTRAINT `stock_pedido_ibfk_2` FOREIGN KEY (`ID_PROVEEDOR`) REFERENCES `stock_proveedor` (`ID`);

--
-- Filtros para la tabla `stock_producto`
--
ALTER TABLE `stock_producto`
  ADD CONSTRAINT `stock_producto_ibfk_1` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `stock_categoria` (`ID`);

--
-- Filtros para la tabla `stock_producto_almacen`
--
ALTER TABLE `stock_producto_almacen`
  ADD CONSTRAINT `stock_producto_almacen_ibfk_1` FOREIGN KEY (`ID_ALMACEN`) REFERENCES `stock_almacen` (`ID`),
  ADD CONSTRAINT `stock_producto_almacen_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `stock_producto` (`ID`);

--
-- Filtros para la tabla `stock_suministro`
--
ALTER TABLE `stock_suministro`
  ADD CONSTRAINT `stock_suministro_ibfk_1` FOREIGN KEY (`ID_TIENDA`) REFERENCES `stock_tienda` (`ID`);

--
-- Filtros para la tabla `stock_venta`
--
ALTER TABLE `stock_venta`
  ADD CONSTRAINT `stock_venta_ibfk_1` FOREIGN KEY (`ID_TIENDA`) REFERENCES `stock_tienda` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
