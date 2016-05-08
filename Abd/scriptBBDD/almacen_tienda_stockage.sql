-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2016 a las 12:28:04
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacen_tienda_stockage`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `STOCK_CATEGORIA` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las categorias';

--
-- Volcado de datos para la tabla `categoria`
--
/*
INSERT INTO `STOCK_CATEGORIA` (`ID`, `NOMBRE`) VALUES
(NULL, 'Calzado'),
(NULL, 'Pantalón'),
(NULL, 'Camiseta'),
(NULL, 'Chaqueta'),
(NULL, 'Sombrero'),
(NULL, 'Ropa interior'),
(NULL, 'Ropa de baño');
*/
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clienteweb`
--
/*
CREATE TABLE `STOCK_CLIENTEWEB` (
  `ID` varchar(9) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `APELLIDOS` varchar(50) NOT NULL,
  `DIRECCION` varchar(250) NOT NULL,
  `TELEFONO` int NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `CIUDAD` varchar(50) NOT NULL,
  `PAIS` varchar(50) NOT NULL,
  `COD_POSTAL` int NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los datos de los clientes web';
*/
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `STOCK_ALMACEN` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TELEFONO` int DEFAULT NULL,
  `DIRECCION` varchar(250) NOT NULL,
  `PAIS` varchar(50) NOT NULL,
  `CIUDAD` varchar(50) NOT NULL,
  `COD_POSTAL` int NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los almacenes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `STOCK_TIENDA` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TELEFONO` int DEFAULT NULL,
  `DIRECCION` varchar(250) NOT NULL,
  `PAIS` varchar(50) NOT NULL,
  `CIUDAD` varchar(50) NOT NULL,
  `COD_POSTAL` int NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las tiendas';

-- --------------------------------------------------------



--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `STOCK_PRODUCTO` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_CATEGORIA` int DEFAULT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(250) DEFAULT NULL,
  `PRECIO` decimal(8,2) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (ID_CATEGORIA) REFERENCES STOCK_CATEGORIA(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los productos';

--
-- Volcado de datos para la tabla `producto`
--
/*
INSERT INTO `STOCK_PRODUCTO` (`ID`, `ID_CATEGORIA`, `NOMBRE`, `DESCRIPCION`, `PRECIO`) VALUES
(NULL, 1, 'Nike Air Zoom 2016', 'Zapatillas de running Nike Air Zoom del año 2016', '85.50'),
(NULL, 1, 'Adidas adizero 2016', 'Zapatillas de running Adidas adizero del año 2016', '77.50'),
(NULL, 2, 'Shorts Betis verde', 'Pantalón de juego del Real Betis de color verde', '25.50'),
(NULL, 2, 'Shorts Sevilla blanco', 'Pantalón de juego del Sevilla FC de color blanco', '25.50'),
(NULL, 3, 'Asics m210', 'Camiseta transpirable para training asics', '35.50'),
(NULL, 4, 'Marino warm Joma', 'Abrigo de pesca con exterior impermeable', '105.50'),
(NULL, 5, 'Gorra Lacoste minim blc', 'Gorra de golf marca Lacoste color blanco', '21.50'),
(NULL, 1, 'Nike Magista Azul', 'Botas de fútbol Nike Magista color azul', '45.20'),
(NULL, 3, 'Adidas Training T1', 'Camiseta sin mangas Adidas T1', '12.90');
*/
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `STOCK_PROVEEDOR` (
  `ID` varchar(9) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `TELEFONO` int DEFAULT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los proveedores';

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `suministro`
--

CREATE TABLE `STOCK_SUMINISTRO` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_TIENDA` int NOT NULL,
  `ID_ALMACEN` int NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (ID_TIENDA) REFERENCES STOCK_TIENDA(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los suministros de los almacenes hacia las tiendas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasuministro`
--

CREATE TABLE `STOCK_LINEASUMINISTRO` (
  `ID_SUMINISTRO` int NOT NULL,
  `ID_PRODUCTO` int NOT NULL,
  `UNIDADES` int NOT NULL,
  PRIMARY KEY (ID_SUMINISTRO, ID_PRODUCTO),
  FOREIGN KEY (ID_SUMINISTRO) REFERENCES STOCK_SUMINISTRO(ID),
  FOREIGN KEY (ID_PRODUCTO) REFERENCES STOCK_PRODUCTO(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las lineas de suministros de los almacenes hacia las tiendas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `STOCK_PEDIDO` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_ALMACEN` int NOT NULL,
  `ID_PROVEEDOR` varchar(9) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (ID_ALMACEN) REFERENCES STOCK_ALMACEN(ID),
  FOREIGN KEY (ID_PROVEEDOR) REFERENCES STOCK_PROVEEDOR(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los pedidos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineapedido`
--

CREATE TABLE `STOCK_LINEAPEDIDO` (
  `ID_PEDIDO` int NOT NULL,
  `ID_PRODUCTO` int NOT NULL,
  `UNIDADES` int NOT NULL,
  PRIMARY KEY (ID_PEDIDO, ID_PRODUCTO),
  FOREIGN KEY (ID_PEDIDO) REFERENCES STOCK_PEDIDO(ID),
  FOREIGN KEY (ID_PRODUCTO) REFERENCES STOCK_PRODUCTO(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las lineas de suministros de los almacenes hacia las tiendas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `STOCK_VENTA` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_TIENDA` int NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (ID_TIENDA) REFERENCES STOCK_TIENDA(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar los datos de las ventas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaventa`
--

CREATE TABLE `STOCK_LINEAVENTA` (
  `ID_VENTA` int NOT NULL,
  `ID_PRODUCTO` int NOT NULL,
  `UNIDADES` int NOT NULL,
  PRIMARY KEY (ID_VENTA, ID_PRODUCTO),
  FOREIGN KEY (ID_VENTA) REFERENCES STOCK_VENTA(ID),
  FOREIGN KEY (ID_PRODUCTO) REFERENCES STOCK_PRODUCTO(ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla para guardar las lineas de venta';

