-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2022 a las 14:43:43
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boutique`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrios`
--

CREATE TABLE `barrios` (
  `id_barrio` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_localidad` int(11) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `barrios`
--

INSERT INTO `barrios` (`id_barrio`, `descripcion`, `id_localidad`, `estado`) VALUES
(1, 'Holandas', 1, 2),
(2, 'Simon Bolivar', 2, 1),
(3, 'San Martin', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` char(100) DEFAULT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `estado`) VALUES
(1, 'Remeras', '1'),
(2, 'Hombres', '1'),
(3, 'Mujeres', '1'),
(4, 'Niños', '1'),
(5, 'prueba', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `estadoCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `fecha_alta`, `id_persona`, `estadoCliente`) VALUES
(1, '2022-03-06', 3, 1),
(2, '2022-03-06', 4, 1),
(3, '2022-03-06', 5, 1),
(4, '2022-03-07', 6, 1),
(5, '2022-03-07', 7, 1),
(6, '2022-03-07', 9, 1),
(7, '2022-04-06', 9, 1),
(8, '2022-04-06', 3, 2),
(9, '2022-04-06', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `id_detalle_pedido` int(11) NOT NULL,
  `precio_venta` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_pedido_cliente` int(11) DEFAULT NULL,
  `id_producto_talle` int(11) DEFAULT NULL,
  `id_producto_promocion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`id_detalle_pedido`, `precio_venta`, `cantidad`, `id_pedido_cliente`, `id_producto_talle`, `id_producto_promocion`) VALUES
(5, 2000, 12, 5, 2, 1),
(11, 1800, 2, 12, 5, 1),
(12, 2000, 1, 12, 1, 1),
(13, 1500, 12, 13, 8, 1),
(14, 1800, 2, 14, 5, 1),
(15, 2000, 2, 15, 2, 1),
(16, 2500, 3, 16, 19, 1),
(17, 2000, 2, 17, 32, 1),
(18, 2800, 2, 18, 37, 1),
(19, 2000, 2, 19, 29, 1),
(20, 1500, 2, 20, 23, 1),
(21, 2200, 2, 21, 10, 1),
(22, 2200, 2, 22, 10, 1),
(23, 2200, 2, 23, 10, 1),
(24, 2000, 2, 24, 26, 1),
(25, 2000, 2, 25, 26, 1),
(26, 1500, 3, 25, 23, 1),
(27, 2100, 2, 26, 2, 1),
(28, 2100, 3, 27, 2, 1),
(29, 1600, 3, 27, 7, 1),
(30, 2100, 3, 28, 2, 1),
(31, 2200, 3, 28, 11, 1),
(32, 1900, 2, 29, 5, 1),
(33, 2850, 3, 30, 6, 1),
(34, 2400, 4, 30, 7, 1),
(35, 2800, 2, 31, 33, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedidoimpuestos`
--

CREATE TABLE `detallepedidoimpuestos` (
  `id_DetallePedidoImpuesto` int(11) NOT NULL,
  `valor_porcentaje` float(8,0) DEFAULT NULL,
  `id_tipos_impositivos` int(11) DEFAULT NULL,
  `id_pedido_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallepedidoimpuestos`
--

INSERT INTO `detallepedidoimpuestos` (`id_DetallePedidoImpuesto`, `valor_porcentaje`, `id_tipos_impositivos`, `id_pedido_cliente`) VALUES
(1, 21, 1, 24),
(2, 10, 2, 24),
(3, 21, 1, 23),
(4, 10, 2, 23),
(5, 21, 1, 22),
(6, 10, 2, 22),
(7, 21, 1, 21),
(8, 10, 2, 21),
(9, 21, 1, 20),
(10, 10, 2, 20),
(11, 21, 1, 19),
(12, 10, 2, 19),
(13, 21, 1, 18),
(14, 10, 2, 18),
(15, 21, 1, 17),
(16, 10, 2, 17),
(17, 21, 1, 16),
(18, 10, 2, 16),
(19, 21, 1, 15),
(20, 10, 2, 15),
(21, 21, 1, 28),
(22, 10, 2, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedidoproveedor`
--

CREATE TABLE `detallepedidoproveedor` (
  `id_detalle_pedido_proveedor` int(11) NOT NULL,
  `precio` float(8,0) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `id_pedido_proveedor` int(11) DEFAULT NULL,
  `id_producto_talle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallepedidoproveedor`
--

INSERT INTO `detallepedidoproveedor` (`id_detalle_pedido_proveedor`, `precio`, `cantidad`, `id_pedido_proveedor`, `id_producto_talle`) VALUES
(2, 1500, 12, 2, 2),
(3, 1500, 20, 3, 1),
(4, 900, 2, 4, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id_devolucion` int(11) NOT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto_talle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios`
--

CREATE TABLE `domicilios` (
  `id_Domicilios` int(11) NOT NULL,
  `calle` varchar(30) DEFAULT NULL,
  `altura` varchar(30) DEFAULT NULL,
  `manzana` varchar(30) DEFAULT NULL,
  `numero_casa` varchar(30) DEFAULT NULL,
  `torre` varchar(30) DEFAULT NULL,
  `piso` varchar(30) DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `id_barrio` int(11) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `domicilios`
--

INSERT INTO `domicilios` (`id_Domicilios`, `calle`, `altura`, `manzana`, `numero_casa`, `torre`, `piso`, `observaciones`, `id_barrio`, `estado`) VALUES
(1, 'Republica de francia', '1500', '', '', '', '', '', 2, 1),
(2, 'Republica de francia', '1243', '', '', '', '', '', 2, 1),
(3, 'Republica de francia', '3200', '', '', '', '', '', 2, 1),
(4, 'Republica de Francias', '12222', '7', '25', '', '', '', 3, 1),
(5, 'Prueba', '2222', '', '', '', '', '', 2, 2),
(6, 'Republica de Francia', '2', '', '', '', '', '', 2, 1),
(7, 'Prueba', '2', '', '', '', '', '', 3, 2),
(8, 'Republica de Francia', '11', '32', '12', 'Lincoln', '2', '', 3, 1),
(9, 'Prueba', '12', '', '', '', '', '', 2, 2),
(10, 'Prueba', '12', '32', '12', '', '', '', 2, 2),
(11, 'Republica de francia', '3200', '', '', '', '', '', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_Empleado` int(11) NOT NULL,
  `numero_legajo` int(11) DEFAULT NULL,
  `fecha_Alta` timestamp NULL DEFAULT current_timestamp(),
  `cargo` char(30) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `estadoEmpleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_Empleado`, `numero_legajo`, `fecha_Alta`, `cargo`, `id_persona`, `estadoEmpleado`) VALUES
(1, 1111, '2022-03-06 18:30:07', NULL, 1, 1),
(2, 1234, '2022-03-07 20:36:46', NULL, 8, 1),
(3, 1234, '2022-03-07 21:43:54', NULL, 9, 1),
(4, 12345678, '2022-04-06 11:56:18', NULL, 9, 2),
(5, 12345678, '2022-04-06 11:57:54', NULL, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopedido`
--

CREATE TABLE `estadopedido` (
  `id_estado_pedido` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadopedido`
--

INSERT INTO `estadopedido` (`id_estado_pedido`, `descripcion`) VALUES
(1, 'Exitoso'),
(2, 'Cancelado'),
(3, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_pagos`
--

CREATE TABLE `estados_pagos` (
  `id_estados_pagos` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados_pagos`
--

INSERT INTO `estados_pagos` (`id_estados_pagos`, `descripcion`) VALUES
(1, 'Pagado'),
(2, 'Pendiente'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `numeracion` int(11) DEFAULT NULL,
  `FechaEmision` date DEFAULT NULL,
  `id_estados_pagos` int(11) DEFAULT NULL,
  `id_tipos_facturas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `numeracion`, `FechaEmision`, `id_estados_pagos`, `id_tipos_facturas`) VALUES
(4, 0, '2022-03-07', 1, 1),
(5, 1, '2022-03-07', 1, 2),
(6, 2, '2022-03-07', 1, 2),
(8, 3, '2022-03-07', 1, 1),
(12, 4, '2022-03-07', 1, 2),
(13, 5, '2022-03-07', 1, 1),
(14, 6, '2022-03-07', 1, 2),
(15, 7, '2022-03-07', 1, 2),
(16, 8, '2022-03-07', 1, 2),
(17, 9, '2022-03-07', 1, 2),
(18, 10, '2022-03-07', 1, 1),
(19, 11, '2022-03-07', 1, 1),
(20, 12, '2022-03-07', 1, 2),
(21, 13, '2022-03-07', 1, 2),
(22, 14, '2022-03-07', 1, 2),
(23, 15, '2022-03-07', 1, 2),
(24, 16, '2022-03-07', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaimpuestos`
--

CREATE TABLE `facturaimpuestos` (
  `id_DetalleFacturaImpuesto` int(11) NOT NULL,
  `valor_porcentaje` float(8,0) DEFAULT NULL,
  `id_tipos_impositivos` int(11) DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturaimpuestos`
--

INSERT INTO `facturaimpuestos` (`id_DetalleFacturaImpuesto`, `valor_porcentaje`, `id_tipos_impositivos`, `id_factura`) VALUES
(7, 21, 1, 4),
(8, 10, 2, 4),
(9, 21, 1, 5),
(10, 10, 2, 5),
(11, 21, 1, 6),
(12, 10, 2, 6),
(13, 21, 1, 6),
(14, 10, 2, 6),
(15, 21, 1, 8),
(16, 10, 2, 8),
(17, 21, 1, 8),
(18, 10, 2, 8),
(19, 21, 1, 8),
(20, 10, 2, 8),
(21, 21, 1, 8),
(22, 10, 2, 8),
(23, 21, 1, 12),
(24, 10, 2, 12),
(25, 21, 1, 13),
(26, 10, 2, 13),
(27, 21, 1, 14),
(28, 21, 1, 15),
(29, 10, 2, 15),
(30, 21, 1, 16),
(31, 10, 2, 16),
(32, 21, 1, 17),
(33, 10, 2, 17),
(34, 21, 1, 18),
(35, 10, 2, 18),
(36, 21, 1, 19),
(37, 10, 2, 19),
(38, 21, 1, 20),
(39, 10, 2, 20),
(40, 21, 1, 21),
(41, 10, 2, 21),
(42, 21, 1, 22),
(43, 10, 2, 22),
(44, 21, 1, 23),
(45, 10, 2, 23),
(46, 21, 1, 24),
(47, 10, 2, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturasdetalles`
--

CREATE TABLE `facturasdetalles` (
  `id_factura_detalle` int(11) NOT NULL,
  `id_detalle_pedido` int(11) DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturasdetalles`
--

INSERT INTO `facturasdetalles` (`id_factura_detalle`, `id_detalle_pedido`, `id_factura`) VALUES
(5, 5, 5),
(11, 11, 12),
(12, 12, 12),
(13, 13, 13),
(14, 14, 14),
(15, 15, 15),
(16, 16, 16),
(17, 22, 17),
(18, 25, 18),
(19, 26, 18),
(20, 17, 19),
(21, 27, 20),
(22, 28, 21),
(23, 29, 21),
(24, 32, 22),
(25, 33, 23),
(26, 34, 23),
(27, 35, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_pagos`
--

CREATE TABLE `facturas_pagos` (
  `id_facturas_pagos` int(11) NOT NULL,
  `valor_porcentaje` float(8,0) DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_tipos_pagos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id_localidad` int(11) NOT NULL,
  `descripcion` varchar(10) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id_localidad`, `descripcion`, `id_provincia`, `estado`) VALUES
(1, 'Holandas', 1, 2),
(2, 'Formosa', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `directorio` varchar(45) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `icono` varchar(200) DEFAULT NULL,
  `hijoDe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `descripcion`, `directorio`, `orden`, `nivel`, `icono`, `hijoDe`) VALUES
(1, 'Proveedores', 'proveedores', 5, 1, 'fas fa-truck', 0),
(2, 'Empleados', 'empleados', 0, 2, 'fas fa-user-tie', 22),
(3, 'Usuarios', 'usuarios', NULL, NULL, NULL, NULL),
(4, 'Clientes', 'clientes', 0, 2, 'fas fa-users', 22),
(5, 'Productos', 'productos', 4, 1, 'fas fa-tshirt', NULL),
(6, 'Categorias', 'categorias', NULL, 2, 'fab fa-buromobelexperte', 5),
(7, 'Temporadas', 'temporadas', NULL, 2, 'fa fa-calendar-alt', 5),
(8, 'Modulos', 'modulos', 0, 3, 'fa fa-bezier-curve', NULL),
(9, 'Perfiles', 'perfiles', NULL, 3, 'fa fa-user-shield', NULL),
(10, 'Promociones', 'promociones', NULL, 0, NULL, NULL),
(11, 'Ventas', 'ventas2', 2, 1, 'fas fa-coins', NULL),
(12, 'Compras', 'compras', 3, 1, 'fas fa-cart-arrow-down', NULL),
(13, 'Actualizacion de Precios', 'actualizarPrecios', 9, 2, 'fas fa-dollar-sign', 5),
(14, 'Domicilios', 'configuracionDomicilio', 0, 3, 'fa fa-map-marked-alt', NULL),
(15, 'Contactos', 'tipoContacto', 0, 3, 'fa fa-phone-alt', NULL),
(16, 'Pedidos Online', 'pedidos', 1, 1, 'fas fa-shopping-bag', NULL),
(17, 'Pagos', 'tiposPagos', NULL, 3, 'fa fa-credit-card', NULL),
(18, 'Impuestos', 'tiposImpositivos', NULL, 3, 'fa fa-percentage', NULL),
(19, 'Facturas', 'tiposFacturas', NULL, 3, 'fa fa-file-invoice-dollar', NULL),
(20, 'Reportes', 'reportes', 9, 5, 'fas fa-chart-bar', 0),
(21, 'Talles', 'talle', NULL, 2, 'fas fa-expand-arrows-alt', 5),
(22, 'Persona', 'persona', 6, 1, 'fas fa-users', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id_pais`, `descripcion`, `estado`) VALUES
(1, 'Argentina', 1),
(2, 'Paraguay', 1),
(3, 'Chile', 1),
(4, 'Uruguay', 2),
(5, 'Colombia', 2),
(6, 'Mexico', 2),
(11, 'Nueva Zelanda', NULL),
(12, 'Nueva Zelanda', 2),
(13, 'Alemanias', 2),
(14, 'Tucuman', 2),
(15, 'Tucuman', 2),
(16, 'Hoka', 2),
(17, 'Tucumane', 2),
(18, 'Holandas', 2),
(19, 'Chiles', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoclente`
--

CREATE TABLE `pedidoclente` (
  `id_pedido_cliente` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_Empleado` int(11) DEFAULT NULL,
  `id_estado_pedido` int(11) DEFAULT NULL,
  `total` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidoclente`
--

INSERT INTO `pedidoclente` (`id_pedido_cliente`, `fecha_hora`, `id_cliente`, `id_Empleado`, `id_estado_pedido`, `total`) VALUES
(5, '2022-03-07 00:59:41', 2, 1, 1, '24000.00'),
(12, '2022-03-07 01:21:39', 1, 1, 1, '5600.00'),
(13, '2022-03-07 01:22:40', 2, 1, 1, '18000.00'),
(14, '2022-03-07 01:26:36', 2, 1, 1, '3600.00'),
(15, '2022-03-07 01:28:58', 1, NULL, 1, '5240.00'),
(16, '2022-03-07 15:20:52', 5, NULL, 1, '9825.00'),
(17, '2022-03-07 15:59:55', 5, NULL, 1, '5240.00'),
(18, '2022-03-07 16:01:39', 5, NULL, 2, '7336.00'),
(19, '2022-03-07 16:03:01', 5, NULL, 2, '5240.00'),
(20, '2022-03-07 16:04:51', 5, NULL, 3, '3930.00'),
(21, '2022-03-07 16:05:35', 5, NULL, 2, '5764.00'),
(22, '2022-03-07 16:06:10', 5, NULL, 1, '5764.00'),
(23, '2022-03-07 16:06:32', 5, NULL, 2, '5764.00'),
(24, '2022-03-07 16:07:29', 5, NULL, 2, '5240.00'),
(25, '2022-03-07 14:27:53', 2, 1, 1, '8500.00'),
(26, '2022-03-07 16:17:28', 2, 1, 1, '4200.00'),
(27, '2022-03-07 16:18:56', 2, 1, 1, '11100.00'),
(28, '2022-03-07 16:25:05', 5, NULL, 3, '16899.00'),
(29, '2022-03-07 18:21:47', 3, 2, 1, '3800.00'),
(30, '2022-03-07 19:01:16', 5, 2, 1, '18150.00'),
(31, '2022-03-07 19:07:46', 1, NULL, 1, '7336.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproveedor`
--

CREATE TABLE `pedidoproveedor` (
  `id_pedido_proveedor` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `id_Empleado` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_estado_pedido` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidoproveedor`
--

INSERT INTO `pedidoproveedor` (`id_pedido_proveedor`, `fecha_hora`, `id_Empleado`, `id_proveedor`, `id_estado_pedido`, `total`) VALUES
(2, '2022-03-07 01:15:34', 1, 1, 1, 18000),
(3, '2022-03-07 16:49:07', 1, 1, 2, 30000),
(4, '2022-03-07 18:53:21', 1, 3, 1, 3200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descripcion`, `estado`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'VENDEDOR', 1),
(3, 'Cliente', 1),
(4, 'Cajeros', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_modulo`
--

CREATE TABLE `perfil_modulo` (
  `id_Perfil_Modulo` int(11) NOT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfil_modulo`
--

INSERT INTO `perfil_modulo` (`id_Perfil_Modulo`, `id_perfil`, `id_modulo`) VALUES
(738, 4, 11),
(739, 4, 12),
(740, 4, 19),
(741, 2, 5),
(742, 2, 11),
(743, 2, 12),
(785, 1, 1),
(786, 1, 2),
(787, 1, 3),
(788, 1, 4),
(789, 1, 5),
(790, 1, 6),
(791, 1, 7),
(792, 1, 9),
(793, 1, 10),
(794, 1, 11),
(795, 1, 12),
(796, 1, 13),
(797, 1, 14),
(798, 1, 15),
(799, 1, 16),
(800, 1, 17),
(801, 1, 18),
(802, 1, 19),
(803, 1, 20),
(804, 1, 21),
(805, 1, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(11) NOT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `nacionalidad` char(30) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_sexo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombre`, `apellido`, `dni`, `fecha_de_nacimiento`, `nacionalidad`, `estado`, `id_sexo`) VALUES
(1, 'Nicolas', 'Gauna', 41382584, '2022-03-03', 'Argentina', 1, 1),
(3, 'Clara', 'Lopez', 11111111, '0000-00-00', 'Argentina', 1, 2),
(4, 'Ricardo', 'Oviedo', 22223333, '2022-03-02', 'Argentina', 1, 1),
(5, 'Rodrigo', 'Lopez', 22222222, '0000-00-00', 'Argentina', 1, 1),
(6, 'Ricardo', 'Gauna', 23232323, '0000-00-00', '', 1, NULL),
(7, 'Pedro', 'Sosa', 12121212, '0000-00-00', '', 1, 1),
(8, 'Fernando', 'Gonzales', 12345678, '0000-00-00', 'Argentina', 1, 1),
(9, 'Prueba', 'Prueba', 12345673, '0000-00-00', 'Argentina', 1, NULL),
(10, 'Ricardo', 'Gauna', 21321212, '0000-00-00', 'Argentina', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_domicilio`
--

CREATE TABLE `persona_domicilio` (
  `id_persona_domicilio` int(11) NOT NULL,
  `id_Domicilios` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona_domicilio`
--

INSERT INTO `persona_domicilio` (`id_persona_domicilio`, `id_Domicilios`, `id_persona`) VALUES
(1, 3, 3),
(2, 4, 5),
(3, 5, 5),
(4, 8, 1),
(5, 9, 1),
(6, 10, 3),
(7, 11, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_tipocontacto`
--

CREATE TABLE `persona_tipocontacto` (
  `id_persona_tipo_contacto` int(11) NOT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_tipo_contacto` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona_tipocontacto`
--

INSERT INTO `persona_tipocontacto` (`id_persona_tipo_contacto`, `valor`, `id_persona`, `id_tipo_contacto`, `estado`) VALUES
(1, '3718509312', 3, 1, 1),
(2, '3132121312', 3, 2, 1),
(3, '3704092102', 3, 1, 1),
(4, '3704121212', 5, 2, 1),
(5, 'gaunanicolas3@gmail.com', 5, 3, 2),
(6, '3718111111', 1, 2, 1),
(7, 'gaunanicolas3@gmail.com', 1, 3, 2),
(8, 'gaunanicolas3@gmail.com', 3, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preventista`
--

CREATE TABLE `preventista` (
  `id_preventista` int(11) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `estadoPreventista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preventista`
--

INSERT INTO `preventista` (`id_preventista`, `id_proveedor`, `id_persona`, `estadoPreventista`) VALUES
(1, 1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `imagen` text DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `marca` varchar(10) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio_compra` float(8,0) DEFAULT NULL,
  `precio_venta` float(8,0) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_temporada` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `imagen`, `nombre`, `marca`, `descripcion`, `precio_compra`, `precio_venta`, `fecha`, `id_temporada`, `id_categoria`, `estado`) VALUES
(1, 'Imagenes/remera-hombre-sublimable.jpg', 'Remera Blanca', 'Adidas', 'Remera Blanca Marca Adidas', 1500, 3150, '2022-03-07 21:50:10', 1, 1, 1),
(9, 'Imagenes/descarga.jfif', 'Remera Verde', 'Nike', 'Remera Verde Marca Nike', 1000, 2850, '2022-03-07 21:50:11', 1, 1, 1),
(10, 'Imagenes/remera_azul_marino_lisa.jpg', 'Remera Azul Marino', 'Puma', 'Remera Azul Marina Marca Puma', 1600, 2400, '2022-03-07 21:53:21', 1, 1, 1),
(11, 'Imagenes/s-l225.jpg', 'Buzo Bordo', 'Puma', 'Buzo Hombre Puma', 1500, 2200, '0000-00-00 00:00:00', 2, 2, 1),
(12, 'Imagenes/images (1).jfif', 'Buzo Adidas', 'Adidas', 'Buzo Gris Hombre Adidas', 1700, 2500, '0000-00-00 00:00:00', 2, 2, 1),
(13, 'Imagenes/D_NQ_NP_907676-CBT47316722122_092021-W.jpg', 'Camisa Hombre', 'Puma', 'Camisa Hombre marca Puma', 1400, 1900, '0000-00-00 00:00:00', 1, 2, 1),
(14, 'Imagenes/210196378_ms.jfif', 'Vestido Negro', 'Mila Karte', 'Vestido Negro', 2000, 2500, '0000-00-00 00:00:00', 1, 3, 1),
(15, 'Imagenes/71CppV+zL+L._AC_UL1001_.jpg', 'Short Jean Mujer', 'Vernna', 'Short Jean Mujer', 1200, 1500, '0000-00-00 00:00:00', 1, 3, 1),
(16, 'Imagenes/remera-mujer-new-balance-transform-perfect-tee-wt81180pgh_40-_2_.jpg', 'Remera Mujer', 'Adidas', 'Remera Gris Mujer', 1500, 2000, '0000-00-00 00:00:00', 1, 3, 1),
(17, 'Imagenes/McysChildrenApparel-0827_02.jpg', 'Conjunto Remera y Short Niño', 'Puma', 'Conjunto Remera y Short Niño Marca Puma', 1400, 2000, '0000-00-00 00:00:00', 1, 4, 1),
(18, 'Imagenes/conjunto-sst-unisex.jpg', 'Conjunto Invierno Niño', 'Adidas', 'Conjunto Invierno Niño Adidas', 2000, 2800, '0000-00-00 00:00:00', 2, 4, 1),
(19, 'Imagenes/moda-infantil-6.jpg', 'Conjunto Infantil Urbano', 'Nike', 'Conjunto Infantil Urbano Marca Nike', 2000, 2800, '0000-00-00 00:00:00', 4, 4, 1),
(56, 'Imagenes/D_NQ_NP_726283-MLA43485283977_092020-W.jpg', 'Remera lila', 'Adidas', 'Remera Lila Marca Adidas', 1500, 3000, '2022-03-07 21:50:11', 1, 1, 2),
(58, 'Imagenes/Predeterminada.png', 'Abrigo Prueba', 'Adidas', 'Prenda Hombre', 1500, 4500, '2022-03-07 21:50:11', 1, 1, 1),
(60, 'Imagenes/moda-prendas-1592812876.jpg', 'Prueba Remera', 'Adidas', 'Prenda Hombre Remera', 1500, 2850, '2022-03-07 21:50:11', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productotalle`
--

CREATE TABLE `productotalle` (
  `id_producto_talle` int(11) NOT NULL,
  `cantidad_maxima` int(11) DEFAULT NULL,
  `cantidad_minima` int(11) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  `id_talle` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productotalle`
--

INSERT INTO `productotalle` (`id_producto_talle`, `cantidad_maxima`, `cantidad_minima`, `cantidad_disponible`, `id_talle`, `id_producto`, `estado`) VALUES
(1, 20, 5, 0, 5, 1, 1),
(2, 25, 10, 9, 6, 1, 1),
(3, 25, 5, 19, 4, 1, 2),
(4, 25, 5, 15, 1, 9, 1),
(5, 25, 5, 6, 2, 9, 1),
(6, 35, 7, 10, 3, 9, 1),
(7, 24, 4, 7, 4, 10, 1),
(8, 34, 8, 4, 2, 10, 1),
(9, 23, 9, 11, 3, 10, 1),
(10, 25, 6, 12, 4, 11, 1),
(11, 16, 3, 9, 5, 11, 1),
(12, 13, 4, 9, 6, 11, 1),
(13, 25, 5, 15, 4, 12, 1),
(14, 26, 4, 14, 5, 12, 1),
(15, 23, 7, 16, 6, 12, 1),
(16, 25, 7, 17, 4, 13, 1),
(17, 26, 7, 15, 5, 13, 1),
(18, 25, 7, 17, 6, 13, 1),
(19, 25, 6, 12, 4, 14, 1),
(20, 25, 7, 14, 5, 14, 1),
(21, 26, 7, 15, 6, 14, 1),
(22, 26, 7, 16, 4, 15, 1),
(23, 27, 8, 11, 5, 15, 1),
(24, 27, 9, 15, 6, 15, 1),
(25, 22, 8, 16, 4, 16, 1),
(26, 25, 5, 10, 5, 16, 1),
(27, 26, 5, 16, 6, 16, 1),
(28, 26, 8, 15, 4, 17, 1),
(29, 22, 7, 20, 5, 17, 1),
(32, 25, 5, 13, 6, 17, 1),
(33, 25, 5, 13, 4, 18, 1),
(34, 25, 5, 15, 5, 18, 1),
(35, 24, 7, 16, 6, 18, 1),
(36, 25, 5, 15, 4, 19, 1),
(37, 25, 10, 15, 5, 19, 1),
(38, 26, 8, 14, 6, 19, 1),
(39, 25, 4, 13, 4, 56, 1),
(40, 28, 6, 15, 4, 60, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_promocion`
--

CREATE TABLE `producto_promocion` (
  `id_producto_promocion` int(11) NOT NULL,
  `valor_porcentaje` float(8,0) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_promocion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_promocion`
--

INSERT INTO `producto_promocion` (`id_producto_promocion`, `valor_porcentaje`, `id_producto`, `id_promocion`) VALUES
(1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_promocion`, `nombre`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'BlackFriday', '2021-10-20', '2021-10-30'),
(3, 'Hot Sale', '2021-07-06', '2021-07-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` char(100) DEFAULT NULL,
  `cuit` bigint(13) DEFAULT NULL,
  `fecha_alta` timestamp NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `cuit`, `fecha_alta`, `estado`) VALUES
(1, 'Ropa SRL', 12345678911, '2022-03-07 03:51:13', 1),
(2, 'Pruebas', 122112121, '2022-03-07 15:34:09', 2),
(3, 'Indumentaria SA', 22222222, '2022-03-08 01:51:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_domicilio`
--

CREATE TABLE `proveedor_domicilio` (
  `id_proveedor_domicilio` int(11) NOT NULL,
  `id_Domicilios` int(11) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor_domicilio`
--

INSERT INTO `proveedor_domicilio` (`id_proveedor_domicilio`, `id_Domicilios`, `id_proveedor`) VALUES
(1, 6, 1),
(2, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_tipocontacto`
--

CREATE TABLE `proveedor_tipocontacto` (
  `id_proveedor_tipo_contacto` int(11) NOT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_tipo_contacto` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor_tipocontacto`
--

INSERT INTO `proveedor_tipocontacto` (`id_proveedor_tipo_contacto`, `valor`, `id_proveedor`, `id_tipo_contacto`, `estado`) VALUES
(1, '3704000000', 1, 2, 1),
(2, 'gaunanicolas3@gmail.com', 1, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `descripcion`, `id_pais`, `estado`) VALUES
(1, 'Holandas', 18, 2),
(2, 'Formosa', 1, 1),
(3, 'Chilesitos', 19, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `id_sexo` int(11) NOT NULL,
  `descripcion` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`id_sexo`, `descripcion`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talle`
--

CREATE TABLE `talle` (
  `id_talle` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `talle`
--

INSERT INTO `talle` (`id_talle`, `descripcion`, `estado`) VALUES
(1, '1', 1),
(2, '2', 1),
(3, '3', 1),
(4, 'M', 1),
(5, 'L', 1),
(6, 'XL', 1),
(7, 'XXL', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporada`
--

CREATE TABLE `temporada` (
  `id_temporada` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `anio` int(4) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `temporada`
--

INSERT INTO `temporada` (`id_temporada`, `nombre`, `anio`, `estado`) VALUES
(1, 'Verano', 2022, 1),
(2, 'Invierno', 2022, 1),
(3, 'Otoño', 2022, 1),
(4, 'Primavera', 2022, 1),
(5, 'Prueba', 2022, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_facturas`
--

CREATE TABLE `tipos_facturas` (
  `id_tipos_facturas` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_facturas`
--

INSERT INTO `tipos_facturas` (`id_tipos_facturas`, `descripcion`, `estado`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 1),
(4, 'D', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_impositivos`
--

CREATE TABLE `tipos_impositivos` (
  `id_tipos_impositivos` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `valor_porcentaje` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_impositivos`
--

INSERT INTO `tipos_impositivos` (`id_tipos_impositivos`, `descripcion`, `valor_porcentaje`, `estado`) VALUES
(1, 'IVA', 21, 1),
(2, 'Impuesto Provincial', 10, 1),
(3, 'Impuesto Municipales', 15, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_pagos`
--

CREATE TABLE `tipos_pagos` (
  `id_tipos_pagos` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `valor_porcentaje` int(11) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_pagos`
--

INSERT INTO `tipos_pagos` (`id_tipos_pagos`, `descripcion`, `valor_porcentaje`, `estado`) VALUES
(1, 'Efectivo', 10, 1),
(2, 'Tarjeta de Debito', 0, 1),
(3, 'Tarjeta de Credito', 0, 1),
(4, 'Mercado Pago', 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_contacto`
--

CREATE TABLE `tipo_de_contacto` (
  `id_tipo_contacto` int(11) NOT NULL,
  `descripcion` char(100) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_de_contacto`
--

INSERT INTO `tipo_de_contacto` (`id_tipo_contacto`, `descripcion`, `estado`) VALUES
(1, 'Telefono', 1),
(2, 'Celular', 1),
(3, 'Correo Electronico', 1),
(4, 'Twiter', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `username`, `password`, `id_perfil`, `id_persona`, `imagen`, `estado`) VALUES
(1, 'nicog', '1234', 1, 1, 'Imagenes/moda-prendas-1592812876.jpg', 1),
(2, 'cliente1', '1234', 3, 3, 'Imagenes/shopping (2).webp', 1),
(3, 'cliente2', '1234', 3, 4, 'Imagenes/empleados.png', 2),
(4, 'empleado1', '1234', 2, 1, 'Imagenes/perfil1.png', 1),
(5, 'cliente2', '1234', 3, 4, 'Imagenes/perfil1.png', 1),
(6, 'cliente3', '1234', 3, 7, 'Imagenes/perfil1.png', 1),
(7, 'empleado3', '1234', 2, 8, 'Imagenes/perfil1.png', 1),
(8, 'empleado5', '1234', 2, 10, 'Imagenes/default.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD PRIMARY KEY (`id_barrio`),
  ADD KEY `RefLocalidades53` (`id_localidad`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `RefPersona9` (`id_persona`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `RefProducto_Promocion87` (`id_producto_promocion`),
  ADD KEY `RefPedidoClente18` (`id_pedido_cliente`),
  ADD KEY `RefProductoTalle50` (`id_producto_talle`);

--
-- Indices de la tabla `detallepedidoimpuestos`
--
ALTER TABLE `detallepedidoimpuestos`
  ADD PRIMARY KEY (`id_DetallePedidoImpuesto`);

--
-- Indices de la tabla `detallepedidoproveedor`
--
ALTER TABLE `detallepedidoproveedor`
  ADD PRIMARY KEY (`id_detalle_pedido_proveedor`),
  ADD KEY `RefPedidoProveedor11` (`id_pedido_proveedor`),
  ADD KEY `RefProductoTalle63` (`id_producto_talle`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `RefCliente89` (`id_cliente`),
  ADD KEY `RefProductoTalle98` (`id_producto_talle`);

--
-- Indices de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  ADD PRIMARY KEY (`id_Domicilios`),
  ADD KEY `RefBarrios54` (`id_barrio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_Empleado`),
  ADD KEY `RefPersona8` (`id_persona`);

--
-- Indices de la tabla `estadopedido`
--
ALTER TABLE `estadopedido`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indices de la tabla `estados_pagos`
--
ALTER TABLE `estados_pagos`
  ADD PRIMARY KEY (`id_estados_pagos`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `RefEstados_Pagos80` (`id_estados_pagos`),
  ADD KEY `RefTipos_Facturas81` (`id_tipos_facturas`);

--
-- Indices de la tabla `facturaimpuestos`
--
ALTER TABLE `facturaimpuestos`
  ADD PRIMARY KEY (`id_DetalleFacturaImpuesto`),
  ADD KEY `RefTipos_Impositivos752` (`id_tipos_impositivos`),
  ADD KEY `RefFactura992` (`id_factura`);

--
-- Indices de la tabla `facturasdetalles`
--
ALTER TABLE `facturasdetalles`
  ADD PRIMARY KEY (`id_factura_detalle`),
  ADD KEY `RefDetallePedido73` (`id_detalle_pedido`),
  ADD KEY `RefFactura76` (`id_factura`);

--
-- Indices de la tabla `facturas_pagos`
--
ALTER TABLE `facturas_pagos`
  ADD PRIMARY KEY (`id_facturas_pagos`),
  ADD KEY `RefFactura78` (`id_factura`),
  ADD KEY `RefTipos_Pagos79` (`id_tipos_pagos`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id_localidad`),
  ADD KEY `RefProvincia52` (`id_provincia`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `pedidoclente`
--
ALTER TABLE `pedidoclente`
  ADD PRIMARY KEY (`id_pedido_cliente`),
  ADD KEY `RefCliente19` (`id_cliente`),
  ADD KEY `RefEmpleado20` (`id_Empleado`),
  ADD KEY `RefEstadoPedido35` (`id_estado_pedido`);

--
-- Indices de la tabla `pedidoproveedor`
--
ALTER TABLE `pedidoproveedor`
  ADD PRIMARY KEY (`id_pedido_proveedor`),
  ADD KEY `RefEmpleado10` (`id_Empleado`),
  ADD KEY `RefProveedor12` (`id_proveedor`),
  ADD KEY `RefEstadoPedido61` (`id_estado_pedido`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD PRIMARY KEY (`id_Perfil_Modulo`),
  ADD KEY `RefPerfil64` (`id_perfil`),
  ADD KEY `RefModulo65` (`id_modulo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `RefSexo97` (`id_sexo`);

--
-- Indices de la tabla `persona_domicilio`
--
ALTER TABLE `persona_domicilio`
  ADD PRIMARY KEY (`id_persona_domicilio`),
  ADD KEY `RefDomicilios59` (`id_Domicilios`),
  ADD KEY `RefPersona69` (`id_persona`);

--
-- Indices de la tabla `persona_tipocontacto`
--
ALTER TABLE `persona_tipocontacto`
  ADD PRIMARY KEY (`id_persona_tipo_contacto`),
  ADD KEY `RefPersona24` (`id_persona`),
  ADD KEY `RefTipo_de_Contacto25` (`id_tipo_contacto`);

--
-- Indices de la tabla `preventista`
--
ALTER TABLE `preventista`
  ADD PRIMARY KEY (`id_preventista`),
  ADD KEY `RefProveedor66` (`id_proveedor`),
  ADD KEY `RefPersona68` (`id_persona`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `RefTemporada71` (`id_temporada`),
  ADD KEY `RefCategoria85` (`id_categoria`);

--
-- Indices de la tabla `productotalle`
--
ALTER TABLE `productotalle`
  ADD PRIMARY KEY (`id_producto_talle`),
  ADD KEY `RefProducto91` (`id_producto`),
  ADD KEY `RefTalle42` (`id_talle`);

--
-- Indices de la tabla `producto_promocion`
--
ALTER TABLE `producto_promocion`
  ADD PRIMARY KEY (`id_producto_promocion`),
  ADD KEY `RefProducto83` (`id_producto`),
  ADD KEY `RefPromocion84` (`id_promocion`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `proveedor_domicilio`
--
ALTER TABLE `proveedor_domicilio`
  ADD PRIMARY KEY (`id_proveedor_domicilio`),
  ADD KEY `RefDomicilios60` (`id_Domicilios`),
  ADD KEY `RefProveedor70` (`id_proveedor`);

--
-- Indices de la tabla `proveedor_tipocontacto`
--
ALTER TABLE `proveedor_tipocontacto`
  ADD PRIMARY KEY (`id_proveedor_tipo_contacto`),
  ADD KEY `RefProveedor38` (`id_proveedor`),
  ADD KEY `RefTipo_de_Contacto40` (`id_tipo_contacto`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `RefPaises51` (`id_pais`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Indices de la tabla `talle`
--
ALTER TABLE `talle`
  ADD PRIMARY KEY (`id_talle`);

--
-- Indices de la tabla `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`id_temporada`);

--
-- Indices de la tabla `tipos_facturas`
--
ALTER TABLE `tipos_facturas`
  ADD PRIMARY KEY (`id_tipos_facturas`);

--
-- Indices de la tabla `tipos_impositivos`
--
ALTER TABLE `tipos_impositivos`
  ADD PRIMARY KEY (`id_tipos_impositivos`);

--
-- Indices de la tabla `tipos_pagos`
--
ALTER TABLE `tipos_pagos`
  ADD PRIMARY KEY (`id_tipos_pagos`);

--
-- Indices de la tabla `tipo_de_contacto`
--
ALTER TABLE `tipo_de_contacto`
  ADD PRIMARY KEY (`id_tipo_contacto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `RefPerfil30` (`id_perfil`),
  ADD KEY `RefPersona96` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barrios`
--
ALTER TABLE `barrios`
  MODIFY `id_barrio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `detallepedidoimpuestos`
--
ALTER TABLE `detallepedidoimpuestos`
  MODIFY `id_DetallePedidoImpuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `detallepedidoproveedor`
--
ALTER TABLE `detallepedidoproveedor`
  MODIFY `id_detalle_pedido_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  MODIFY `id_Domicilios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_Empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estadopedido`
--
ALTER TABLE `estadopedido`
  MODIFY `id_estado_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estados_pagos`
--
ALTER TABLE `estados_pagos`
  MODIFY `id_estados_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `facturaimpuestos`
--
ALTER TABLE `facturaimpuestos`
  MODIFY `id_DetalleFacturaImpuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `facturasdetalles`
--
ALTER TABLE `facturasdetalles`
  MODIFY `id_factura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `facturas_pagos`
--
ALTER TABLE `facturas_pagos`
  MODIFY `id_facturas_pagos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `pedidoclente`
--
ALTER TABLE `pedidoclente`
  MODIFY `id_pedido_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `pedidoproveedor`
--
ALTER TABLE `pedidoproveedor`
  MODIFY `id_pedido_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  MODIFY `id_Perfil_Modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=806;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `persona_domicilio`
--
ALTER TABLE `persona_domicilio`
  MODIFY `id_persona_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `persona_tipocontacto`
--
ALTER TABLE `persona_tipocontacto`
  MODIFY `id_persona_tipo_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `preventista`
--
ALTER TABLE `preventista`
  MODIFY `id_preventista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `productotalle`
--
ALTER TABLE `productotalle`
  MODIFY `id_producto_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `producto_promocion`
--
ALTER TABLE `producto_promocion`
  MODIFY `id_producto_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor_domicilio`
--
ALTER TABLE `proveedor_domicilio`
  MODIFY `id_proveedor_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor_tipocontacto`
--
ALTER TABLE `proveedor_tipocontacto`
  MODIFY `id_proveedor_tipo_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `talle`
--
ALTER TABLE `talle`
  MODIFY `id_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id_temporada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipos_facturas`
--
ALTER TABLE `tipos_facturas`
  MODIFY `id_tipos_facturas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos_impositivos`
--
ALTER TABLE `tipos_impositivos`
  MODIFY `id_tipos_impositivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_pagos`
--
ALTER TABLE `tipos_pagos`
  MODIFY `id_tipos_pagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_de_contacto`
--
ALTER TABLE `tipo_de_contacto`
  MODIFY `id_tipo_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD CONSTRAINT `RefLocalidades53` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `RefPersona9` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `RefPedidoClente18` FOREIGN KEY (`id_pedido_cliente`) REFERENCES `pedidoclente` (`id_pedido_cliente`),
  ADD CONSTRAINT `RefProductoTalle50` FOREIGN KEY (`id_producto_talle`) REFERENCES `productotalle` (`id_producto_talle`),
  ADD CONSTRAINT `RefProducto_Promocion87` FOREIGN KEY (`id_producto_promocion`) REFERENCES `producto_promocion` (`id_producto_promocion`);

--
-- Filtros para la tabla `detallepedidoproveedor`
--
ALTER TABLE `detallepedidoproveedor`
  ADD CONSTRAINT `RefPedidoProveedor11` FOREIGN KEY (`id_pedido_proveedor`) REFERENCES `pedidoproveedor` (`id_pedido_proveedor`),
  ADD CONSTRAINT `RefProductoTalle63` FOREIGN KEY (`id_producto_talle`) REFERENCES `productotalle` (`id_producto_talle`);

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `RefCliente89` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `RefProductoTalle98` FOREIGN KEY (`id_producto_talle`) REFERENCES `productotalle` (`id_producto_talle`);

--
-- Filtros para la tabla `domicilios`
--
ALTER TABLE `domicilios`
  ADD CONSTRAINT `RefBarrios54` FOREIGN KEY (`id_barrio`) REFERENCES `barrios` (`id_barrio`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `RefPersona8` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `RefEstados_Pagos80` FOREIGN KEY (`id_estados_pagos`) REFERENCES `estados_pagos` (`id_estados_pagos`),
  ADD CONSTRAINT `RefTipos_Facturas81` FOREIGN KEY (`id_tipos_facturas`) REFERENCES `tipos_facturas` (`id_tipos_facturas`);

--
-- Filtros para la tabla `facturaimpuestos`
--
ALTER TABLE `facturaimpuestos`
  ADD CONSTRAINT `RefFactura992` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `RefTipos_Impositivos752` FOREIGN KEY (`id_tipos_impositivos`) REFERENCES `tipos_impositivos` (`id_tipos_impositivos`);

--
-- Filtros para la tabla `facturasdetalles`
--
ALTER TABLE `facturasdetalles`
  ADD CONSTRAINT `RefDetallePedido73` FOREIGN KEY (`id_detalle_pedido`) REFERENCES `detallepedido` (`id_detalle_pedido`),
  ADD CONSTRAINT `RefFactura76` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`);

--
-- Filtros para la tabla `facturas_pagos`
--
ALTER TABLE `facturas_pagos`
  ADD CONSTRAINT `RefFactura78` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `RefTipos_Pagos79` FOREIGN KEY (`id_tipos_pagos`) REFERENCES `tipos_pagos` (`id_tipos_pagos`);

--
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD CONSTRAINT `RefProvincia52` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id_provincia`);

--
-- Filtros para la tabla `pedidoclente`
--
ALTER TABLE `pedidoclente`
  ADD CONSTRAINT `RefCliente19` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `RefEmpleado20` FOREIGN KEY (`id_Empleado`) REFERENCES `empleado` (`id_Empleado`),
  ADD CONSTRAINT `RefEstadoPedido35` FOREIGN KEY (`id_estado_pedido`) REFERENCES `estadopedido` (`id_estado_pedido`);

--
-- Filtros para la tabla `pedidoproveedor`
--
ALTER TABLE `pedidoproveedor`
  ADD CONSTRAINT `RefEmpleado10` FOREIGN KEY (`id_Empleado`) REFERENCES `empleado` (`id_Empleado`),
  ADD CONSTRAINT `RefEstadoPedido61` FOREIGN KEY (`id_estado_pedido`) REFERENCES `estadopedido` (`id_estado_pedido`),
  ADD CONSTRAINT `RefProveedor12` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `perfil_modulo`
--
ALTER TABLE `perfil_modulo`
  ADD CONSTRAINT `RefModulo65` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`),
  ADD CONSTRAINT `RefPerfil64` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `RefSexo97` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`);

--
-- Filtros para la tabla `persona_domicilio`
--
ALTER TABLE `persona_domicilio`
  ADD CONSTRAINT `RefDomicilios59` FOREIGN KEY (`id_Domicilios`) REFERENCES `domicilios` (`id_Domicilios`),
  ADD CONSTRAINT `RefPersona69` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `persona_tipocontacto`
--
ALTER TABLE `persona_tipocontacto`
  ADD CONSTRAINT `RefPersona24` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `RefTipo_de_Contacto25` FOREIGN KEY (`id_tipo_contacto`) REFERENCES `tipo_de_contacto` (`id_tipo_contacto`);

--
-- Filtros para la tabla `preventista`
--
ALTER TABLE `preventista`
  ADD CONSTRAINT `RefPersona68` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `RefProveedor66` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `RefCategoria85` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `RefTemporada71` FOREIGN KEY (`id_temporada`) REFERENCES `temporada` (`id_temporada`);

--
-- Filtros para la tabla `productotalle`
--
ALTER TABLE `productotalle`
  ADD CONSTRAINT `RefProducto91` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `RefTalle42` FOREIGN KEY (`id_talle`) REFERENCES `talle` (`id_talle`);

--
-- Filtros para la tabla `producto_promocion`
--
ALTER TABLE `producto_promocion`
  ADD CONSTRAINT `RefProducto83` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `RefPromocion84` FOREIGN KEY (`id_promocion`) REFERENCES `promocion` (`id_promocion`);

--
-- Filtros para la tabla `proveedor_domicilio`
--
ALTER TABLE `proveedor_domicilio`
  ADD CONSTRAINT `RefDomicilios60` FOREIGN KEY (`id_Domicilios`) REFERENCES `domicilios` (`id_Domicilios`),
  ADD CONSTRAINT `RefProveedor70` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `proveedor_tipocontacto`
--
ALTER TABLE `proveedor_tipocontacto`
  ADD CONSTRAINT `RefProveedor38` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `RefTipo_de_Contacto40` FOREIGN KEY (`id_tipo_contacto`) REFERENCES `tipo_de_contacto` (`id_tipo_contacto`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `RefPaises51` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `RefPerfil30` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `RefPersona96` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
