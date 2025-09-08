-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-09-2025 a las 03:09:07
-- Versión del servidor: 10.11.10-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u155356178_saludapos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AbonoCreditos_Clinicas_POS`
--

CREATE TABLE `AbonoCreditos_Clinicas_POS` (
  `Folio_Abono` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_tipo_Credi` varchar(250) NOT NULL,
  `Fk_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `SaldoPrevio` decimal(50,2) NOT NULL,
  `Cant_Abono` decimal(50,2) NOT NULL,
  `CantidadProductos` int(11) NOT NULL,
  `Fecha_Abono` date NOT NULL,
  `Saldo` decimal(52,2) NOT NULL,
  `Fk_Producto` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `AbonoCreditos_Clinicas_POS`
--
DELIMITER $$
CREATE TRIGGER `Resta_CrediStock` AFTER INSERT ON `AbonoCreditos_Clinicas_POS` FOR EACH ROW Update Stock_POS
set Stock_POS.Existencias_R = Stock_POS.Existencias_R- NEW.CantidadProductos
where Stock_POS.ID_Prod_POS = NEW.Fk_Producto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AbonoCreditos_POS`
--

CREATE TABLE `AbonoCreditos_POS` (
  `Folio_Abono` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_tipo_Credi` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `Cant_Apertura` decimal(50,2) NOT NULL,
  `Cant_Abono` decimal(50,2) NOT NULL,
  `Fecha_Abono` date NOT NULL,
  `Saldo` decimal(52,2) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Administracion_Sistema`
--

CREATE TABLE `Administracion_Sistema` (
  `Admin_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `Password` varchar(10) DEFAULT NULL,
  `Estatus` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Advertencias_Inventario`
--

CREATE TABLE `Advertencias_Inventario` (
  `ID_Advertencia` int(11) NOT NULL,
  `ID_Sucursal` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Cantidad_Faltante` decimal(10,2) NOT NULL,
  `Procedimiento` varchar(255) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AgendaCitas_EspecialistasExt`
--

CREATE TABLE `AgendaCitas_EspecialistasExt` (
  `ID_Agenda_Especialista` int(12) NOT NULL,
  `Fk_Especialidad` int(12) NOT NULL,
  `Fk_Especialista` int(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Fecha` int(11) NOT NULL,
  `Hora` int(11) NOT NULL,
  `Nombre_Paciente` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Tipo_Consulta` varchar(150) NOT NULL,
  `Asistio` varchar(100) NOT NULL,
  `Estatus_cita` varchar(150) NOT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `AgendadoPor` varchar(200) NOT NULL,
  `ActualizoEstado` varchar(250) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `Fecha_Hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Color_Calendario` varchar(200) NOT NULL,
  `GoogleEventId` varchar(500) DEFAULT NULL,
  `IDGoogleCalendar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `AgendaCitas_EspecialistasExt`
--
DELIMITER $$
CREATE TRIGGER `CancelacionesExt` AFTER DELETE ON `AgendaCitas_EspecialistasExt` FOR EACH ROW INSERT INTO Cancelaciones_Ext
    (ID_Agenda_Especialista,Fk_Especialidad,Fk_Especialista, Fk_Sucursal,Fecha,Hora,Nombre_Paciente,Telefono, Tipo_Consulta,Estatus_cita,Observaciones,ID_H_O_D,AgendadoPor, Sistema,Fecha_Hora,Color_Calendario)
    VALUES
    (OLD.ID_Agenda_Especialista,OLD.Fk_Especialidad,OLD.Fk_Especialista, OLD.Fk_Sucursal,OLD.Fecha,OLD.Hora,OLD.Nombre_Paciente,OLD.Telefono, OLD.Tipo_Consulta,OLD.Estatus_cita,OLD.Observaciones,OLD.ID_H_O_D,OLD.AgendadoPor, OLD.Sistema,OLD.Fecha_Hora,OLD.Color_Calendario)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Agenda_Labs`
--

CREATE TABLE `Agenda_Labs` (
  `Id_genda` int(11) NOT NULL,
  `Nombres_Apellidos` varchar(150) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Fk_sucursal` int(11) NOT NULL,
  `Turno` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  `LabAgendado` varchar(500) NOT NULL,
  `Agrego` varchar(150) NOT NULL,
  `Indicaciones` varchar(350) NOT NULL,
  `Asistio` varchar(100) NOT NULL,
  `Num_Orden` int(11) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(350) NOT NULL,
  `ID_H_O_D` varchar(350) NOT NULL,
  `Hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Agenda_revaloraciones`
--

CREATE TABLE `Agenda_revaloraciones` (
  `Id_genda` int(11) NOT NULL,
  `Nombres_Apellidos` varchar(150) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Fk_sucursal` int(11) NOT NULL,
  `Medico` varchar(150) NOT NULL,
  `Fecha` date NOT NULL,
  `Turno` varchar(100) NOT NULL,
  `Motivo_Consulta` varchar(150) NOT NULL,
  `Asistio` varchar(100) NOT NULL,
  `Agrego` varchar(150) NOT NULL,
  `ActualizoEstado` varchar(100) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AjustesDeInventarios`
--

CREATE TABLE `AjustesDeInventarios` (
  `Folio_Ingreso` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `ExistenciaPrev` int(11) NOT NULL,
  `Recibido` int(11) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Aperturas_Cajon`
--

CREATE TABLE `Aperturas_Cajon` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `ImpresoPor` varchar(200) NOT NULL,
  `fkSucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Areas_Credit_POS`
--

CREATE TABLE `Areas_Credit_POS` (
  `ID_Area_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Area` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Areas_Credit_POS`
--
DELIMITER $$
CREATE TRIGGER `Audita_AreaCred` AFTER INSERT ON `Areas_Credit_POS` FOR EACH ROW INSERT INTO Areas_Credit_POS_Audita
    (ID_Area_Cred,Nombre_Area,	Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Area_Cred,NEW.Nombre_Area,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_AreaCred_Updates` AFTER UPDATE ON `Areas_Credit_POS` FOR EACH ROW INSERT INTO Areas_Credit_POS_Audita
    (ID_Area_Cred,Nombre_Area,	Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Area_Cred,NEW.Nombre_Area,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Areas_Credit_POS_Audita`
--

CREATE TABLE `Areas_Credit_POS_Audita` (
  `ID_Audita_Ar_Cred` int(11) NOT NULL,
  `ID_Area_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Area` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Area_De_Notificaciones`
--

CREATE TABLE `Area_De_Notificaciones` (
  `ID_Notificacion` int(11) NOT NULL,
  `Encabezado` varchar(200) NOT NULL,
  `Tipo_Notificacion` varchar(200) NOT NULL,
  `Mensaje_Notificacion` varchar(500) NOT NULL,
  `Registrado` varchar(200) NOT NULL,
  `Sistema` varchar(150) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Num_Factura` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Area_Enfermeria`
--

CREATE TABLE `Area_Enfermeria` (
  `Enfermero_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `Pass_Enfermero` varchar(10) DEFAULT NULL,
  `ID_Sucursal` varchar(150) DEFAULT NULL,
  `ID_H_O_D` varchar(200) DEFAULT NULL,
  `FK_rol` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Audita_Cambios_StockPruebas`
--

CREATE TABLE `Audita_Cambios_StockPruebas` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Id_Audita` int(11) NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Cod_Enfermeria` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkCategoria` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkMarca` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkPresentacion` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `ActualizoFecha` varchar(200) NOT NULL,
  `Cod_Paquete` int(11) NOT NULL,
  `Inventariable` varchar(100) NOT NULL,
  `Fecha_Insercion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cajas_POS`
--

CREATE TABLE `Cajas_POS` (
  `ID_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Fondo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cantidad_Fondo` decimal(50,2) NOT NULL,
  `Empleado` varchar(250) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Turno` varchar(300) NOT NULL,
  `Asignacion` int(11) NOT NULL,
  `D1000` decimal(11,0) NOT NULL,
  `D500` int(11) NOT NULL,
  `D200` int(11) NOT NULL,
  `D100` int(11) NOT NULL,
  `D50` int(11) NOT NULL,
  `D20` int(11) NOT NULL,
  `D10` int(11) NOT NULL,
  `D5` int(11) NOT NULL,
  `D2` int(11) NOT NULL,
  `D1` int(11) NOT NULL,
  `D50C` int(11) NOT NULL,
  `D20C` int(11) NOT NULL,
  `D10C` int(11) NOT NULL,
  `Valor_Total_Caja` decimal(50,2) NOT NULL,
  `Hora_apertura` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Hora_real_apertura` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `MedicoEnturno` varchar(200) NOT NULL,
  `EnfermeroEnturno` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Cajas_POS`
--
DELIMITER $$
CREATE TRIGGER `Audita_Cajas_POS` AFTER INSERT ON `Cajas_POS` FOR EACH ROW INSERT INTO Cajas_POS_Audita
    (ID_Caja,Fk_Fondo,Cantidad_Fondo,Empleado,Sucursal,Estatus,CodigoEstatus,Fecha_Apertura,Turno,Asignacion,D1000,D500,D200,D100,D50,D20,D10,D5,D2,D1,D50C,D20C,D10C,Valor_Total_Caja,Hora_apertura,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Caja,NEW.Fk_Fondo,NEW.Cantidad_Fondo,NEW.Empleado,NEW.Sucursal,NEW.Estatus,NEW.CodigoEstatus,NEW.Fecha_Apertura,NEW.Turno,NEW.Asignacion,NEW.D1000,NEW.D500,NEW.D200,NEW.D100,NEW.D50,NEW.D20,NEW.D10,NEW.D5,NEW.D2,NEW.D1,NEW.D50C,NEW.D20C,NEW.D10C,NEW.Valor_Total_Caja,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_Cajas_POS_Updates` AFTER UPDATE ON `Cajas_POS` FOR EACH ROW INSERT INTO Cajas_POS_Audita
    (ID_Caja,Fk_Fondo,Cantidad_Fondo,Empleado,Sucursal,Estatus,CodigoEstatus,Fecha_Apertura,Turno,Asignacion,D1000,D500,D200,D100,D50,D20,D10,D5,D2,D1,D50C,D20C,D10C,Valor_Total_Caja,Hora_apertura,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Caja,NEW.Fk_Fondo,NEW.Cantidad_Fondo,NEW.Empleado,NEW.Sucursal,NEW.Estatus,NEW.CodigoEstatus,NEW.Fecha_Apertura,NEW.Turno,NEW.Asignacion,NEW.D1000,NEW.D500,NEW.D200,NEW.D100,NEW.D50,NEW.D20,NEW.D10,NEW.D5,NEW.D2,NEW.D1,NEW.D50C,NEW.D20C,NEW.D10C,NEW.Valor_Total_Caja,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cajas_POS_Audita`
--

CREATE TABLE `Cajas_POS_Audita` (
  `ID_Caja_Audita` int(11) NOT NULL,
  `ID_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Fondo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cantidad_Fondo` decimal(50,2) NOT NULL,
  `Empleado` varchar(250) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Turno` varchar(300) NOT NULL,
  `Asignacion` int(11) NOT NULL,
  `D1000` decimal(11,0) NOT NULL,
  `D500` int(11) NOT NULL,
  `D200` int(11) NOT NULL,
  `D100` int(11) NOT NULL,
  `D50` int(11) NOT NULL,
  `D20` int(11) NOT NULL,
  `D10` int(11) NOT NULL,
  `D5` int(11) NOT NULL,
  `D2` int(11) NOT NULL,
  `D1` int(11) NOT NULL,
  `D50C` int(11) NOT NULL,
  `D20C` int(11) NOT NULL,
  `D10C` int(11) NOT NULL,
  `Valor_Total_Caja` decimal(50,2) NOT NULL,
  `Hora_apertura` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cancelaciones_Agenda`
--

CREATE TABLE `Cancelaciones_Agenda` (
  `ID_Agenda_Especialista` int(12) NOT NULL,
  `Fk_Especialidad` int(12) NOT NULL,
  `Fk_Especialista` int(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Fk_Fecha` int(12) NOT NULL,
  `Fk_Hora` int(12) NOT NULL,
  `Fk_Costo` int(12) NOT NULL,
  `Folio_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Paciente` varchar(200) NOT NULL,
  `Tipo_Consulta` varchar(150) NOT NULL,
  `Estatus_pago` varchar(200) NOT NULL,
  `Color_Pago` varchar(200) NOT NULL,
  `Estatus_cita` varchar(150) NOT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `ColorEstatusCita` varchar(100) NOT NULL,
  `Estatus_Seguimiento` varchar(200) NOT NULL,
  `Color_Seguimiento` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `AgendadoPor` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `Fecha_Hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cancelaciones_AgendaSucursales`
--

CREATE TABLE `Cancelaciones_AgendaSucursales` (
  `ID_Cancelacion` int(11) NOT NULL,
  `ID_Agenda_Especialista` int(12) NOT NULL,
  `Fk_Especialidad` int(12) NOT NULL,
  `Fk_Especialista` int(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Fecha` int(11) NOT NULL,
  `Hora` int(11) NOT NULL,
  `Costo` int(12) NOT NULL,
  `Nombre_Paciente` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Tipo_Consulta` varchar(150) NOT NULL,
  `Estatus_cita` varchar(150) NOT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `AgendadoPor` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `Fecha_Hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Color_Calendario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cancelaciones_AgendaV2`
--

CREATE TABLE `Cancelaciones_AgendaV2` (
  `ID_Cancelacion` int(11) NOT NULL,
  `ID_Agenda_Especialista` int(12) NOT NULL,
  `Fk_Especialidad` int(12) NOT NULL,
  `Fk_Especialista` int(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Fk_Fecha` int(12) NOT NULL,
  `Fk_Hora` int(12) NOT NULL,
  `Fk_Costo` int(12) NOT NULL,
  `Nombre_Paciente` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Tipo_Consulta` varchar(150) NOT NULL,
  `Estatus_pago` varchar(200) NOT NULL,
  `Color_Pago` varchar(200) NOT NULL,
  `Estatus_cita` varchar(150) NOT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `ColorEstatusCita` varchar(100) NOT NULL,
  `Estatus_Seguimiento` varchar(200) NOT NULL,
  `Color_Seguimiento` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `AgendadoPor` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `Fecha_Hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `Color_Calendario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cancelaciones_Ext`
--

CREATE TABLE `Cancelaciones_Ext` (
  `ID_CancelacionExt` int(11) NOT NULL,
  `ID_Agenda_Especialista` int(12) NOT NULL,
  `Fk_Especialidad` int(12) NOT NULL,
  `Fk_Especialista` int(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Fecha` int(11) NOT NULL,
  `Hora` int(11) NOT NULL,
  `Nombre_Paciente` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Tipo_Consulta` varchar(150) NOT NULL,
  `Estatus_cita` varchar(150) NOT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `AgendadoPor` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `Fecha_Hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Color_Calendario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CARRITOS`
--

CREATE TABLE `CARRITOS` (
  `ID_CARRITO` int(11) NOT NULL,
  `ID_SUCURSAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias_Gastos_POS`
--

CREATE TABLE `Categorias_Gastos_POS` (
  `Cat_Gasto_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Cat_Gasto` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias_POS`
--

CREATE TABLE `Categorias_POS` (
  `Cat_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Cat` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Categorias_POS`
--
DELIMITER $$
CREATE TRIGGER `Categorias_Audita` AFTER INSERT ON `Categorias_POS` FOR EACH ROW INSERT INTO Categorias_POS_Updates
    (Cat_ID,Nom_Cat,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Cat_ID,NEW.Nom_Cat,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Categorias_Updates` AFTER UPDATE ON `Categorias_POS` FOR EACH ROW INSERT INTO Categorias_POS_Updates
    (Cat_ID,Nom_Cat,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Cat_ID,NEW.Nom_Cat,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categorias_POS_Updates`
--

CREATE TABLE `Categorias_POS_Updates` (
  `ID_Update` int(11) NOT NULL,
  `Cat_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Cat` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CierresDeInventarios`
--

CREATE TABLE `CierresDeInventarios` (
  `Id_Cierre` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `SucursalDestino` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Piezas` int(12) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `FechaInventario` date NOT NULL,
  `TipoMov` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `CierresDeInventarios`
--
DELIMITER $$
CREATE TRIGGER `actualizar_stock_y_otra_tabla` AFTER INSERT ON `CierresDeInventarios` FOR EACH ROW BEGIN
    -- Actualización combinada en una sola instrucción UPDATE para Stock_POS (Suma)
    UPDATE Stock_POS
    SET 
        Existencias_R = Existencias_R + NEW.Piezas,  
        TipoMov = NEW.TipoMov,                       
        AgregadoPor = NEW.AgregadoPor     
    WHERE Cod_Barra = NEW.Cod_Barra
      AND Fk_sucursal = NEW.SucursalDestino;         -- 
    UPDATE InventariosStocks_Conteos
    SET 
        Comentario = NEW.TipoMov,
        Tipo_Ajuste = "Baja de inventario"           -- Actualizar Tipo_Ajuste con un valor fijo
    WHERE Folio_Prod_Stock = NEW.Folio_Prod_Stock;

    -- Nueva operación de resta en Stock_POS
    UPDATE Stock_POS
    SET 
        Existencias_R = Existencias_R - NEW.Piezas,  -- Restar el valor de Piezas a Existencias_R
        TipoMov = NEW.TipoMov,                       -- Actualizar TipoMov
        AgregadoPor = NEW.AgregadoPor               -- Actualizar AgregadoPor
    WHERE Cod_Barra = NEW.Cod_Barra
      AND Fk_sucursal = New.Fk_sucursal;                 -- Usar el valor existente de Fk_sucursal

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CodigosSinResultadosEnStockInventario`
--

CREATE TABLE `CodigosSinResultadosEnStockInventario` (
  `Id_Cod` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `FechaInventario` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_HO_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `CodigosSinResultadosEnStockInventario`
--
DELIMITER $$
CREATE TRIGGER `tr_insertar_en_stock_pos` AFTER INSERT ON `CodigosSinResultadosEnStockInventario` FOR EACH ROW BEGIN
    DECLARE var_id_prod_pos INT;
    DECLARE var_clave_adicional VARCHAR(255);
    DECLARE var_cod_enfermeria VARCHAR(255);
    DECLARE var_clave_levic VARCHAR(255);
    DECLARE var_nombre_prod VARCHAR(255);
    DECLARE var_precio_venta DECIMAL(10,2);
    DECLARE var_precio_c DECIMAL(10,2);
    DECLARE var_max_existencia INT;
    DECLARE var_min_existencia INT;
    DECLARE var_tipo_servicio VARCHAR(255);
    DECLARE var_fk_categoria INT;
    DECLARE var_fk_marca INT;
    DECLARE var_fk_presentacion INT;
    DECLARE var_proveedor1 VARCHAR(255);
    DECLARE var_proveedor2 VARCHAR(255);
    DECLARE var_cod_barra VARCHAR(255);
   
    
    SELECT ID_Prod_POS, Clave_adicional, Cod_Enfermeria, Clave_Levic, Nombre_Prod, Precio_Venta, Precio_C, Max_Existencia, Min_Existencia, Tipo_Servicio, FkCategoria, FkMarca, FkPresentacion, Proveedor1, Proveedor2, Cod_Barra
    INTO var_id_prod_pos, var_clave_adicional, var_cod_enfermeria, var_clave_levic, var_nombre_prod, var_precio_venta, var_precio_c, var_max_existencia, var_min_existencia, var_tipo_servicio, var_fk_categoria, var_fk_marca, var_fk_presentacion, var_proveedor1, var_proveedor2, var_cod_barra
    FROM Productos_POS
    WHERE Cod_Barra = NEW.Cod_Barra; 
    
    
    IF var_id_prod_pos IS NOT NULL THEN
        INSERT INTO Stock_POS (ID_Prod_POS, Clave_adicional, Cod_Enfermeria, Clave_Levic, Cod_Barra, Nombre_Prod, Fk_sucursal, Precio_Venta, Precio_C, Max_Existencia, Min_Existencia, Tipo_Servicio, ID_H_O_D)
        VALUES (var_id_prod_pos, var_clave_adicional, var_cod_enfermeria, var_clave_levic, var_cod_barra, var_nombre_prod, NEW.Fk_sucursal, var_precio_venta, var_precio_c, var_max_existencia, var_min_existencia, var_tipo_servicio, NEW.ID_HO_D);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ComponentesActivos`
--

CREATE TABLE `ComponentesActivos` (
  `ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Com` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Consultas`
--

CREATE TABLE `Consultas` (
  `Id_consulta` int(11) NOT NULL,
  `Id_expediente` int(11) DEFAULT NULL,
  `Id_paciente` int(11) DEFAULT NULL,
  `Medico` int(11) DEFAULT NULL,
  `Fecha_consulta` timestamp NULL DEFAULT current_timestamp(),
  `Motivo_consulta` text DEFAULT NULL,
  `Observaciones` text DEFAULT NULL,
  `Diagnostico` text DEFAULT NULL,
  `Tratamiento` text DEFAULT NULL,
  `Estudios` text DEFAULT NULL,
  `Recomendaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `Consultas`
--
DELIMITER $$
CREATE TRIGGER `gestionar_expediente` AFTER INSERT ON `Consultas` FOR EACH ROW BEGIN
    DECLARE expediente_exists INT;
    
    
    SELECT COUNT(*) INTO expediente_exists 
    FROM Expediente_Medico 
    WHERE Id_expediente = NEW.Id_expediente;
    
    
    IF expediente_exists = 0 THEN
        INSERT INTO Expediente_Medico (
            Id_expediente, 
            Id_paciente, 
            Fecha_creacion, 
            Fecha_ultima_modificacion, 
            Antecedentes_personales,
            Antecedentes_familiares,
            Medicamentos_actuales,
            Diagnosticos, 
            Estudios_realizados, 
            Tratamientos, 
            Notas, 
            Notas_adicionales,
            Modificado_Por
        ) VALUES (
            NEW.Id_expediente, 
            NEW.Id_paciente, 
            NOW(), 
            NOW(), 
            '',  
            '', 
            '', 
            NEW.Diagnostico, 
            NEW.Estudios, 
            NEW.Tratamiento, 
            NEW.Observaciones, 
            NEW.Recomendaciones,
            NEW.Medico  
        );
    
    ELSE
        UPDATE Expediente_Medico
        SET 
            Fecha_ultima_modificacion = NOW(), 
            Diagnosticos = NEW.Diagnostico, 
            Estudios_realizados = NEW.Estudios, 
            Tratamientos = NEW.Tratamiento, 
            Notas = NEW.Observaciones, 
            Notas_adicionales = NEW.Recomendaciones,
            Modificado_Por = NEW.Medico  
        WHERE Id_expediente = NEW.Id_expediente;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ConteosDiarios`
--

CREATE TABLE `ConteosDiarios` (
  `Folio_Ingreso` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(250) NOT NULL,
  `Nombre_Producto` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `ExistenciaFisica` int(11) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos_corporativo`
--

CREATE TABLE `correos_corporativo` (
  `id` int(11) NOT NULL,
  `user_o_correo` varchar(200) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `pin` varchar(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  `departamento` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cortes_Cajas_POS`
--

CREATE TABLE `Cortes_Cajas_POS` (
  `ID_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Caja` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Empleado` varchar(250) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Turno` varchar(300) NOT NULL,
  `Ticket_Inicial` int(11) NOT NULL,
  `Ticket_Final` int(11) NOT NULL,
  `TotalTickets` int(11) NOT NULL,
  `D1000` decimal(11,0) NOT NULL,
  `D500` int(11) NOT NULL,
  `D200` int(11) NOT NULL,
  `D100` int(11) NOT NULL,
  `D50` int(11) NOT NULL,
  `D20` int(11) NOT NULL,
  `D10` int(11) NOT NULL,
  `D5` int(11) NOT NULL,
  `D2` int(11) NOT NULL,
  `D1` int(11) NOT NULL,
  `D50C` int(11) NOT NULL,
  `D20C` int(11) NOT NULL,
  `D10C` int(11) NOT NULL,
  `Valor_Total_Caja` decimal(50,2) NOT NULL,
  `Hora_Cierre` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Cortes_Cajas_POS`
--
DELIMITER $$
CREATE TRIGGER `Cierre_Caja` AFTER INSERT ON `Cortes_Cajas_POS` FOR EACH ROW Update Cajas_POS
set Cajas_POS.Estatus ="Cerrada",Cajas_POS.CodigoEstatus="background-color: #ff9900 !important;",Cajas_POS.Valor_Total_Caja = NEW.Valor_Total_Caja
where Cajas_POS.ID_Caja = NEW.Fk_Caja
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Costos_Especialistas`
--

CREATE TABLE `Costos_Especialistas` (
  `ID_Costo_Esp` int(11) NOT NULL,
  `Costo_Especialista` decimal(10,2) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `FK_Especialista` int(12) NOT NULL,
  `Añadido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UsuarioAnade` varchar(200) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `Codigocolor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Costos_EspecialistasV2`
--

CREATE TABLE `Costos_EspecialistasV2` (
  `ID_Costo_Esp` int(11) NOT NULL,
  `Costo_Especialista` decimal(10,2) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `FK_Especialista` int(12) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `Codigocolor` varchar(200) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cotizaciones_POS`
--

CREATE TABLE `Cotizaciones_POS` (
  `ID_Cotizacion` int(11) NOT NULL,
  `IdentificadorCotizacion` varchar(50) NOT NULL,
  `Cod_Barra` varchar(50) DEFAULT NULL,
  `Nombre_Prod` varchar(255) NOT NULL,
  `Fk_sucursal` int(11) NOT NULL,
  `Precio_Venta` decimal(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `FkPresentacion` int(11) DEFAULT NULL,
  `Proveedor1` varchar(255) DEFAULT NULL,
  `Proveedor2` varchar(255) DEFAULT NULL,
  `AgregadoPor` varchar(255) NOT NULL,
  `ID_H_O_D` varchar(50) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `TipoCotizacion` varchar(50) NOT NULL,
  `ID_Caja` int(11) NOT NULL,
  `NombreCliente` varchar(255) DEFAULT NULL,
  `TelefonoCliente` varchar(20) DEFAULT NULL,
  `ArchivoPDF` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Creditos_Clinicas_POS`
--

CREATE TABLE `Creditos_Clinicas_POS` (
  `Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_tipo_Credi` varchar(250) NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `Cant_Apertura` decimal(50,2) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Termino` date NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL,
  `Saldo` decimal(52,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Creditos_Clinicas_POS_Audita`
--

CREATE TABLE `Creditos_Clinicas_POS_Audita` (
  `Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_tipo_Credi` varchar(250) NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `Cant_Apertura` decimal(50,2) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Termino` date NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL,
  `Saldo` decimal(52,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Creditos_POS`
--

CREATE TABLE `Creditos_POS` (
  `Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_tipo_Credi` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `Edad` varchar(50) NOT NULL,
  `Sexo` varchar(100) NOT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Cant_Apertura` decimal(50,2) NOT NULL,
  `Costo_Tratamiento` decimal(50,2) NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Fecha_Termino` date NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Odontologo` varchar(250) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL,
  `Promocion` varchar(300) NOT NULL,
  `Costo_Descuento` decimal(50,2) NOT NULL,
  `Validez` date NOT NULL,
  `Area` varchar(250) NOT NULL,
  `Saldo` decimal(52,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Creditos_POS`
--
DELIMITER $$
CREATE TRIGGER `Audita_Credi` BEFORE INSERT ON `Creditos_POS` FOR EACH ROW INSERT INTO Creditos_POS_Audita
    (Folio_Credito,Fk_tipo_Credi,Nombre_Cred,Edad,Sexo,Direccion,	Telefono,Cant_Apertura,Costo_Tratamiento,Fecha_Apertura,Fecha_Termino,	Fk_Sucursal,Odontologo,Estatus,CodigoEstatus,Agrega,	AgregadoEl,Sistema,ID_H_O_D,Promocion,Costo_Descuento,Validez,Area,Saldo)
    VALUES (NEW.Folio_Credito,NEW.Fk_tipo_Credi,NEW.Nombre_Cred,NEW.Edad,NEW.Sexo,NEW.Direccion,NEW.Telefono,NEW.Cant_Apertura,NEW.Costo_Tratamiento,NEW.Fecha_Apertura,NEW.Fecha_Termino,	NEW.Fk_Sucursal,NEW.Odontologo,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,	Now(),NEW.Sistema,NEW.ID_H_O_D,NEW.Promocion,NEW.Costo_Descuento,NEW.Validez,NEW.Area,NEW.Saldo)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_Credi_Update` BEFORE UPDATE ON `Creditos_POS` FOR EACH ROW INSERT INTO Creditos_POS_Audita
    (Folio_Credito,Fk_tipo_Credi,Nombre_Cred,Edad,Sexo,Direccion,	Telefono,Cant_Apertura,Costo_Tratamiento,Fecha_Apertura,Fecha_Termino,	Fk_Sucursal,Odontologo,Estatus,CodigoEstatus,Agrega,	AgregadoEl,Sistema,ID_H_O_D,Promocion,Costo_Descuento,Validez,Area,Saldo)
    VALUES (NEW.Folio_Credito,NEW.Fk_tipo_Credi,NEW.Nombre_Cred,NEW.Edad,NEW.Sexo,NEW.Direccion,NEW.Telefono,NEW.Cant_Apertura,NEW.Costo_Tratamiento,NEW.Fecha_Apertura,NEW.Fecha_Termino,	NEW.Fk_Sucursal,NEW.Odontologo,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,	Now(),NEW.Sistema,NEW.ID_H_O_D,NEW.Promocion,NEW.Costo_Descuento,NEW.Validez,NEW.Area,NEW.Saldo)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Creditos_POS_Audita`
--

CREATE TABLE `Creditos_POS_Audita` (
  `Audita_Credi_POS` int(11) NOT NULL,
  `Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_tipo_Credi` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `Edad` varchar(50) NOT NULL,
  `Sexo` varchar(100) NOT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Cant_Apertura` decimal(50,2) NOT NULL,
  `Costo_Tratamiento` decimal(50,2) NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Fecha_Termino` date NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Odontologo` varchar(250) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL,
  `Promocion` varchar(250) NOT NULL,
  `Costo_Descuento` decimal(50,2) NOT NULL,
  `Validez` date NOT NULL,
  `Area` varchar(250) NOT NULL,
  `Saldo` decimal(52,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Data_Facturacion_POS`
--

CREATE TABLE `Data_Facturacion_POS` (
  `ID_Factura` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_RazonSocial` varchar(250) NOT NULL,
  `RFC` varchar(250) NOT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Uso_CFDI` varchar(250) NOT NULL,
  `Telefono` varchar(250) NOT NULL,
  `Fk_Ticket` varchar(100) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Correo` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Data_Pacientes`
--

CREATE TABLE `Data_Pacientes` (
  `ID_Data_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Paciente` varchar(150) DEFAULT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Edad` varchar(100) DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Alergias` varchar(250) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `FK_ID_H_O_D` varchar(150) NOT NULL,
  `Ingreso` varchar(250) NOT NULL,
  `Ingresadoen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Data_Pacientes`
--
DELIMITER $$
CREATE TRIGGER `Actualizaciones_Pacientes` BEFORE UPDATE ON `Data_Pacientes` FOR EACH ROW INSERT INTO Data_Pacientes_Updates
    (ID_Data_Paciente,Nombre_Paciente,Fecha_Nacimiento,Edad,Sexo,Alergias,Telefono,Correo,FK_ID_H_O_D,Ingreso,Ingresadoen,Sistema)
    VALUES (NEW.ID_Data_Paciente,NEW.Nombre_Paciente,NEW.Fecha_Nacimiento,NEW.Edad,NEW.Sexo,NEW.Alergias,NEW.Telefono,NEW.Correo,NEW.FK_ID_H_O_D,NEW.Ingreso,Now(),NEW.Sistema)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Data_Pacientes_Respaldo`
--

CREATE TABLE `Data_Pacientes_Respaldo` (
  `ID_Data_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Paciente` varchar(150) DEFAULT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Edad` varchar(100) DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Alergias` varchar(250) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `FK_ID_H_O_D` varchar(150) NOT NULL,
  `Ingreso` varchar(250) NOT NULL,
  `Ingresadoen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Data_Pacientes_RespaldoV2`
--

CREATE TABLE `Data_Pacientes_RespaldoV2` (
  `ID_Data_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Paciente` varchar(150) DEFAULT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Edad` varchar(100) DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Alergias` varchar(250) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `FK_ID_H_O_D` varchar(150) NOT NULL,
  `Ingreso` varchar(250) NOT NULL,
  `Ingresadoen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Data_Pacientes_Updates`
--

CREATE TABLE `Data_Pacientes_Updates` (
  `ID_Update` int(11) NOT NULL,
  `ID_Data_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Paciente` varchar(150) DEFAULT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Edad` varchar(100) DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Alergias` varchar(250) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `FK_ID_H_O_D` varchar(150) NOT NULL,
  `Ingreso` varchar(250) NOT NULL,
  `Ingresadoen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Datos_Generales_Personal`
--

CREATE TABLE `Datos_Generales_Personal` (
  `ID_Personal` int(11) NOT NULL COMMENT 'Folio del personal',
  `Nombre_Apellidos` varchar(250) DEFAULT NULL COMMENT 'Nombre y apellidos del personal',
  `Curp` varchar(30) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento del usuario',
  `RFC` varchar(30) DEFAULT NULL COMMENT 'Rfc del usuario',
  `Sexo` varchar(30) DEFAULT NULL COMMENT 'Sexo del usuario',
  `Estado_civil` varchar(100) NOT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL COMMENT 'corre del usuario',
  `Telefono` varchar(12) DEFAULT NULL COMMENT 'telefono del usuario',
  `Telefono_particular` varchar(12) NOT NULL,
  `NSS` varchar(30) DEFAULT NULL COMMENT 'numero de seguro social',
  `Alergias` varchar(200) DEFAULT NULL COMMENT 'alergias del usuario',
  `Tipo_sangre` varchar(10) DEFAULT NULL COMMENT 'tipo de sangre del usuario',
  `Calle` varchar(200) NOT NULL,
  `NInterior` varchar(10) NOT NULL,
  `NExterior` varchar(10) NOT NULL,
  `Cruzamientos` varchar(200) NOT NULL,
  `Colonia` varchar(200) NOT NULL,
  `Cp` varchar(200) NOT NULL,
  `Estado` varchar(250) NOT NULL,
  `Municipio` varchar(350) NOT NULL,
  `Localidad` varchar(350) NOT NULL,
  `ID_H_O_D` varchar(200) DEFAULT NULL COMMENT 'LICENCIA',
  `Folio_Contrato` varchar(200) DEFAULT NULL COMMENT 'folio de contrato del usuario',
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'en que fecha se agrego u edito',
  `AgregadoPor` varchar(200) DEFAULT NULL COMMENT 'quien agrega',
  `Contacto1` varchar(200) NOT NULL,
  `Contacto2` varchar(200) NOT NULL,
  `Parentezco1` varchar(200) NOT NULL,
  `Parentezco2` varchar(200) NOT NULL,
  `C_Emerge1` varchar(12) DEFAULT NULL COMMENT 'contacto de emergencia',
  `C_Emerge2` varchar(12) DEFAULT NULL COMMENT 'contacto de emergencia',
  `Sistema` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departamentos`
--

CREATE TABLE `Departamentos` (
  `ID_Departamento` int(11) NOT NULL,
  `Nombre_Departamento` varchar(250) DEFAULT NULL,
  `ID_H_O_D` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Devolucion_POS`
--

CREATE TABLE `Devolucion_POS` (
  `ID_Registro` int(11) NOT NULL,
  `Num_Factura` varchar(200) DEFAULT NULL,
  `Cod_Barra` varchar(200) DEFAULT NULL,
  `Nombre_Produc` varchar(100) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Fk_Suc_Salida` int(12) DEFAULT NULL,
  `Motivo_Devolucion` varchar(400) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Agrego` varchar(200) NOT NULL,
  `HoraAgregado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `NumOrde` int(12) NOT NULL,
  `Movimiento` varchar(300) NOT NULL,
  `NumTicket` int(11) NOT NULL,
  `Estatus` varchar(300) NOT NULL,
  `Proveedor` varchar(300) NOT NULL,
  `FechaLlegada` date NOT NULL,
  `ActualizadoPor` varchar(300) NOT NULL,
  `ActualizadoEl` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `diciembreenero`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `diciembreenero` (
`ID_SignoV` int(11)
,`Folio_Paciente` int(12) unsigned zerofill
,`Nombre_Paciente` varchar(150)
,`Motivo_Consulta` varchar(250)
,`Nombre_Doctor` varchar(250)
,`Edad` varchar(150)
,`Sexo` varchar(20)
,`Telefono` varchar(20)
,`Fk_Enfermero` varchar(200)
,`Fk_Sucursal` varchar(150)
,`FK_ID_H_O_D` varchar(150)
,`Fecha_Visita` timestamp
,`Estatus` varchar(150)
,`CodigoEstatus` varchar(150)
,`ID_Data_Paciente` int(12) unsigned zerofill
,`Fecha_Nacimiento` date
,`ID_SucursalC` int(11)
,`Nombre_Sucursal` varchar(200)
,`Edad_Calculada` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `role` enum('personal','administrativo') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `Token` varchar(300) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Latitud` varchar(300) NOT NULL,
  `Longitud` varchar(300) NOT NULL,
  `sucursal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Encargados_Citas`
--

CREATE TABLE `Encargados_Citas` (
  `Encargado_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `Password` varchar(10) DEFAULT NULL,
  `ID_Sucursal` varchar(150) DEFAULT NULL,
  `ID_H_O_D` varchar(200) DEFAULT NULL,
  `Fk_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EncargosCancelados`
--

CREATE TABLE `EncargosCancelados` (
  `Id_Cancelacion` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Id_Encargo` varchar(500) NOT NULL,
  `IdentificadorEncargo` varchar(300) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `EstadoAnterior` varchar(300) NOT NULL,
  `EstadoNuevo` varchar(300) NOT NULL,
  `MotivoCancelacion` varchar(500) NOT NULL,
  `FechaCancelacion` timestamp NULL DEFAULT current_timestamp(),
  `Fk_sucursal` int(12) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `EncargosCancelados`
--
DELIMITER $$
CREATE TRIGGER `trigger_movimientos_encargos` AFTER INSERT ON `EncargosCancelados` FOR EACH ROW BEGIN
    INSERT INTO MovimientosEncargos (
        Id_Encargo,
        IdentificadorEncargo,
        Cod_Barra,
        Nombre_Prod,
        EstadoAnterior,
        EstadoNuevo,
        FechaMovimiento,
        Fk_sucursal,
        Cantidad,
        Precio_Venta,
        ID_H_O_D
    )
    VALUES (
        NEW.Id_Encargo,
        NEW.IdentificadorEncargo,
        NEW.Cod_Barra,
        NEW.Nombre_Prod,
        NEW.EstadoAnterior,
        NEW.EstadoNuevo,
        NOW(), 
        NEW.Fk_sucursal,
        NEW.Cantidad,
        NEW.Precio_Venta,
        NEW.ID_H_O_D
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EncargosSaldados`
--

CREATE TABLE `EncargosSaldados` (
  `Id_Saldado` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Id_Encargo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `IdentificadorEncargo` varchar(300) NOT NULL,
  `NombreCliente` varchar(300) NOT NULL,
  `TelefonoCliente` varchar(500) NOT NULL,
  `MetodoDePago` varchar(300) NOT NULL,
  `MontoAbonado` decimal(50,2) DEFAULT NULL,
  `FechaSaldado` timestamp NULL DEFAULT current_timestamp(),
  `Fk_sucursal` int(12) NOT NULL,
  `Estado` varchar(300) NOT NULL,
  `TipoEncargo` varchar(300) NOT NULL,
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Encargos_POS`
--

CREATE TABLE `Encargos_POS` (
  `Id_Encargo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `IdentificadorEncargo` varchar(300) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `NombreCliente` varchar(300) NOT NULL,
  `TelefonoCliente` varchar(500) NOT NULL,
  `MetodoDePago` varchar(300) NOT NULL,
  `MontoAbonado` decimal(50,2) DEFAULT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `Fk_Caja` int(11) NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `Estado` varchar(300) NOT NULL,
  `TipoEncargo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Encargos_POS`
--
DELIMITER $$
CREATE TRIGGER `Aumenta_CajaEncargos2` AFTER INSERT ON `Encargos_POS` FOR EACH ROW UPDATE Cajas_POS
SET Cajas_POS.Valor_Total_Caja = Cajas_POS.Valor_Total_Caja + NEW.MontoAbonado
        WHERE Cajas_POS.ID_Caja = NEW.Fk_Caja
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_encargos_saldados` AFTER UPDATE ON `Encargos_POS` FOR EACH ROW BEGIN
    
    IF (SELECT COUNT(*) 
        FROM Encargos_POS 
        WHERE IdentificadorEncargo = NEW.IdentificadorEncargo) = 
       (SELECT COUNT(*) 
        FROM Encargos_POS 
        WHERE IdentificadorEncargo = NEW.IdentificadorEncargo 
        AND Estado IN ('saldado', 'entregado')) THEN

        INSERT INTO EncargosSaldados (Id_Encargo, IdentificadorEncargo, NombreCliente, TelefonoCliente, MetodoDePago, MontoAbonado, Fk_sucursal, Estado, TipoEncargo, ID_H_O_D)
        SELECT DISTINCT Id_Encargo, IdentificadorEncargo, NombreCliente, TelefonoCliente, MetodoDePago, SUM(MontoAbonado), Fk_sucursal, Estado, TipoEncargo, ID_H_O_D
        FROM Encargos_POS
        WHERE IdentificadorEncargo = NEW.IdentificadorEncargo
        GROUP BY IdentificadorEncargo;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_movimientos_encargos` AFTER UPDATE ON `Encargos_POS` FOR EACH ROW BEGIN
    IF NEW.Estado IN ('Saldado', 'Entregado') AND OLD.Estado <> NEW.Estado THEN
        INSERT INTO MovimientosEncargos (Id_Encargo, IdentificadorEncargo, Cod_Barra, Nombre_Prod, EstadoAnterior, EstadoNuevo, Fk_sucursal, Cantidad, Precio_Venta, ID_H_O_D)
        VALUES (NEW.Id_Encargo, NEW.IdentificadorEncargo, NEW.Cod_Barra, NEW.Nombre_Prod, OLD.Estado, NEW.Estado, NEW.Fk_sucursal, NEW.Cantidad, NEW.Precio_Venta, NEW.ID_H_O_D);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Errores_Log`
--

CREATE TABLE `Errores_Log` (
  `ID` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Error` varchar(255) NOT NULL,
  `Detalle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Errores_Stock`
--

CREATE TABLE `Errores_Stock` (
  `id` int(11) NOT NULL,
  `error_message` varchar(255) DEFAULT NULL,
  `error_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Especialidades_Express`
--

CREATE TABLE `Especialidades_Express` (
  `ID_Especialidad` int(11) NOT NULL,
  `Nombre_Especialidad` varchar(250) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus_Especialidad` varchar(200) NOT NULL,
  `Agregadoen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AgregadoPor` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Especialidades_Express`
--
DELIMITER $$
CREATE TRIGGER `Audita_EspecialidadesExpress` AFTER INSERT ON `Especialidades_Express` FOR EACH ROW INSERT INTO Especialidades_Express_Audita
 (ID_Especialidad, Nombre_Especialidad, ID_H_O_D,Estatus_Especialidad, Agregadoen,AgregadoPor,Sistema)
 VALUES
 (NEW.ID_Especialidad, NEW.Nombre_Especialidad, NEW.ID_H_O_D,NEW.Estatus_Especialidad,now(),NEW.AgregadoPor,NEW.Sistema)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_EspecialidadesExpress_updates` AFTER UPDATE ON `Especialidades_Express` FOR EACH ROW INSERT INTO Especialidades_Express_Audita
 (ID_Especialidad, Nombre_Especialidad, ID_H_O_D,Estatus_Especialidad, Agregadoen,AgregadoPor,Sistema)
 VALUES
 (NEW.ID_Especialidad, NEW.Nombre_Especialidad, NEW.ID_H_O_D,NEW.Estatus_Especialidad,now(),NEW.AgregadoPor,NEW.Sistema)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Especialidades_Express_Audita`
--

CREATE TABLE `Especialidades_Express_Audita` (
  `ID_Auditoria` int(11) NOT NULL,
  `ID_Especialidad` int(11) NOT NULL,
  `Nombre_Especialidad` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus_Especialidad` varchar(200) NOT NULL,
  `Agregadoen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AgregadoPor` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Especialistas`
--

CREATE TABLE `Especialistas` (
  `ID_Especialista` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(150) NOT NULL,
  `Especialidad` int(10) NOT NULL,
  `Tel` varchar(12) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Estatus_Especialista` varchar(200) NOT NULL,
  `CodigoColorEs` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EspecialistasV2`
--

CREATE TABLE `EspecialistasV2` (
  `ID_Especialista` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(150) NOT NULL,
  `Especialidad` int(10) NOT NULL,
  `Tel` varchar(12) NOT NULL,
  `Correo` varchar(150) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Estatus_Especialista` varchar(200) NOT NULL,
  `CodigoColorEs` varchar(200) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estados`
--

CREATE TABLE `Estados` (
  `ID_Estado` int(11) NOT NULL,
  `Nombre_Estado` varchar(200) NOT NULL,
  `Añadido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Event_Log`
--

CREATE TABLE `Event_Log` (
  `id` int(11) NOT NULL,
  `event_name` varchar(50) DEFAULT NULL,
  `executed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Expediente_Medico`
--

CREATE TABLE `Expediente_Medico` (
  `Id_expediente` int(11) NOT NULL,
  `Id_paciente` int(11) DEFAULT NULL,
  `Modificado_Por` int(11) DEFAULT NULL,
  `Fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `Fecha_ultima_modificacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Antecedentes_personales` text DEFAULT NULL,
  `Antecedentes_familiares` text DEFAULT NULL,
  `Medicamentos_actuales` text DEFAULT NULL,
  `Diagnosticos` text DEFAULT NULL,
  `Estudios_realizados` text DEFAULT NULL,
  `Tratamientos` text DEFAULT NULL,
  `Notas` text DEFAULT NULL,
  `Notas_adicionales` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fechas_EspecialistasExt`
--

CREATE TABLE `Fechas_EspecialistasExt` (
  `ID_Fecha_Esp` int(11) NOT NULL,
  `Fecha_Disponibilidad` date NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `FK_Especialista` int(12) NOT NULL,
  `Fk_Programacion` int(11) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `Agrego` varchar(200) NOT NULL,
  `Agregadoen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Fechas_EspecialistasExt`
--
DELIMITER $$
CREATE TRIGGER `ActualizaFechas` AFTER INSERT ON `Fechas_EspecialistasExt` FOR EACH ROW Update Programacion_MedicosExt
set Programacion_MedicosExt.Estatus ="Autorizar Horas"
where Programacion_MedicosExt.ID_Programacion = NEW.Fk_Programacion
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fondos_Cajas`
--

CREATE TABLE `Fondos_Cajas` (
  `ID_Fon_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Fondo_Caja` decimal(50,2) NOT NULL,
  `Estatus` varchar(100) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `AgregadoPor` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Fondos_Cajas`
--
DELIMITER $$
CREATE TRIGGER `Audita_FonCaja` AFTER INSERT ON `Fondos_Cajas` FOR EACH ROW INSERT INTO Fondos_Cajas_Audita
    (ID_Fon_Caja,Fk_Sucursal,Fondo_Caja,	Estatus,CodigoEstatus,AgregadoPor,AgregadoEl,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Fon_Caja,NEW.Fk_Sucursal,NEW.Fondo_Caja,NEW.Estatus,NEW.CodigoEstatus,NEW.AgregadoPor,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_FonCaja_Updates` AFTER UPDATE ON `Fondos_Cajas` FOR EACH ROW INSERT INTO Fondos_Cajas_Audita
    (ID_Fon_Caja,Fk_Sucursal,Fondo_Caja,	Estatus,CodigoEstatus,AgregadoPor,AgregadoEl,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Fon_Caja,NEW.Fk_Sucursal,NEW.Fondo_Caja,NEW.Estatus,NEW.CodigoEstatus,NEW.AgregadoPor,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fondos_Cajas_Audita`
--

CREATE TABLE `Fondos_Cajas_Audita` (
  `ID_Audita_FonCaja` int(11) NOT NULL,
  `ID_Fon_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `Fondo_Caja` decimal(50,2) NOT NULL,
  `Estatus` varchar(100) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `AgregadoPor` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fotografias`
--

CREATE TABLE `Fotografias` (
  `photoid` int(11) NOT NULL,
  `Fk_Nombre_paciente` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Historial_Cambios_Lotes`
--

CREATE TABLE `Historial_Cambios_Lotes` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `fecha_caducidad_anterior` date NOT NULL,
  `fecha_caducidad_nueva` date NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `modificado_por` varchar(100) DEFAULT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Horarios_Citas_Ext`
--

CREATE TABLE `Horarios_Citas_Ext` (
  `ID_Horario` int(11) NOT NULL,
  `Horario_Disponibilidad` time NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `FK_Especialista` int(12) NOT NULL,
  `FK_Fecha` int(11) NOT NULL,
  `Fk_Programacion` int(11) NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hospital_Organizacion_Dueño`
--

CREATE TABLE `Hospital_Organizacion_Dueño` (
  `ID_ID` int(11) NOT NULL,
  `H_O_D` varchar(200) NOT NULL,
  `Logo_identidad` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huellas`
--

CREATE TABLE `huellas` (
  `id` int(11) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `nombre_dedo` varchar(20) DEFAULT NULL,
  `huella` longblob DEFAULT NULL,
  `imgHuella` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huellas_temp`
--

CREATE TABLE `huellas_temp` (
  `id` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pc_serial` varchar(100) NOT NULL,
  `imgHuella` longblob DEFAULT NULL,
  `huella` longblob DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `texto` varchar(100) DEFAULT NULL,
  `statusPlantilla` varchar(100) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `dedo` varchar(20) DEFAULT NULL,
  `opc` varchar(20) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `estado_lector` varchar(20) NOT NULL DEFAULT 'inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresiones`
--

CREATE TABLE `impresiones` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `estado` varchar(50) NOT NULL,
  `ImpresoPor` varchar(200) NOT NULL,
  `NumFactura` varchar(250) NOT NULL,
  `contador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Incidencias_Express`
--

CREATE TABLE `Incidencias_Express` (
  `ID_incidencia` int(11) NOT NULL,
  `Descripcion` varchar(400) NOT NULL,
  `Reporto` varchar(200) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fk_Sucursal` int(11) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IngresoAgendaEspecialistas`
--

CREATE TABLE `IngresoAgendaEspecialistas` (
  `PersonalAgendaEspecialista_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(120) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `Fk_Usuario` int(11) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Correo_Electronico` varchar(120) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `AgregadoPor` varchar(120) DEFAULT NULL,
  `ID_H_O_D` int(11) DEFAULT NULL,
  `Estatus` tinyint(4) DEFAULT 1,
  `ColorEstatus` varchar(20) DEFAULT NULL,
  `AgregadoEl` datetime DEFAULT current_timestamp(),
  `Biometrico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IngresosRotaciones`
--

CREATE TABLE `IngresosRotaciones` (
  `IdIngreso` int(12) UNSIGNED ZEROFILL NOT NULL,
  `NumFactura` varchar(200) NOT NULL,
  `Proveedor` varchar(200) NOT NULL,
  `Cod_Barra` varchar(250) DEFAULT NULL,
  `Nombre_Prod` varchar(1000) DEFAULT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Fk_SucursalRecibe` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FechaInventario` date NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `NumOrden` int(10) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inserciones_Excel_inventarios`
--

CREATE TABLE `Inserciones_Excel_inventarios` (
  `Id_Insert` int(11) NOT NULL,
  `Cod_Barra` varchar(250) NOT NULL,
  `Nombre_prod` varchar(500) NOT NULL,
  `Cantidad_Ajuste` int(200) NOT NULL,
  `ExistenciaReal` int(200) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Tipo_ajuste` varchar(300) NOT NULL,
  `Agrego` varchar(300) NOT NULL,
  `Fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Inserciones_Excel_inventarios`
--
DELIMITER $$
CREATE TRIGGER `AjusteInventarios` BEFORE INSERT ON `Inserciones_Excel_inventarios` FOR EACH ROW UPDATE Stock_POS
    SET Existencias_R =NEW.Cantidad_Ajuste
    WHERE Cod_Barra = NEW.Cod_Barra AND
    Fk_sucursal= NEW.Sucursal
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inserciones_Excel_inventarios_Respaldo1`
--

CREATE TABLE `Inserciones_Excel_inventarios_Respaldo1` (
  `Id_Insert` int(11) NOT NULL,
  `Cod_Barra` varchar(250) NOT NULL,
  `Nombre_prod` varchar(500) NOT NULL,
  `Cantidad_Ajuste` int(200) NOT NULL,
  `ExistenciaReal` int(200) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Tipo_ajuste` varchar(300) NOT NULL,
  `Agrego` varchar(300) NOT NULL,
  `Fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Insumos`
--

CREATE TABLE `Insumos` (
  `ID_Insumo` int(11) NOT NULL,
  `FK_Procedimiento` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventariosStocks_Conteos`
--

CREATE TABLE `InventariosStocks_Conteos` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Contabilizado` int(12) NOT NULL,
  `StockEnMomento` int(11) NOT NULL,
  `Diferencia` int(11) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `FechaInventario` date NOT NULL,
  `Tipo_Ajuste` varchar(250) NOT NULL,
  `Anaquel` varchar(100) NOT NULL,
  `Repisa` varchar(100) NOT NULL,
  `Comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `InventariosStocks_Conteos`
--
DELIMITER $$
CREATE TRIGGER `actualizar_stock_pos` AFTER INSERT ON `InventariosStocks_Conteos` FOR EACH ROW BEGIN
    UPDATE Stock_POS
    SET Contabilizado = 'SI', FechaDeInventario = NOW(), TipoMov=NEW.Tipo_Ajuste
    WHERE 	Cod_Barra = NEW.Cod_Barra AND Fk_sucursal = NEW.Fk_sucursal;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_actualizar_stock_pos` AFTER INSERT ON `InventariosStocks_Conteos` FOR EACH ROW BEGIN
    
    DECLARE error_msg VARCHAR(255);
    
    
    UPDATE Stock_POS
    SET Existencias_R = IFNULL(Existencias_R, 0) + NEW.Diferencia,
        Anaquel = CASE WHEN NEW.Anaquel IS NOT NULL AND NEW.Anaquel != '' AND NEW.Anaquel != Anaquel THEN NEW.Anaquel ELSE Anaquel END,
        Repisa = CASE WHEN NEW.Repisa IS NOT NULL AND NEW.Repisa != '' AND NEW.Repisa != Repisa THEN NEW.Repisa ELSE Repisa END
    WHERE Cod_Barra = NEW.Cod_Barra AND Fk_sucursal = NEW.Fk_sucursal;
    
    
    IF FOUND_ROWS() = 0 THEN
        SET error_msg = CONCAT('No se encontraron filas afectadas para Cod_Barra: ', NEW.Cod_Barra, ' y Fk_sucursal: ', NEW.Fk_sucursal);
        INSERT INTO registro_errores_Actualizacionanaqueles (mensaje_error) VALUES (error_msg);
    END IF;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventarios_Clinicas`
--

CREATE TABLE `Inventarios_Clinicas` (
  `ID_Inv_Clic` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Equipo` varchar(200) NOT NULL,
  `Cod_Equipo_Repetido` varchar(200) NOT NULL,
  `FK_Tipo_Mob` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cantidad_Mobil` int(11) NOT NULL,
  `Nombre_equipo` varchar(250) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Estatus` varchar(100) NOT NULL,
  `CodigoEstatus` varchar(150) NOT NULL,
  `Agregado_Por` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Inventarios_Clinicas`
--
DELIMITER $$
CREATE TRIGGER `Audita_InventariosClinicas` AFTER INSERT ON `Inventarios_Clinicas` FOR EACH ROW INSERT INTO Inventarios_Clinicas_audita
    (ID_Inv_Clic,Cod_Equipo,Cod_Equipo_Repetido,FK_Tipo_Mob,Cantidad_Mobil,Nombre_equipo,Descripcion,Fecha_Ingreso,Estatus,CodigoEstatus,Agregado_Por,AgregadoEl,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Inv_Clic,NEW.Cod_Equipo,NEW.Cod_Equipo_Repetido,NEW.FK_Tipo_Mob,NEW.Cantidad_Mobil,NEW.Nombre_equipo,NEW.Descripcion,NEW.Fecha_Ingreso,NEW.Estatus,NEW.CodigoEstatus,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update_Inventarios_Clinicas` BEFORE UPDATE ON `Inventarios_Clinicas` FOR EACH ROW INSERT INTO Inventarios_Clinicas_audita
    (ID_Inv_Clic,Cod_Equipo,Cod_Equipo_Repetido,FK_Tipo_Mob,Cantidad_Mobil,Nombre_equipo,Descripcion,Fecha_Ingreso,Estatus,CodigoEstatus,Agregado_Por,AgregadoEl,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Inv_Clic,NEW.Cod_Equipo,NEW.Cod_Equipo_Repetido,NEW.FK_Tipo_Mob,NEW.Cantidad_Mobil,NEW.Nombre_equipo,NEW.Descripcion,NEW.Fecha_Ingreso,NEW.Estatus,NEW.CodigoEstatus,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventarios_Clinicas_audita`
--

CREATE TABLE `Inventarios_Clinicas_audita` (
  `ID_Inv_Clic_Audita` int(11) NOT NULL,
  `ID_Inv_Clic` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Equipo` varchar(200) NOT NULL,
  `Cod_Equipo_Repetido` varchar(200) NOT NULL,
  `FK_Tipo_Mob` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cantidad_Mobil` int(11) NOT NULL,
  `Nombre_equipo` varchar(250) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Estatus` varchar(100) NOT NULL,
  `CodigoEstatus` varchar(150) NOT NULL,
  `Agregado_Por` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventarios_Procesados`
--

CREATE TABLE `Inventarios_Procesados` (
  `ID_Registro` int(11) NOT NULL,
  `Cod_Barra` varchar(50) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL DEFAULT 1,
  `Fecha_Inventario` datetime NOT NULL,
  `ProcesadoPor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_inicial_estado`
--

CREATE TABLE `inventario_inicial_estado` (
  `id` int(11) NOT NULL,
  `fkSucursal` int(11) DEFAULT NULL,
  `inventario_inicial_establecido` tinyint(1) DEFAULT 0,
  `fecha_establecido` datetime DEFAULT NULL,
  `EstablecidoPor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inventario_Mobiliario`
--

CREATE TABLE `Inventario_Mobiliario` (
  `Id_inventario` int(11) NOT NULL,
  `Codigo` varchar(200) NOT NULL,
  `Articulo` varchar(100) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Marca` varchar(300) NOT NULL,
  `Departamento` varchar(200) NOT NULL,
  `Responsables` varchar(200) NOT NULL,
  `Categoria` varchar(200) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Valor` decimal(50,2) NOT NULL,
  `Antiguedad` varchar(100) NOT NULL,
  `Factura` varchar(200) NOT NULL,
  `NSerie` varchar(200) NOT NULL,
  `Vigencia` varchar(200) NOT NULL,
  `Estado` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AgregadoPor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IPsAutorizadas`
--

CREATE TABLE `IPsAutorizadas` (
  `id` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `ip_autorizada` varchar(45) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `activa` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Localidades`
--

CREATE TABLE `Localidades` (
  `ID_Localidad` int(11) NOT NULL,
  `Nombre_Localidad` varchar(400) NOT NULL,
  `Fk_Municipio` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Logs_Sistema`
--

CREATE TABLE `Logs_Sistema` (
  `ID_Log` int(11) NOT NULL,
  `Usuario` varchar(250) NOT NULL,
  `Tipo_log` varchar(250) NOT NULL,
  `Fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Logs_Sistema_Agenda`
--

CREATE TABLE `Logs_Sistema_Agenda` (
  `ID_ingreso` int(11) NOT NULL,
  `PersonalAgenda_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `ID_H_O_D` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Estado_Conexion` int(11) NOT NULL,
  `Fecha_ingreso` date NOT NULL,
  `Hora_Ingreso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lotes_Productos`
--

CREATE TABLE `Lotes_Productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `lote` varchar(50) DEFAULT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  `sucursal_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 0,
  `estatus` varchar(50) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marcas_POS`
--

CREATE TABLE `Marcas_POS` (
  `Marca_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Marca` varchar(200) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `Cod_Estado` varchar(250) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Marcas_POS`
--
DELIMITER $$
CREATE TRIGGER `Marcas_Pos_Updates` AFTER UPDATE ON `Marcas_POS` FOR EACH ROW INSERT INTO Marcas_POS_Updates
    (Marca_ID,Nom_Marca,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Marca_ID,NEW.Nom_Marca,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marcas_POS_Updates`
--

CREATE TABLE `Marcas_POS_Updates` (
  `ID_Update_Mar` int(11) NOT NULL,
  `Marca_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Marca` varchar(200) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `Cod_Estado` varchar(250) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MedicamentosCaducados`
--

CREATE TABLE `MedicamentosCaducados` (
  `Id_Baja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_BajaProd` int(11) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `MedicamentosCaducados`
--
DELIMITER $$
CREATE TRIGGER `actualizar_stock_bajas` AFTER INSERT ON `MedicamentosCaducados` FOR EACH ROW BEGIN
    
    UPDATE Stock_Bajas
    SET Cantidad = Cantidad - NEW.Cantidad, 
        Estado = 'Caducado' 
    WHERE Id_Baja = NEW.ID_BajaProd; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_stock_pos_Caducados` AFTER INSERT ON `MedicamentosCaducados` FOR EACH ROW BEGIN
    
    UPDATE Stock_POS
    SET Existencias_R = Existencias_R - NEW.Cantidad, 
        ActualizadoPorBajaOCaducado = NEW.AgregadoPor, 
        ActualizadoPorBajaOCaducadoFechaHora = NOW() 
    WHERE Cod_Barra = NEW.Cod_Barra 
      AND Fk_sucursal = NEW.Fk_sucursal; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Medicos_Credit_POS`
--

CREATE TABLE `Medicos_Credit_POS` (
  `ID_Med_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Med` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Medicos_Credit_POS`
--
DELIMITER $$
CREATE TRIGGER `Medicos_Cred_Audita` AFTER INSERT ON `Medicos_Credit_POS` FOR EACH ROW INSERT INTO Medicos_Credit_POS_Audita
    (ID_Med_Cred,Nombre_Med,	Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Med_Cred,NEW.Nombre_Med,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Medicos_Cred_Audita_Updates` AFTER UPDATE ON `Medicos_Credit_POS` FOR EACH ROW INSERT INTO Medicos_Credit_POS_Audita
    (ID_Med_Cred,Nombre_Med,	Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Med_Cred,NEW.Nombre_Med,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Medicos_Credit_POS_Audita`
--

CREATE TABLE `Medicos_Credit_POS_Audita` (
  `ID_Upd_Med_Cred` int(11) NOT NULL,
  `ID_Med_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Med` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mobiliario_Asignado`
--

CREATE TABLE `Mobiliario_Asignado` (
  `ID_Mobiliario` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Mobiliario` varchar(200) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Tipo` varchar(200) NOT NULL,
  `Cantidad_Asignada` int(11) NOT NULL,
  `Asigno` varchar(200) NOT NULL,
  `Fk_sucursal` int(11) NOT NULL,
  `Enviado_El` date NOT NULL,
  `Recibio` varchar(200) NOT NULL,
  `Estado` varchar(200) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Agregado_Por` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Mobiliario_Asignado`
--
DELIMITER $$
CREATE TRIGGER `Audita_Mobiliario` AFTER INSERT ON `Mobiliario_Asignado` FOR EACH ROW INSERT INTO Mobiliario_Asignado_Audita
    (ID_Mobiliario,Cod_Mobiliario,Nombre,Tipo,Cantidad_Asignada,Asigno,Fk_sucursal,Enviado_El,Recibio,Estado,Cod_Estado,Agregadoel,Agregado_Por,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Mobiliario,NEW.Cod_Mobiliario,NEW.Nombre,Tipo,NEW.Cantidad_Asignada,NEW.Asigno,NEW.Fk_sucursal,NEW.Enviado_El,NEW.Recibio,NEW.Estado,NEW.Cod_Estado,Now(),NEW.Agregado_Por,NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_Mobiliario_Updates` AFTER UPDATE ON `Mobiliario_Asignado` FOR EACH ROW INSERT INTO Mobiliario_Asignado_Audita
    (ID_Mobiliario,Cod_Mobiliario,Nombre,Tipo,Cantidad_Asignada,Asigno,Fk_sucursal,Enviado_El,Recibio,Estado,Cod_Estado,Agregadoel,Agregado_Por,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Mobiliario,NEW.Cod_Mobiliario,NEW.Nombre,Tipo,NEW.Cantidad_Asignada,NEW.Asigno,NEW.Fk_sucursal,NEW.Enviado_El,NEW.Recibio,NEW.Estado,NEW.Cod_Estado,Now(),NEW.Agregado_Por,NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Resta_mobi` AFTER INSERT ON `Mobiliario_Asignado` FOR EACH ROW Update Inventarios_Clinicas
set Inventarios_Clinicas.Cantidad_Mobil = Inventarios_Clinicas.Cantidad_Mobil - NEW.Cantidad_Asignada 
where Inventarios_Clinicas.Nombre_equipo = NEW.Nombre
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Suma_Mobi` BEFORE DELETE ON `Mobiliario_Asignado` FOR EACH ROW Update Inventarios_Clinicas
set Inventarios_Clinicas.Cantidad_Mobil = Inventarios_Clinicas.Cantidad_Mobil + OLD.Cantidad_Asignada 
where Inventarios_Clinicas.Nombre_equipo = OLD.Nombre
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mobiliario_Asignado_Audita`
--

CREATE TABLE `Mobiliario_Asignado_Audita` (
  `Audita_Mobiliario_ID` int(11) NOT NULL,
  `ID_Mobiliario` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Mobiliario` varchar(200) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Tipo` int(10) NOT NULL,
  `Cantidad_Asignada` int(11) NOT NULL,
  `Asigno` varchar(200) NOT NULL,
  `Fk_sucursal` int(11) NOT NULL,
  `Enviado_El` date NOT NULL,
  `Recibio` varchar(200) NOT NULL,
  `Estado` varchar(200) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Agregado_Por` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MovimientosAgenda`
--

CREATE TABLE `MovimientosAgenda` (
  `ID_Agenda_Especialista` int(11) NOT NULL,
  `Fk_Especialidad` int(11) NOT NULL,
  `Fk_Especialista` int(11) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Nombre_Paciente` varchar(100) NOT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Tipo_Consulta` varchar(50) DEFAULT NULL,
  `Estatus_cita` varchar(20) DEFAULT NULL,
  `Observaciones` text DEFAULT NULL,
  `ID_H_O_D` int(11) NOT NULL,
  `AgendadoPor` varchar(50) DEFAULT NULL,
  `ActualizoEstado` varchar(50) DEFAULT NULL,
  `Fecha_Hora` timestamp NULL DEFAULT current_timestamp(),
  `GoogleEventId` varchar(255) DEFAULT NULL,
  `IDGoogleCalendar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MovimientosCarritos`
--

CREATE TABLE `MovimientosCarritos` (
  `ID_Movimiento` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `ID_Carrito` int(11) NOT NULL,
  `CantidadAnterior` int(11) DEFAULT NULL,
  `CantidadNueva` int(11) DEFAULT NULL,
  `Motivo` varchar(255) NOT NULL,
  `TipoMovimiento` enum('Agregado','Eliminado','Actualizado') NOT NULL,
  `FechaMovimiento` datetime DEFAULT current_timestamp(),
  `Usuario` varchar(50) NOT NULL,
  `ID_H_O_D` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MovimientosEncargos`
--

CREATE TABLE `MovimientosEncargos` (
  `Id_Movimiento` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Id_Encargo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `IdentificadorEncargo` varchar(300) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `EstadoAnterior` varchar(300) NOT NULL,
  `EstadoNuevo` varchar(300) NOT NULL,
  `FechaMovimiento` timestamp NULL DEFAULT current_timestamp(),
  `Fk_sucursal` int(12) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Municipios`
--

CREATE TABLE `Municipios` (
  `ID_Municipio` int(11) NOT NULL,
  `Nombre_Municipio` varchar(200) NOT NULL,
  `Fk_Estado` int(11) NOT NULL,
  `Ananido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ordenes_Laboratorios`
--

CREATE TABLE `Ordenes_Laboratorios` (
  `Folio_Orden` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Cliente` int(11) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Otros_Gastos_POS`
--

CREATE TABLE `Otros_Gastos_POS` (
  `ID_Gastos` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Concepto_Categoria` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Importe_Total` decimal(50,2) NOT NULL,
  `Empleado` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Fk_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Otros_Gastos_POS`
--
DELIMITER $$
CREATE TRIGGER `Disminuye_Caja` AFTER INSERT ON `Otros_Gastos_POS` FOR EACH ROW Update Cajas_POS
set Cajas_POS.Valor_Total_Caja = Cajas_POS.Valor_Total_Caja -NEW.Importe_Total
where Cajas_POS.ID_Caja = NEW.Fk_Caja
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paquetes`
--

CREATE TABLE `Paquetes` (
  `Id_Paquete` int(11) NOT NULL,
  `Nombre_Paquete` varchar(100) NOT NULL,
  `Codigos_Paquete` varchar(100) NOT NULL,
  `Agregadoel` datetime NOT NULL,
  `Agrego` varchar(100) NOT NULL,
  `ID_H_OD` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PedidosConfirmados`
--

CREATE TABLE `PedidosConfirmados` (
  `Id_Sugerencia` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `NumOrdPedido` int(11) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PedidosRealizadosEnfermeria`
--

CREATE TABLE `PedidosRealizadosEnfermeria` (
  `ID_Pedido` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `FechaPedido` date NOT NULL,
  `CantidadPedida` int(11) NOT NULL,
  `Sucursal` varchar(100) NOT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PersonalPOS`
--

CREATE TABLE `PersonalPOS` (
  `Pos_ID` int(11) NOT NULL COMMENT 'Folio del personal',
  `Nombre_Apellidos` varchar(250) DEFAULT NULL COMMENT 'Nombre y apellidos del personal',
  `Password` varchar(10) DEFAULT NULL COMMENT 'Contraseña del usuario',
  `file_name` varchar(300) DEFAULT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) DEFAULT NULL COMMENT 'Llave foranea del tipo de usuario',
  `Fecha_Nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento del usuario',
  `Correo_Electronico` varchar(100) DEFAULT NULL COMMENT 'corre del usuario',
  `Telefono` varchar(12) DEFAULT NULL COMMENT 'telefono del usuario',
  `AgregadoPor` varchar(200) DEFAULT NULL COMMENT 'quien agrega',
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'en que fecha se agrego u edito',
  `Fk_Sucursal` int(12) DEFAULT NULL COMMENT 'llave foranea sucursa',
  `ID_H_O_D` varchar(200) DEFAULT NULL COMMENT 'LICENCIA',
  `Estatus` varchar(150) DEFAULT NULL COMMENT 'Estatus del usuario',
  `ColorEstatus` varchar(150) DEFAULT NULL COMMENT 'color del estatus',
  `Biometrico` int(11) NOT NULL,
  `Permisos` int(11) NOT NULL,
  `Perm_Elim` varchar(100) NOT NULL,
  `Perm_Edit` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `PersonalPOS`
--
DELIMITER $$
CREATE TRIGGER `Audita_PersonalPOS` AFTER INSERT ON `PersonalPOS` FOR EACH ROW INSERT INTO PersonalPOS_Audita
    (Pos_ID,Nombre_Apellidos,Password,file_name,Fk_Usuario,Fecha_Nacimiento,Correo_Electronico,Telefono,AgregadoPor,AgregadoEl,Fk_Sucursal,ID_H_O_D,Estatus,ColorEstatus,Biometrico)
 VALUES (NEW.Pos_ID,NEW.Nombre_Apellidos,NEW.Password,NEW.file_name,NEW.Fk_Usuario,NEW.Fecha_Nacimiento,NEW.Correo_Electronico,NEW.Telefono,NEW.AgregadoPor,Now(),NEW.Fk_Sucursal,NEW.ID_H_O_D,NEW.Estatus,NEW.ColorEstatus,NEW.Biometrico)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_PersonalPOS_Updates` AFTER UPDATE ON `PersonalPOS` FOR EACH ROW INSERT INTO PersonalPOS_Audita
    (Pos_ID,Nombre_Apellidos,Password,file_name,Fk_Usuario,Fecha_Nacimiento,Correo_Electronico,Telefono,AgregadoPor,AgregadoEl,Fk_Sucursal,ID_H_O_D,Estatus,ColorEstatus,Biometrico)
 VALUES (NEW.Pos_ID,NEW.Nombre_Apellidos,NEW.Password,NEW.file_name,NEW.Fk_Usuario,NEW.Fecha_Nacimiento,NEW.Correo_Electronico,NEW.Telefono,NEW.AgregadoPor,Now(),NEW.Fk_Sucursal,NEW.ID_H_O_D,NEW.Estatus,NEW.ColorEstatus,NEW.Biometrico)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PersonalPOS_Audita`
--

CREATE TABLE `PersonalPOS_Audita` (
  `Audita_Pos_ID` int(11) NOT NULL,
  `Pos_ID` int(11) NOT NULL COMMENT 'Folio del personal',
  `Nombre_Apellidos` varchar(250) DEFAULT NULL COMMENT 'Nombre y apellidos del personal',
  `Password` varchar(10) DEFAULT NULL COMMENT 'Contraseña del usuario',
  `file_name` varchar(300) DEFAULT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) DEFAULT NULL COMMENT 'Llave foranea del tipo de usuario',
  `Fecha_Nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento del usuario',
  `Correo_Electronico` varchar(100) DEFAULT NULL COMMENT 'corre del usuario',
  `Telefono` varchar(12) DEFAULT NULL COMMENT 'telefono del usuario',
  `AgregadoPor` varchar(200) DEFAULT NULL COMMENT 'quien agrega',
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'en que fecha se agrego u edito',
  `Fk_Sucursal` int(12) DEFAULT NULL COMMENT 'llave foranea sucursa',
  `ID_H_O_D` varchar(200) DEFAULT NULL COMMENT 'LICENCIA',
  `Estatus` varchar(150) DEFAULT NULL COMMENT 'Estatus del usuario',
  `ColorEstatus` varchar(150) DEFAULT NULL COMMENT 'color del estatus',
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PersonalPOS_LOGS`
--

CREATE TABLE `PersonalPOS_LOGS` (
  `Pos_ID` int(11) NOT NULL COMMENT 'Folio del personal',
  `Nombre_Apellidos` varchar(250) DEFAULT NULL COMMENT 'Nombre y apellidos del personal',
  `file_name` varchar(300) DEFAULT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) DEFAULT NULL COMMENT 'Llave foranea del tipo de usuario',
  `Fecha_Nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento del usuario',
  `Correo_Electronico` varchar(100) DEFAULT NULL COMMENT 'corre del usuario',
  `Telefono` varchar(12) DEFAULT NULL COMMENT 'telefono del usuario',
  `AgregadoPor` varchar(200) DEFAULT NULL COMMENT 'quien agrega',
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'en que fecha se agrego u edito',
  `Fk_Sucursal` int(12) DEFAULT NULL COMMENT 'llave foranea sucursa',
  `ID_H_O_D` varchar(200) DEFAULT NULL COMMENT 'LICENCIA',
  `Estado_Conexion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Agenda`
--

CREATE TABLE `Personal_Agenda` (
  `PersonalAgenda_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `Password` varchar(10) NOT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `ColorEstatus` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Personal_Agenda`
--
DELIMITER $$
CREATE TRIGGER `PersonalAgendaAudita` AFTER INSERT ON `Personal_Agenda` FOR EACH ROW INSERT INTO Personal_Agenda_Audita
(PersonalAgenda_ID,Nombre_Apellidos,file_name, Password,Fk_Usuario,Fecha_Nacimiento,Correo_Electronico,Telefono, ID_H_O_D,Estatus, ColorEstatus,AgregadoPor,AgregadoEl)
VALUES
(NEW.PersonalAgenda_ID,NEW.Nombre_Apellidos,NEW.file_name, NEW.Password,NEW.Fk_Usuario,NEW.Fecha_Nacimiento,NEW.Correo_Electronico,NEW.Telefono, NEW.ID_H_O_D,NEW.Estatus, NEW.ColorEstatus,NEW.AgregadoPor,Now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Personal_AgregaAlLog_Agenda` AFTER INSERT ON `Personal_Agenda` FOR EACH ROW INSERT INTO Personal_Agenda_Logs
(PersonalAgenda_ID,Nombre_Apellidos,file_name,ID_H_O_D,AgregadoEl)
VALUES
(NEW.PersonalAgenda_ID,NEW.Nombre_Apellidos,NEW.file_name,NEW.ID_H_O_D,Now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Agenda_Audita`
--

CREATE TABLE `Personal_Agenda_Audita` (
  `Personal_AgendaAudita` int(11) NOT NULL,
  `PersonalAgenda_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Password` varchar(10) NOT NULL,
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `ColorEstatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Agenda_Logs`
--

CREATE TABLE `Personal_Agenda_Logs` (
  `PersonalAgenda_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `ID_H_O_D` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Estado_Conexion` int(11) NOT NULL,
  `Fecha_ingreso` date NOT NULL,
  `Hora_Ingreso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Personal_Agenda_Logs`
--
DELIMITER $$
CREATE TRIGGER `Entradas_SalidasdelPersonal` AFTER UPDATE ON `Personal_Agenda_Logs` FOR EACH ROW INSERT into Logs_Sistema_Agenda
(PersonalAgenda_ID,Nombre_Apellidos,file_name,ID_H_O_D, AgregadoEl,Estado_Conexion,Fecha_ingreso,Hora_Ingreso)
VALUES
(NEW.PersonalAgenda_ID,NEW.Nombre_Apellidos,NEW.file_name,NEW.ID_H_O_D, Now(),NEW.Estado_Conexion,NEW.Fecha_ingreso,NEW.Hora_Ingreso)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Enfermeria`
--

CREATE TABLE `Personal_Enfermeria` (
  `Enfermero_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `Password` varchar(10) NOT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `ColorEstatus` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Personal_Enfermeria`
--
DELIMITER $$
CREATE TRIGGER `AuditaPersonal_Enfermeria` AFTER INSERT ON `Personal_Enfermeria` FOR EACH ROW INSERT INTO Personal_Enfermeria_Audita
    (Enfermero_ID, Nombre_Apellidos, Password, file_name, Fk_Usuario, Fecha_Nacimiento, Correo_Electronico, Telefono, AgregadoPor, Fk_Sucursal, ID_H_O_D, Estatus, ColorEstatus, AgregadoEl,Biometrico)
 VALUES (NEW.Enfermero_ID, NEW.Nombre_Apellidos, NEW.Password, NEW.file_name, NEW.Fk_Usuario, NEW.Fecha_Nacimiento, NEW.Correo_Electronico, NEW.Telefono, NEW.AgregadoPor, NEW.Fk_Sucursal, NEW.ID_H_O_D, NEW.Estatus, NEW.ColorEstatus, Now(),NEW.Biometrico)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_Update_Enfermeria` BEFORE UPDATE ON `Personal_Enfermeria` FOR EACH ROW INSERT INTO Personal_Enfermeria_Audita
    (Enfermero_ID, Nombre_Apellidos, Password, file_name, Fk_Usuario, Fecha_Nacimiento, Correo_Electronico, Telefono, AgregadoPor, Fk_Sucursal, ID_H_O_D, Estatus, ColorEstatus, AgregadoEl,Biometrico)
 VALUES (NEW.Enfermero_ID, NEW.Nombre_Apellidos, NEW.Password, NEW.file_name, NEW.Fk_Usuario, NEW.Fecha_Nacimiento, NEW.Correo_Electronico, NEW.Telefono, NEW.AgregadoPor, NEW.Fk_Sucursal, NEW.ID_H_O_D, NEW.Estatus, NEW.ColorEstatus, Now(),NEW.Biometrico)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Enfermeria_Audita`
--

CREATE TABLE `Personal_Enfermeria_Audita` (
  `Auditoria_ID` int(11) NOT NULL,
  `Enfermero_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `Password` varchar(10) NOT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `ColorEstatus` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Intendecia`
--

CREATE TABLE `Personal_Intendecia` (
  `Intendencia_ID` int(11) NOT NULL COMMENT 'Folio del personal',
  `Nombre_Apellidos` varchar(250) DEFAULT NULL COMMENT 'Nombre y apellidos del personal',
  `file_name` varchar(300) DEFAULT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) DEFAULT NULL COMMENT 'Llave foranea del tipo de usuario',
  `Fecha_Nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento del usuario',
  `Telefono` varchar(12) DEFAULT NULL COMMENT 'telefono del usuario',
  `AgregadoPor` varchar(200) DEFAULT NULL COMMENT 'quien agrega',
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'en que fecha se agrego u edito',
  `Fk_Sucursal` int(12) DEFAULT NULL COMMENT 'llave foranea sucursa',
  `ID_H_O_D` varchar(200) DEFAULT NULL COMMENT 'LICENCIA',
  `Estatus` varchar(150) DEFAULT NULL COMMENT 'Estatus del usuario',
  `ColorEstatus` varchar(150) DEFAULT NULL COMMENT 'color del estatus',
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Intendecia_Audita`
--

CREATE TABLE `Personal_Intendecia_Audita` (
  `ID_Auditable` int(11) NOT NULL,
  `Intendencia_ID` int(11) NOT NULL COMMENT 'Folio del personal',
  `Nombre_Apellidos` varchar(250) DEFAULT NULL COMMENT 'Nombre y apellidos del personal',
  `Password` varchar(10) DEFAULT NULL COMMENT 'Contraseña del usuario',
  `file_name` varchar(300) DEFAULT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fk_Usuario` int(12) DEFAULT NULL COMMENT 'Llave foranea del tipo de usuario',
  `Fecha_Nacimiento` date DEFAULT NULL COMMENT 'fecha de nacimiento del usuario',
  `Correo_Electronico` varchar(100) DEFAULT NULL COMMENT 'corre del usuario',
  `Telefono` varchar(12) DEFAULT NULL COMMENT 'telefono del usuario',
  `AgregadoPor` varchar(200) DEFAULT NULL COMMENT 'quien agrega',
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'en que fecha se agrego u edito',
  `Fk_Sucursal` int(12) DEFAULT NULL COMMENT 'llave foranea sucursa',
  `ID_H_O_D` varchar(200) DEFAULT NULL COMMENT 'LICENCIA',
  `Estatus` varchar(150) DEFAULT NULL COMMENT 'Estatus del usuario',
  `ColorEstatus` varchar(150) DEFAULT NULL COMMENT 'color del estatus',
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Medico`
--

CREATE TABLE `Personal_Medico` (
  `Medico_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Password` varchar(10) NOT NULL,
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `ColorEstatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Medico_Express`
--

CREATE TABLE `Personal_Medico_Express` (
  `Medico_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Especialidad_Express` int(11) NOT NULL,
  `IDGoogleCalendar` varchar(300) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Medico_Express_Sucursales`
--

CREATE TABLE `Personal_Medico_Express_Sucursales` (
  `Esp_X_Sucursal` int(11) NOT NULL,
  `Medico_ID` int(11) NOT NULL,
  `Especialidad_Express` int(11) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Medico_Respaldo`
--

CREATE TABLE `Personal_Medico_Respaldo` (
  `Medico_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Password` varchar(10) NOT NULL,
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `ColorEstatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Biometrico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personal_Medico_v2`
--

CREATE TABLE `Personal_Medico_v2` (
  `Medico_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Password` varchar(10) NOT NULL,
  `Fk_Usuario` int(12) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Correo_Electronico` varchar(200) NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Fk_Sucursal` int(12) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `ColorEstatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Precios_Originales`
--

CREATE TABLE `Precios_Originales` (
  `Cod_Barra` varchar(50) NOT NULL,
  `Precio_Venta` decimal(10,2) DEFAULT NULL,
  `modificado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Presentacion_Prod_POS`
--

CREATE TABLE `Presentacion_Prod_POS` (
  `Pprod_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Presentacion` varchar(250) NOT NULL,
  `Siglas` varchar(100) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Presentacion_Prod_POS`
--
DELIMITER $$
CREATE TRIGGER `Presentaciones_Updates` AFTER UPDATE ON `Presentacion_Prod_POS` FOR EACH ROW INSERT INTO Presentacion_Prod_POS_Updates
(Pprod_ID,Nom_Presentacion,Siglas,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Pprod_ID,NEW.Nom_Presentacion,NEW.Siglas,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Presentacion_Prod_POS_Updates`
--

CREATE TABLE `Presentacion_Prod_POS_Updates` (
  `ID_Update_Pre` int(11) NOT NULL,
  `Pprod_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Presentacion` varchar(250) NOT NULL,
  `Siglas` varchar(100) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Procedimientos_Medicos`
--

CREATE TABLE `Procedimientos_Medicos` (
  `ID_Proce` int(11) NOT NULL,
  `Codigo_Procedimiento` varchar(100) NOT NULL,
  `Nombre_Procedimiento` varchar(200) NOT NULL,
  `Costo_Procedimiento` decimal(50,2) NOT NULL,
  `AgregadoPor` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Procedimientos_Medicos`
--
DELIMITER $$
CREATE TRIGGER `AuditaProcedimientosMedicos` AFTER INSERT ON `Procedimientos_Medicos` FOR EACH ROW INSERT INTO Procedimientos_Medicos_Audita
    (ID_Proce, Codigo_Procedimiento, Nombre_Procedimiento, Costo_Procedimiento, AgregadoPor,AgregadoEl, ID_H_O_D)
    VALUES (NEW.ID_Proce, NEW.Codigo_Procedimiento, NEW.Nombre_Procedimiento, NEW.Costo_Procedimiento, NEW.AgregadoPor, Now(), NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AuditaProcedimientosMedicosaAct` BEFORE UPDATE ON `Procedimientos_Medicos` FOR EACH ROW INSERT INTO Procedimientos_Medicos_Audita
    (ID_Proce, Codigo_Procedimiento, Nombre_Procedimiento, Costo_Procedimiento, AgregadoPor,AgregadoEl, ID_H_O_D)
    VALUES (NEW.ID_Proce, NEW.Codigo_Procedimiento, NEW.Nombre_Procedimiento, NEW.Costo_Procedimiento, NEW.AgregadoPor, Now(), NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ProcedimientosEliminados` BEFORE DELETE ON `Procedimientos_Medicos` FOR EACH ROW INSERT INTO Procedimientos_Medicos_Eliminados
    (ID_Proce, Codigo_Procedimiento, Nombre_Procedimiento, Costo_Procedimiento, AgregadoPor,AgregadoEl, ID_H_O_D)
    VALUES (OLD.ID_Proce, OLD.Codigo_Procedimiento, OLD.Nombre_Procedimiento, OLD.Costo_Procedimiento, OLD.AgregadoPor, Now(), OLD.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Procedimientos_Medicos_Audita`
--

CREATE TABLE `Procedimientos_Medicos_Audita` (
  `Procede_Audita` int(11) NOT NULL,
  `ID_Proce` int(11) NOT NULL,
  `Codigo_Procedimiento` varchar(100) NOT NULL,
  `Nombre_Procedimiento` varchar(200) NOT NULL,
  `Costo_Procedimiento` decimal(50,2) NOT NULL,
  `AgregadoPor` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Procedimientos_Medicos_Eliminados`
--

CREATE TABLE `Procedimientos_Medicos_Eliminados` (
  `Procede_Audita` int(11) NOT NULL,
  `ID_Proce` int(11) NOT NULL,
  `Codigo_Procedimiento` varchar(100) NOT NULL,
  `Nombre_Procedimiento` varchar(200) NOT NULL,
  `Costo_Procedimiento` decimal(50,2) NOT NULL,
  `AgregadoPor` varchar(200) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Procedimientos_POS`
--

CREATE TABLE `Procedimientos_POS` (
  `IDProcedimiento` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `Nombre_Procedimiento` varchar(500) NOT NULL,
  `Registrado_Por` varchar(500) NOT NULL,
  `Estatus` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Procedimientos_Realizados`
--

CREATE TABLE `Procedimientos_Realizados` (
  `IDRealizado` int(11) NOT NULL,
  `IDProcedimiento` int(11) NOT NULL,
  `Nombre_Procedimiento` varchar(255) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Registrado_Por` varchar(255) NOT NULL,
  `Realizado_Por` varchar(255) NOT NULL,
  `Fecha_Realizacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `Procedimientos_Realizados`
--
DELIMITER $$
CREATE TRIGGER `descontar_insumos_procedimiento` AFTER INSERT ON `Procedimientos_Realizados` FOR EACH ROW BEGIN
    -- 1. Declaración de variables
    DECLARE done INT DEFAULT FALSE;
    DECLARE producto_id INT;
    DECLARE cantidad_necesaria DECIMAL(10,2);
    DECLARE carrito_id INT;
    DECLARE producto_equivalente_id INT;
    DECLARE cantidad_disponible DECIMAL(10,2);
    DECLARE cantidad_original DECIMAL(10,2);
    DECLARE cantidad_a_descontar DECIMAL(10,2);
    DECLARE existe_producto INT DEFAULT 0;

    -- 2. Declaración de cursor (antes de handlers)
    DECLARE cur CURSOR FOR 
        SELECT i.FK_Producto, i.Cantidad
        FROM Insumos i
        WHERE i.FK_Procedimiento = NEW.IDProcedimiento;

    -- 3. Declaración de handler (después de cursor)
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Obtener el ID del carrito de la sucursal
    SELECT ID_CARRITO INTO carrito_id 
    FROM CARRITOS 
    WHERE ID_Sucursal = NEW.Fk_Sucursal 
    LIMIT 1;

    -- Verificar si se encontró el carrito
    IF carrito_id IS NULL THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'No se encontró el carrito para la sucursal especificada';
    END IF;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO producto_id, cantidad_necesaria;
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Inicializar variables para este producto
        SET producto_equivalente_id = NULL;
        SET cantidad_a_descontar = cantidad_necesaria;

        -- Verificar si el producto ya está en el carrito
        SELECT COUNT(*) INTO existe_producto
        FROM PRODUCTOS_EN_CARRITO
        WHERE ID_CARRITO = carrito_id AND FK_Producto = producto_id;

        IF existe_producto = 0 THEN
            -- Insertar producto en carrito con cantidad 0
            INSERT INTO PRODUCTOS_EN_CARRITO (ID_CARRITO, FK_Producto, CANTIDAD)
            VALUES (carrito_id, producto_id, 0);

            -- Registrar movimiento con cantidad 0
            INSERT INTO MovimientosCarritos (
                ID_Producto, ID_Carrito, CantidadAnterior, CantidadNueva,
                Motivo, TipoMovimiento, FechaMovimiento, Usuario, ID_H_O_D
            ) VALUES (
                producto_id,
                carrito_id,
                0,
                0,
                CONCAT('Registro automático por procedimiento: ', NEW.Nombre_Procedimiento),
                'registro automático',
                NOW(),
                NEW.Registrado_Por,
                NEW.Fk_Sucursal
            );
        END IF;

        -- Obtener cantidad disponible del producto original
        SELECT IFNULL(SUM(CANTIDAD), 0) INTO cantidad_disponible
        FROM PRODUCTOS_EN_CARRITO
        WHERE ID_CARRITO = carrito_id 
        AND FK_Producto = producto_id;

        -- 1. Intentar descontar del producto exacto primero
        IF cantidad_disponible > 0 THEN
            -- Calcular cuánto podemos descontar
            SET cantidad_a_descontar = LEAST(cantidad_disponible, cantidad_necesaria);

            -- Registrar cantidad original para el movimiento
            SELECT CANTIDAD INTO cantidad_original
            FROM PRODUCTOS_EN_CARRITO
            WHERE ID_CARRITO = carrito_id 
            AND FK_Producto = producto_id
            LIMIT 1;

            -- Actualizar el producto en el carrito
            UPDATE PRODUCTOS_EN_CARRITO
            SET CANTIDAD = CANTIDAD - cantidad_a_descontar
            WHERE ID_CARRITO = carrito_id 
            AND FK_Producto = producto_id;

            -- Registrar movimiento del producto original
            INSERT INTO MovimientosCarritos (
                ID_Producto, ID_Carrito, CantidadAnterior, CantidadNueva,
                Motivo, TipoMovimiento, FechaMovimiento, Usuario, ID_H_O_D
            ) VALUES (
                producto_id,
                carrito_id,
                cantidad_original,
                cantidad_original - cantidad_a_descontar,
                CONCAT('Procedimiento: ', NEW.Nombre_Procedimiento),
                'por procedimiento',
                NOW(),
                NEW.Registrado_Por,
                NEW.Fk_Sucursal
            );

            -- Actualizar la cantidad que aún falta por descontar
            SET cantidad_necesaria = cantidad_necesaria - cantidad_a_descontar;
        END IF;

        -- 2. Si todavía falta cantidad, buscar equivalentes
        IF cantidad_necesaria > 0 THEN
            -- Buscar productos equivalentes disponibles
            SELECT pe.ID_Producto_Equivalente, 
                   pec.CANTIDAD INTO producto_equivalente_id, cantidad_disponible
            FROM Productos_Equivalentes pe
            JOIN PRODUCTOS_EN_CARRITO pec ON pec.FK_Producto = pe.ID_Producto_Equivalente
            WHERE pe.ID_Producto_Principal = producto_id
            AND pec.ID_CARRITO = carrito_id
            AND pec.CANTIDAD > 0
            ORDER BY pec.CANTIDAD DESC
            LIMIT 1;

            -- Si encontramos un equivalente disponible
            IF producto_equivalente_id IS NOT NULL THEN
                -- Calcular cuánto podemos descontar del equivalente
                SET cantidad_a_descontar = LEAST(cantidad_disponible, cantidad_necesaria);

                -- Registrar cantidad original para el movimiento
                SELECT CANTIDAD INTO cantidad_original
                FROM PRODUCTOS_EN_CARRITO
                WHERE ID_CARRITO = carrito_id 
                AND FK_Producto = producto_equivalente_id
                LIMIT 1;

                -- Actualizar el producto equivalente en el carrito
                UPDATE PRODUCTOS_EN_CARRITO
                SET CANTIDAD = CANTIDAD - cantidad_a_descontar
                WHERE ID_CARRITO = carrito_id 
                AND FK_Producto = producto_equivalente_id;

                -- Registrar movimiento del producto equivalente
                INSERT INTO MovimientosCarritos (
                    ID_Producto, ID_Carrito, CantidadAnterior, CantidadNueva,
                    Motivo, TipoMovimiento, FechaMovimiento, Usuario, ID_H_O_D
                ) VALUES (
                    producto_equivalente_id,
                    carrito_id,
                    cantidad_original,
                    cantidad_original - cantidad_a_descontar,
                    CONCAT('Procedimiento: ', NEW.Nombre_Procedimiento, ' (Equivalente de ', producto_id, ')'),
                    'por procedimiento',
                    NOW(),
                    NEW.Registrado_Por,
                    NEW.Fk_Sucursal
                );

                -- Actualizar la cantidad que aún falta por descontar
                SET cantidad_necesaria = cantidad_necesaria - cantidad_a_descontar;
            END IF;
        END IF;

        -- 3. Si todavía falta cantidad, registrar advertencia
        IF cantidad_necesaria > 0 THEN
            INSERT INTO Advertencias_Inventario (
                ID_Sucursal, ID_Producto, Cantidad_Faltante, 
                Procedimiento, Fecha, Usuario
            ) VALUES (
                NEW.Fk_Sucursal, producto_id, cantidad_necesaria,
                NEW.Nombre_Procedimiento, NOW(), NEW.Registrado_Por
            );
        END IF;

        -- Eliminar productos con cantidad 0 o menos
        DELETE FROM PRODUCTOS_EN_CARRITO 
        WHERE ID_CARRITO = carrito_id 
        AND CANTIDAD <= 0;
    END LOOP;

    CLOSE cur;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRODUCTOS_EN_CARRITO`
--

CREATE TABLE `PRODUCTOS_EN_CARRITO` (
  `ID_PRODUCTO` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `ID_CARRITO` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_En_Procedimientos`
--

CREATE TABLE `Productos_En_Procedimientos` (
  `IDProductoProc` int(11) NOT NULL,
  `Fk_Proced` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fk_Produc_Stock` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_Equivalentes`
--

CREATE TABLE `Productos_Equivalentes` (
  `ID_Equivalencia` int(11) NOT NULL,
  `ID_Producto_Principal` int(11) DEFAULT NULL,
  `ID_Producto_Equivalente` int(11) DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_POS`
--

CREATE TABLE `Productos_POS` (
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(250) DEFAULT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Enfermeria` varchar(100) NOT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(3000) DEFAULT NULL,
  `Precio_Venta` decimal(50,2) DEFAULT NULL,
  `Precio_C` decimal(50,2) DEFAULT NULL,
  `Min_Existencia` int(12) DEFAULT NULL,
  `Max_Existencia` int(11) DEFAULT NULL,
  `Porcentaje` decimal(50,2) NOT NULL,
  `Descuento` decimal(50,2) NOT NULL,
  `Precio_Promo` decimal(50,2) NOT NULL,
  `Lote_Med` varchar(200) DEFAULT NULL,
  `Fecha_Caducidad` date DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Vendido` int(11) NOT NULL,
  `Saldo` int(11) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Componente_Activo` varchar(250) NOT NULL,
  `Tipo` varchar(500) DEFAULT NULL,
  `FkCategoria` varchar(500) DEFAULT NULL,
  `FkMarca` varchar(500) DEFAULT NULL,
  `FkPresentacion` varchar(500) DEFAULT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `RecetaMedica` varchar(100) DEFAULT NULL,
  `Estatus` varchar(150) DEFAULT NULL,
  `CodigoEstatus` varchar(300) DEFAULT NULL,
  `Sistema` varchar(200) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) DEFAULT NULL,
  `Cod_Paquete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Productos_POS`
--
DELIMITER $$
CREATE TRIGGER `DeletesProd` AFTER DELETE ON `Productos_POS` FOR EACH ROW INSERT INTO  Productos_POS_Eliminados
    (ID_Prod_POS, Cod_Barra, Clave_adicional, Nombre_Prod, Precio_Venta, Precio_C,Min_Existencia,Max_Existencia, Porcentaje, Descuento, Precio_Promo,Lote_Med, Fecha_Caducidad, Stock, Vendido, Saldo, Tipo_Servicio, Tipo, FkCategoria, FkMarca, FkPresentacion,Proveedor1,Proveedor2,RecetaMedica,Estatus, CodigoEstatus,Sistema, AgregadoPor, AgregadoEl, ID_H_O_D)
    VALUES (OLD.ID_Prod_POS,OLD.Cod_Barra, OLD.Clave_adicional, OLD.Nombre_Prod, OLD.Precio_Venta, OLD.Precio_C,OLD.Min_Existencia,OLD.Max_Existencia,OLD.Porcentaje,OLD.Descuento, OLD.Precio_Promo,OLD.Lote_Med, OLD.Fecha_Caducidad,OLD.Stock,OLD.Vendido,OLD.Saldo, OLD.Tipo_Servicio, OLD.Tipo, OLD.FkCategoria, OLD.FkMarca, OLD.FkPresentacion,OLD.Proveedor1,OLD.Proveedor2,OLD.RecetaMedica,OLD.Estatus, OLD.CodigoEstatus,OLD.Sistema, OLD.AgregadoPor, Now(), OLD.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdatesProductos` AFTER UPDATE ON `Productos_POS` FOR EACH ROW INSERT INTO  Productos_POS_Audita
    (ID_Prod_POS, Cod_Barra, Clave_adicional, Nombre_Prod, Precio_Venta, Precio_C,Min_Existencia,Max_Existencia, Porcentaje, Descuento, Precio_Promo,Lote_Med, Fecha_Caducidad, Stock, Vendido, Saldo, Tipo_Servicio, Tipo, FkCategoria, FkMarca, FkPresentacion,Proveedor1,Proveedor2,RecetaMedica,Estatus, CodigoEstatus,Sistema, AgregadoPor, AgregadoEl, ID_H_O_D)
    VALUES (NEW.ID_Prod_POS,NEW.Cod_Barra, NEW.Clave_adicional, NEW.Nombre_Prod, NEW.Precio_Venta, NEW.Precio_C,NEW.Min_Existencia,NEW.Max_Existencia,NEW.Porcentaje,NEW.Descuento, NEW.Precio_Promo,NEW.Lote_Med, NEW.Fecha_Caducidad,NEW.Stock,NEW.Vendido,NEW.Saldo, NEW.Tipo_Servicio, NEW.Tipo, NEW.FkCategoria, NEW.FkMarca, NEW.FkPresentacion,NEW.Proveedor1,NEW.Proveedor2,NEW.RecetaMedica,NEW.Estatus, NEW.CodigoEstatus,NEW.Sistema, NEW.AgregadoPor, Now(), NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_POSV2`
--

CREATE TABLE `Productos_POSV2` (
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(250) DEFAULT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Enfermeria` varchar(100) NOT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(1000) DEFAULT NULL,
  `Precio_Venta` decimal(50,2) DEFAULT NULL,
  `Precio_C` decimal(50,2) DEFAULT NULL,
  `Min_Existencia` int(12) DEFAULT NULL,
  `Max_Existencia` int(11) DEFAULT NULL,
  `Precio_Promo` decimal(50,2) DEFAULT NULL,
  `Lote_Med` varchar(200) DEFAULT NULL,
  `Fecha_Caducidad` date DEFAULT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Componente_Activo` varchar(250) NOT NULL,
  `Tipo` varchar(400) DEFAULT NULL,
  `FkCategoria` varchar(400) DEFAULT NULL,
  `FkMarca` varchar(400) DEFAULT NULL,
  `FkPresentacion` varchar(400) DEFAULT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `RecetaMedica` varchar(100) DEFAULT NULL,
  `Estatus` varchar(150) DEFAULT NULL,
  `CodigoEstatus` varchar(300) DEFAULT NULL,
  `Sistema` varchar(200) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) DEFAULT NULL,
  `Cod_Paquete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_POS_Audita`
--

CREATE TABLE `Productos_POS_Audita` (
  `ID_Audita_PROD` int(11) NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(250) NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Nombre_Prod` varchar(1000) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Porcentaje` decimal(50,2) DEFAULT NULL,
  `Descuento` decimal(50,2) DEFAULT NULL,
  `Precio_Promo` decimal(50,2) DEFAULT NULL,
  `Lote_Med` varchar(200) DEFAULT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Stock` int(11) NOT NULL,
  `Vendido` int(11) NOT NULL,
  `Saldo` int(11) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Tipo` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkCategoria` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkMarca` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkPresentacion` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `RecetaMedica` varchar(100) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_POS_Eliminados`
--

CREATE TABLE `Productos_POS_Eliminados` (
  `ID_Eliminado` int(11) NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(250) DEFAULT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Nombre_Prod` varchar(1000) DEFAULT NULL,
  `Precio_Venta` decimal(50,2) DEFAULT NULL,
  `Precio_C` decimal(50,2) DEFAULT NULL,
  `Min_Existencia` int(12) DEFAULT NULL,
  `Max_Existencia` int(11) DEFAULT NULL,
  `Porcentaje` decimal(50,2) DEFAULT NULL,
  `Descuento` decimal(50,2) DEFAULT NULL,
  `Precio_Promo` decimal(50,2) DEFAULT NULL,
  `Lote_Med` varchar(200) DEFAULT NULL,
  `Fecha_Caducidad` date DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Vendido` int(11) DEFAULT NULL,
  `Saldo` int(11) DEFAULT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Tipo` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkCategoria` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkMarca` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkPresentacion` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `RecetaMedica` varchar(100) DEFAULT NULL,
  `Estatus` varchar(150) DEFAULT NULL,
  `CodigoEstatus` varchar(300) DEFAULT NULL,
  `Sistema` varchar(200) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos_POS_SincronizarNuevos`
--

CREATE TABLE `Productos_POS_SincronizarNuevos` (
  `ID_Sincronizacion` int(11) NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(250) DEFAULT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Nombre_Prod` varchar(1000) DEFAULT NULL,
  `Precio_Venta` decimal(50,2) DEFAULT NULL,
  `Precio_C` decimal(50,2) DEFAULT NULL,
  `Min_Existencia` int(12) DEFAULT NULL,
  `Max_Existencia` int(11) DEFAULT NULL,
  `Porcentaje` decimal(50,2) DEFAULT NULL,
  `Descuento` decimal(50,2) DEFAULT NULL,
  `Precio_Promo` decimal(50,2) DEFAULT NULL,
  `Lote_Med` varchar(200) DEFAULT NULL,
  `Fecha_Caducidad` date DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Vendido` int(11) DEFAULT NULL,
  `Saldo` int(11) DEFAULT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Tipo` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkCategoria` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkMarca` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `FkPresentacion` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `RecetaMedica` varchar(100) DEFAULT NULL,
  `Estatus` varchar(150) DEFAULT NULL,
  `CodigoEstatus` varchar(300) DEFAULT NULL,
  `Sistema` varchar(200) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) DEFAULT NULL,
  `Fk_SucursalSincro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Productos_POS_SincronizarNuevos`
--
DELIMITER $$
CREATE TRIGGER `ValidaSincro` BEFORE UPDATE ON `Productos_POS_SincronizarNuevos` FOR EACH ROW INSERT INTO VerificacionSincronizacion_Productos
(ID_Prod_POS,Fk_SucursalSincro,Fecha_hora) VALUES
(NEW.ID_Prod_POS,NEW.Fk_SucursalSincro,now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Programacion_MedicosExt`
--

CREATE TABLE `Programacion_MedicosExt` (
  `ID_Programacion` int(11) NOT NULL,
  `FK_Medico` int(11) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Tipo_Programacion` varchar(100) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Hora_inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Intervalo` int(11) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `ProgramadoPor` varchar(300) NOT NULL,
  `ProgramadoEn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(300) NOT NULL,
  `ID_H_O_D` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Programacion_MedicosExt`
--
DELIMITER $$
CREATE TRIGGER `Horarios_completos` AFTER DELETE ON `Programacion_MedicosExt` FOR EACH ROW INSERT INTO  Programacion_MedicosExt_Completos
    (ID_Programacion, FK_Medico, Fk_Sucursal, Tipo_Programacion, Fecha_Inicio, Fecha_Fin, Hora_inicio, Hora_Fin, Intervalo, Estatus, ProgramadoPor, ProgramadoEn, Sistema, ID_H_O_D)
    VALUES (OLD.ID_Programacion, OLD.FK_Medico, OLD.Fk_Sucursal, OLD.Tipo_Programacion, OLD.Fecha_Inicio, OLD.Fecha_Fin, OLD.Hora_inicio, OLD.Hora_Fin, OLD.Intervalo, OLD.Estatus, OLD.ProgramadoPor, NOW(), OLD.Sistema,OLD.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Programacion_MedicosExt_Completos`
--

CREATE TABLE `Programacion_MedicosExt_Completos` (
  `Audita_Programacion` int(11) NOT NULL,
  `ID_Programacion` int(11) NOT NULL,
  `FK_Medico` int(11) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Tipo_Programacion` varchar(100) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Hora_inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Intervalo` int(11) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `ProgramadoPor` varchar(300) NOT NULL,
  `ProgramadoEn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(300) NOT NULL,
  `ID_H_O_D` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Programacion_Medicos_Sucursales`
--

CREATE TABLE `Programacion_Medicos_Sucursales` (
  `ID_Programacion` int(11) NOT NULL,
  `FK_Medico` int(11) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Tipo_Programacion` varchar(100) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Hora_inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Intervalo` int(11) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `ProgramadoPor` varchar(300) NOT NULL,
  `ProgramadoEn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(300) NOT NULL,
  `ID_H_O_D` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Promos_Credit_POS`
--

CREATE TABLE `Promos_Credit_POS` (
  `ID_Promo_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Promo` varchar(250) NOT NULL,
  `CantidadADescontar` decimal(50,2) NOT NULL,
  `Fk_Tratamiento` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Promos_Credit_POS`
--
DELIMITER $$
CREATE TRIGGER `Audita_Promos_Cred` AFTER INSERT ON `Promos_Credit_POS` FOR EACH ROW INSERT INTO Promos_Credit_POS_Audita
    (ID_Promo_Cred,Nombre_Promo,CantidadADescontar,Fk_Tratamiento,Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Promo_Cred,NEW.Nombre_Promo,NEW.CantidadADescontar,NEW.Fk_Tratamiento,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update_CreditosAudita` BEFORE UPDATE ON `Promos_Credit_POS` FOR EACH ROW INSERT INTO Promos_Credit_POS_Audita
    (ID_Promo_Cred,Nombre_Promo,CantidadADescontar,Fk_Tratamiento,Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Promo_Cred,NEW.Nombre_Promo,NEW.CantidadADescontar,NEW.Fk_Tratamiento,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Promos_Credit_POS_Audita`
--

CREATE TABLE `Promos_Credit_POS_Audita` (
  `ID_Update` int(11) NOT NULL,
  `ID_Promo_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Promo` varchar(250) NOT NULL,
  `CantidadADescontar` decimal(50,2) NOT NULL,
  `Fk_Tratamiento` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedores_POS`
--

CREATE TABLE `Proveedores_POS` (
  `ID_Proveedor` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Proveedor` varchar(250) NOT NULL,
  `Rfc_Prov` varchar(13) NOT NULL,
  `Clave_Proveedor` varchar(12) NOT NULL,
  `Numero_Contacto` varchar(50) NOT NULL,
  `Correo_Electronico` varchar(150) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Proveedores_POS`
--
DELIMITER $$
CREATE TRIGGER `Proveedores_Updates` AFTER UPDATE ON `Proveedores_POS` FOR EACH ROW INSERT INTO Proveedores_POS_Updates
    (ID_Proveedor,Nombre_Proveedor,Rfc_Prov,Clave_Proveedor,Numero_Contacto,	Correo_Electronico,AgregadoPor,Agregadoel,Sistema,Estatus,CodigoEstatus,ID_H_O_D)
    VALUES (NEW.ID_Proveedor,NEW.Nombre_Proveedor,NEW.Rfc_Prov,NEW.Clave_Proveedor,NEW.	Numero_Contacto,NEW.Correo_Electronico,NEW.AgregadoPor,Now(),NEW.Sistema,NEW.Estatus,NEW.CodigoEstatus,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proveedores_POS_Updates`
--

CREATE TABLE `Proveedores_POS_Updates` (
  `ID_Update_Prov` int(11) NOT NULL,
  `ID_Proveedor` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Proveedor` varchar(250) NOT NULL,
  `Rfc_Prov` varchar(13) NOT NULL,
  `Clave_Proveedor` varchar(12) NOT NULL,
  `Numero_Contacto` varchar(50) NOT NULL,
  `Correo_Electronico` varchar(150) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `Estatus` varchar(250) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recetario_Medicos`
--

CREATE TABLE `Recetario_Medicos` (
  `ID_Receta` int(11) NOT NULL,
  `Fk_SignoV` int(11) NOT NULL,
  `Fk_Folio` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Dx` varchar(400) NOT NULL,
  `Tx` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `escuela` varchar(255) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Registros_Combustibles`
--

CREATE TABLE `Registros_Combustibles` (
  `Id_Registro` int(11) NOT NULL,
  `Registro_combustible` varchar(500) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `Sucursal` varchar(500) NOT NULL,
  `Comentario` varchar(500) NOT NULL,
  `Registro` varchar(500) NOT NULL,
  `Agregadoel` datetime NOT NULL,
  `ID_H_O_D` varchar(50) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `Tipo_Veiculo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Registros_Energia`
--

CREATE TABLE `Registros_Energia` (
  `Id_Registro` int(11) NOT NULL,
  `Registro_energia` varchar(100) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `Sucursal` varchar(100) NOT NULL,
  `Comentario` varchar(200) NOT NULL,
  `Registro` varchar(120) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `file_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Registros_Mantenimiento`
--

CREATE TABLE `Registros_Mantenimiento` (
  `Id_Registro` int(11) NOT NULL,
  `Fecha_registro` date NOT NULL,
  `Registro_mantenimiento` varchar(50) NOT NULL,
  `Sucursal` varchar(100) NOT NULL,
  `Comentario` varchar(2000) NOT NULL,
  `Registro` varchar(120) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `file_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_errores_Actualizacionanaqueles`
--

CREATE TABLE `registro_errores_Actualizacionanaqueles` (
  `id` int(11) NOT NULL,
  `mensaje_error` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Registro_Traspasos`
--

CREATE TABLE `Registro_Traspasos` (
  `ID_registro` int(11) NOT NULL,
  `ID_Traspaso_Generado` int(11) NOT NULL,
  `FK_Producto` int(11) NOT NULL,
  `Cod_Barrra` varchar(200) NOT NULL,
  `Cantidad_Enviada` int(11) NOT NULL,
  `Cantidad_Recibida` int(11) NOT NULL,
  `Sucursal_Origen` int(11) NOT NULL,
  `Sucursal_Destino` varchar(200) NOT NULL,
  `Fk_SucDestino` int(11) NOT NULL,
  `Estado` varchar(200) NOT NULL,
  `Comentario` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `Registro` varchar(200) NOT NULL,
  `Registradoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Registro_Traspasos`
--
DELIMITER $$
CREATE TRIGGER `ActualizaPorMedioDeTraspaso` AFTER INSERT ON `Registro_Traspasos` FOR EACH ROW Update Stock_POS
set Stock_POS.Existencias_R = Stock_POS.Existencias_R + NEW.Cantidad_Recibida
where Stock_POS.ID_Prod_POS = NEW.FK_Producto AND Stock_POS.Fk_sucursal = NEW.Fk_SucDestino
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ReimpresionesTickets_CreditosClinicas`
--

CREATE TABLE `ReimpresionesTickets_CreditosClinicas` (
  `ID_Reimpresion` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Folio_Ticket` int(11) NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `Cantidad_Prod` int(11) NOT NULL,
  `SaldoAnterior` decimal(50,2) NOT NULL,
  `Cant_Abono` decimal(50,2) NOT NULL,
  `Fecha_Abono` date NOT NULL,
  `Saldo` decimal(52,2) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `Pagoen` time NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ReimpresionesTickets_CreditosDentales`
--

CREATE TABLE `ReimpresionesTickets_CreditosDentales` (
  `ID_Reimpresion` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Folio_Ticket` int(11) NOT NULL,
  `Fk_tipo_Credi` varchar(300) NOT NULL,
  `Nombre_Cred` varchar(250) NOT NULL,
  `SaldoAnterior` decimal(50,2) NOT NULL,
  `Cant_Abono` decimal(50,2) NOT NULL,
  `Fecha_Abono` date NOT NULL,
  `Saldo` decimal(52,2) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Validez` date NOT NULL,
  `Agrega` varchar(250) NOT NULL,
  `Pagoen` time NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reloj_Checador`
--

CREATE TABLE `Reloj_Checador` (
  `ID_Chequeo` int(11) NOT NULL,
  `Number_Empleado` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Sucursal` varchar(200) NOT NULL,
  `Area` varchar(200) NOT NULL,
  `Hora_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reloj_ChecadorV2`
--

CREATE TABLE `Reloj_ChecadorV2` (
  `ID_Chequeo` int(11) NOT NULL,
  `Number_Empleado` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Sucursal` varchar(200) NOT NULL,
  `Area` varchar(200) NOT NULL,
  `TipoMovimiento` varchar(200) NOT NULL,
  `Hora_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reloj_ChecadorV2Entrada`
--

CREATE TABLE `Reloj_ChecadorV2Entrada` (
  `ID_Chequeo` int(11) NOT NULL,
  `Number_Empleado` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Sucursal` varchar(200) NOT NULL,
  `Area` varchar(200) NOT NULL,
  `TipoMovimiento` varchar(200) NOT NULL,
  `Hora_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reloj_ChecadorV2_EntradasComida`
--

CREATE TABLE `Reloj_ChecadorV2_EntradasComida` (
  `ID_Chequeo` int(11) NOT NULL,
  `Number_Empleado` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Sucursal` varchar(200) NOT NULL,
  `Area` varchar(200) NOT NULL,
  `TipoMovimiento` varchar(200) NOT NULL,
  `Hora_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reloj_ChecadorV2_Salidas`
--

CREATE TABLE `Reloj_ChecadorV2_Salidas` (
  `ID_Chequeo` int(11) NOT NULL,
  `Number_Empleado` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Sucursal` varchar(200) NOT NULL,
  `Area` varchar(200) NOT NULL,
  `TipoMovimiento` varchar(200) NOT NULL,
  `Hora_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reloj_ChecadorV2_SalidasComida`
--

CREATE TABLE `Reloj_ChecadorV2_SalidasComida` (
  `ID_Chequeo` int(11) NOT NULL,
  `Number_Empleado` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Sucursal` varchar(200) NOT NULL,
  `Area` varchar(200) NOT NULL,
  `TipoMovimiento` varchar(200) NOT NULL,
  `Hora_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Resultados_Ultrasonidos`
--

CREATE TABLE `Resultados_Ultrasonidos` (
  `ID_resultado` int(11) NOT NULL,
  `Nombre_paciente` varchar(250) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `ID_Sucursal` varchar(150) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `Codigo_color` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles_Puestos`
--

CREATE TABLE `Roles_Puestos` (
  `ID_rol` int(11) NOT NULL,
  `Nombre_rol` varchar(150) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL,
  `Agrego` varchar(250) NOT NULL,
  `Estado` int(11) NOT NULL,
  `AgregadoEn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rutas`
--

CREATE TABLE `Rutas` (
  `Id_ruta` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora_inicio` time NOT NULL,
  `Hora_fin` time NOT NULL,
  `Notas` text DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Id_personal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicios_Especializados`
--

CREATE TABLE `Servicios_Especializados` (
  `Especialista_ID` int(11) NOT NULL,
  `Nombre_Apellidos` varchar(250) DEFAULT NULL,
  `file_name` varchar(300) NOT NULL COMMENT 'Es donde se almacena el nombre de foto de perfil, que se sube al servidor',
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `Pass_Especialista` varchar(10) DEFAULT NULL,
  `Fk_Usuario` int(11) NOT NULL,
  `ID_Sucursal` varchar(150) DEFAULT NULL,
  `ID_H_O_D` varchar(200) DEFAULT NULL,
  `Estatus` varchar(100) NOT NULL,
  `Fk_Logo_identidad` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicios_POS`
--

CREATE TABLE `Servicios_POS` (
  `Servicio_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Serv` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Servicios_POS`
--
DELIMITER $$
CREATE TRIGGER `Audita_Servicios_POS` AFTER INSERT ON `Servicios_POS` FOR EACH ROW INSERT INTO Servicios_POS_Audita
(Servicio_ID,Nom_Serv,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Servicio_ID,NEW.Nom_Serv,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_Servicios_POS_Updates` AFTER UPDATE ON `Servicios_POS` FOR EACH ROW INSERT INTO Servicios_POS_Audita
(Servicio_ID,Nom_Serv,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Servicio_ID,NEW.Nom_Serv,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicios_POS_Audita`
--

CREATE TABLE `Servicios_POS_Audita` (
  `Audita_Serv_ID` int(11) NOT NULL,
  `Servicio_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Serv` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Signos_Vitales`
--

CREATE TABLE `Signos_Vitales` (
  `ID_SignoV` int(11) NOT NULL,
  `Nombre_Paciente` varchar(150) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Talla` decimal(5,1) DEFAULT NULL,
  `Peso` varchar(100) DEFAULT NULL,
  `Temp` varchar(100) DEFAULT NULL,
  `TA` varchar(100) DEFAULT NULL,
  `FC` varchar(100) DEFAULT NULL,
  `FR` varchar(100) DEFAULT NULL,
  `DxTx` varchar(100) DEFAULT NULL,
  `Sa02` varchar(100) DEFAULT NULL,
  `Alergias` varchar(250) DEFAULT NULL,
  `Motivo_Consulta` varchar(250) DEFAULT NULL,
  `Nombres_Enfermero` varchar(250) NOT NULL,
  `Nombre_Doctor` varchar(250) NOT NULL,
  `Fk_Sucursal` varchar(150) NOT NULL,
  `FK_ID_H_O_D` varchar(150) NOT NULL,
  `ID_TURNO` varchar(150) NOT NULL,
  `Fecha_Consulta` date NOT NULL,
  `Hora_Cita` varchar(200) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `Lugar_procedencia` varchar(250) NOT NULL,
  `Enterado` varchar(250) DEFAULT NULL,
  `Visita` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Signos_VitalesV2`
--

CREATE TABLE `Signos_VitalesV2` (
  `ID_SignoV` int(11) NOT NULL,
  `FolioSignoVital` int(50) NOT NULL,
  `Folio_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Paciente` varchar(150) DEFAULT NULL,
  `Edad` varchar(150) DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `Peso` varchar(100) DEFAULT NULL,
  `Talla` varchar(50) DEFAULT NULL,
  `IMC` varchar(150) NOT NULL,
  `Estatus_IMC` varchar(150) NOT NULL,
  `Temp` varchar(100) DEFAULT NULL,
  `FC` varchar(100) DEFAULT NULL,
  `FR` varchar(100) DEFAULT NULL,
  `TA` varchar(100) DEFAULT NULL,
  `TA2` int(11) NOT NULL,
  `Sa02` varchar(100) DEFAULT NULL,
  `DxTx` varchar(100) DEFAULT NULL,
  `Motivo_Consulta` varchar(250) DEFAULT NULL,
  `Nombre_Doctor` varchar(250) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(150) NOT NULL,
  `Estado` varchar(250) NOT NULL,
  `Municipio` varchar(250) NOT NULL,
  `Localidad` varchar(250) NOT NULL,
  `Fecha_Visita` timestamp NOT NULL DEFAULT current_timestamp(),
  `Alergias` varchar(250) DEFAULT NULL,
  `Fk_Sucursal` varchar(150) NOT NULL,
  `ID_TURNO` varchar(150) NOT NULL,
  `Enterado` varchar(250) DEFAULT NULL,
  `Visita` varchar(100) DEFAULT NULL,
  `Fk_Enfermero` varchar(200) NOT NULL,
  `FK_ID_H_O_D` varchar(150) NOT NULL,
  `Area` varchar(250) NOT NULL,
  `Tratamiento` varchar(250) NOT NULL,
  `Importe` decimal(50,2) NOT NULL,
  `Fk_Ticket` int(11) NOT NULL,
  `Contactado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sincronizacion_Cajas`
--

CREATE TABLE `Sincronizacion_Cajas` (
  `Id_Sincroniza` int(11) NOT NULL,
  `ID_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_Fondo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cantidad_Fondo` decimal(50,2) NOT NULL,
  `Empleado` varchar(250) NOT NULL,
  `Sucursal` int(11) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(250) NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Turno` varchar(300) NOT NULL,
  `Asignacion` int(11) NOT NULL,
  `D1000` decimal(11,0) NOT NULL,
  `D500` int(11) NOT NULL,
  `D200` int(11) NOT NULL,
  `D100` int(11) NOT NULL,
  `D50` int(11) NOT NULL,
  `D20` int(11) NOT NULL,
  `D10` int(11) NOT NULL,
  `D5` int(11) NOT NULL,
  `D2` int(11) NOT NULL,
  `D1` int(11) NOT NULL,
  `D50C` int(11) NOT NULL,
  `D20C` int(11) NOT NULL,
  `D10C` int(11) NOT NULL,
  `Valor_Total_Caja` decimal(50,2) NOT NULL,
  `Hora_apertura` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Solicitudes_Ingresos`
--

CREATE TABLE `Solicitudes_Ingresos` (
  `IdProdCedis` int(12) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `NumFactura` varchar(200) NOT NULL,
  `Proveedor` varchar(200) NOT NULL,
  `Cod_Barra` varchar(250) DEFAULT NULL,
  `Nombre_Prod` varchar(1000) DEFAULT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Contabilizado` int(11) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `PrecioMaximo` double(50,2) NOT NULL,
  `Precio_Venta` decimal(50,2) DEFAULT NULL,
  `Precio_C` decimal(50,2) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `FechaInventario` date NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `NumOrden` int(10) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Solicitudes_Traspasos`
--

CREATE TABLE `Solicitudes_Traspasos` (
  `ID_Sol_Traspaso` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Sucursal_Destino` int(11) NOT NULL,
  `Fk_Sucursal_Destino` varchar(200) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Cantidad_Solicitada` int(11) NOT NULL,
  `Motivo_Solicitud` varchar(300) NOT NULL,
  `SolicitadoPor` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_Bajas`
--

CREATE TABLE `Stock_Bajas` (
  `Id_Baja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `MotivoBaja` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `TipoMovimiento` varchar(200) NOT NULL,
  `Estado` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Stock_Bajas`
--
DELIMITER $$
CREATE TRIGGER `DescontarStockYDevolucionEnCaducado` AFTER INSERT ON `Stock_Bajas` FOR EACH ROW BEGIN
    -- Descontar de Stock_POS
    UPDATE Stock_POS
    SET Existencias_R = Existencias_R - NEW.Cantidad,
        ActualizadoPorBajaOCaducado = NEW.AgregadoPor,
        ActualizadoPorBajaOCaducadoFechaHora = NOW()
    WHERE ID_Prod_POS = NEW.ID_Prod_POS
      AND Fk_sucursal = NEW.Fk_sucursal;

    -- Descontar de Devolucion_POS
    UPDATE Devolucion_POS
    SET Cantidad = Cantidad - NEW.Cantidad,
        ActualizadoPor = NEW.AgregadoPor,
        ActualizadoEl = NOW()
    WHERE Cod_Barra = NEW.Cod_Barra
      AND Fk_Suc_Salida = NEW.Fk_sucursal
      AND Cantidad >= NEW.Cantidad; -- Solo si hay suficiente cantidad
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_devolucion_pos` AFTER INSERT ON `Stock_Bajas` FOR EACH ROW BEGIN
    IF NEW.TipoMovimiento IS NOT NULL THEN
        UPDATE Devolucion_POS
        SET Movimiento = NEW.TipoMovimiento
        WHERE Cod_Barra = NEW.Cod_Barra AND Fk_Suc_Salida = NEW.Fk_sucursal;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_Dental`
--

CREATE TABLE `Stock_Dental` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkCategoria` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkMarca` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkPresentacion` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_Enfermeria`
--

CREATE TABLE `Stock_Enfermeria` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Cod_Enfermeria` varchar(200) NOT NULL,
  `Cod_Procedimiento` varchar(200) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_Med`
--

CREATE TABLE `Stock_Med` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkCategoria` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkMarca` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkPresentacion` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_POS`
--

CREATE TABLE `Stock_POS` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Cod_Enfermeria` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` varchar(500) NOT NULL,
  `FkCategoria` varchar(500) NOT NULL,
  `FkMarca` varchar(500) NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `ActualizoFecha` varchar(200) NOT NULL,
  `Cod_Paquete` int(11) NOT NULL,
  `Contabilizado` varchar(100) NOT NULL,
  `FechaDeInventario` date NOT NULL,
  `Anaquel` varchar(150) NOT NULL,
  `Repisa` varchar(150) NOT NULL,
  `ActualizadoPor` varchar(250) NOT NULL,
  `UltimoIngresoRealizado` date NOT NULL,
  `UltimoIngresoRealizadoPor` varchar(250) NOT NULL,
  `UltimaFactura` varchar(250) NOT NULL,
  `ActualizadoPorBajaOCaducado` varchar(200) NOT NULL,
  `ActualizadoPorBajaOCaducadoFechaHora` timestamp NOT NULL,
  `TipoMov` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Stock_POS`
--
DELIMITER $$
CREATE TRIGGER `Actualiza_data_enfermeros` AFTER UPDATE ON `Stock_POS` FOR EACH ROW IF OLD.Precio_Venta != NEW.Precio_Venta THEN
UPDATE Stock_Enfermeria
SET Precio_Venta = NEW.Precio_Venta;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AuditaStock` AFTER INSERT ON `Stock_POS` FOR EACH ROW INSERT INTO Stock_POS_Audita
 (Folio_Prod_Stock,ID_Prod_POS,Clave_adicional,Cod_Barra,Nombre_Prod, Fk_sucursal, Precio_Venta, Precio_C, Max_Existencia,Min_Existencia, Existencias_R,Lote,Fecha_Caducidad,Tipo_Servicio,Tipo,FkCategoria,FkMarca, FkPresentacion, Proveedor1, Proveedor2, Estatus, CodigoEstatus,Sistema, AgregadoPor, AgregadoEl, ID_H_O_D)
    VALUES (NEW.Folio_Prod_Stock,NEW.ID_Prod_POS,NEW.Clave_adicional,NEW.Cod_Barra,NEW.Nombre_Prod, NEW.Fk_sucursal, NEW.Precio_Venta, NEW.Precio_C, NEW.Max_Existencia,NEW.Min_Existencia, NEW.Existencias_R,NEW.Lote,NEW.Fecha_Caducidad,NEW.Tipo_Servicio,NEW.Tipo,NEW.FkCategoria,NEW.FkMarca, NEW.FkPresentacion, NEW.Proveedor1, NEW.Proveedor2, NEW.Estatus, NEW.CodigoEstatus,NEW.Sistema, NEW.AgregadoPor,Now(),NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AuditaStock_Update` AFTER UPDATE ON `Stock_POS` FOR EACH ROW INSERT INTO Stock_POS_Audita
 (Folio_Prod_Stock,ID_Prod_POS,Clave_adicional,Cod_Barra,Nombre_Prod, Fk_sucursal, Precio_Venta, Precio_C, Max_Existencia,Min_Existencia, Existencias_R,Lote,Fecha_Caducidad,Tipo_Servicio,Tipo,FkCategoria,FkMarca, FkPresentacion, Proveedor1, Proveedor2, Estatus, CodigoEstatus,Sistema, AgregadoPor, AgregadoEl, ID_H_O_D,Contabilizado,	FechaDeInventario)
    VALUES (NEW.Folio_Prod_Stock,NEW.ID_Prod_POS,NEW.Clave_adicional,NEW.Cod_Barra,NEW.Nombre_Prod, NEW.Fk_sucursal, NEW.Precio_Venta, NEW.Precio_C, NEW.Max_Existencia,NEW.Min_Existencia, NEW.Existencias_R,NEW.Lote,NEW.Fecha_Caducidad,NEW.Tipo_Servicio,NEW.Tipo,NEW.FkCategoria,NEW.FkMarca, NEW.FkPresentacion, NEW.Proveedor1, NEW.Proveedor2, NEW.Estatus, NEW.CodigoEstatus,NEW.Sistema, NEW.AgregadoPor,Now(),NEW.ID_H_O_D,NEW.Contabilizado,NEW.FechaDeInventario)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_stock_pos` AFTER INSERT ON `Stock_POS` FOR EACH ROW BEGIN
    INSERT INTO Stock_POS_TablaAuditorias (
        Folio_Prod_Stock, ID_Prod_POS, Clave_adicional, Clave_Levic, Cod_Enfermeria, Cod_Barra, 
        Nombre_Prod, Fk_sucursal, Precio_Venta, Precio_C, Max_Existencia, Min_Existencia, 
        Existencias_R, Lote, Fecha_Caducidad, Fecha_Ingreso, Tipo_Servicio, Tipo, FkCategoria, 
        FkMarca, FkPresentacion, Proveedor1, Proveedor2, Estatus, CodigoEstatus, Sistema, 
        AgregadoPor, AgregadoEl, ID_H_O_D, ActualizoFecha, Cod_Paquete, Contabilizado, 
        FechaDeInventario, Anaquel, Repisa, ActualizadoPor, UltimoIngresoRealizado, 
        UltimoIngresoRealizadoPor, UltimaFactura, ActualizadoPorBajaOCaducado, 
        ActualizadoPorBajaOCaducadoFechaHora, TipoMov
    )
    VALUES (
        NEW.Folio_Prod_Stock, NEW.ID_Prod_POS, NEW.Clave_adicional, NEW.Clave_Levic, NEW.Cod_Enfermeria, 
        NEW.Cod_Barra, NEW.Nombre_Prod, NEW.Fk_sucursal, NEW.Precio_Venta, NEW.Precio_C, 
        NEW.Max_Existencia, NEW.Min_Existencia, NEW.Existencias_R, NEW.Lote, NEW.Fecha_Caducidad, 
        NEW.Fecha_Ingreso, NEW.Tipo_Servicio, NEW.Tipo, NEW.FkCategoria, NEW.FkMarca, NEW.FkPresentacion, 
        NEW.Proveedor1, NEW.Proveedor2, NEW.Estatus, NEW.CodigoEstatus, NEW.Sistema, NEW.AgregadoPor, 
        NEW.AgregadoEl, NEW.ID_H_O_D, NEW.ActualizoFecha, NEW.Cod_Paquete, NEW.Contabilizado, 
        NEW.FechaDeInventario, NEW.Anaquel, NEW.Repisa, NEW.ActualizadoPor, NEW.UltimoIngresoRealizado, 
        NEW.UltimoIngresoRealizadoPor, NEW.UltimaFactura, NEW.ActualizadoPorBajaOCaducado, 
        NEW.ActualizadoPorBajaOCaducadoFechaHora,NEW.TipoMov
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_stock_pos` AFTER UPDATE ON `Stock_POS` FOR EACH ROW BEGIN
    INSERT INTO Stock_POS_TablaAuditorias (
        Folio_Prod_Stock, ID_Prod_POS, Clave_adicional, Clave_Levic, Cod_Enfermeria, Cod_Barra, 
        Nombre_Prod, Fk_sucursal, Precio_Venta, Precio_C, Max_Existencia, Min_Existencia, 
        Existencias_R, Lote, Fecha_Caducidad, Fecha_Ingreso, Tipo_Servicio, Tipo, FkCategoria, 
        FkMarca, FkPresentacion, Proveedor1, Proveedor2, Estatus, CodigoEstatus, Sistema, 
        AgregadoPor, AgregadoEl, ID_H_O_D, ActualizoFecha, Cod_Paquete, Contabilizado, 
        FechaDeInventario, Anaquel, Repisa, ActualizadoPor, UltimoIngresoRealizado, 
        UltimoIngresoRealizadoPor, UltimaFactura, ActualizadoPorBajaOCaducado, 
        ActualizadoPorBajaOCaducadoFechaHora, TipoMov
    )
    VALUES (
        NEW.Folio_Prod_Stock, NEW.ID_Prod_POS, NEW.Clave_adicional, NEW.Clave_Levic, NEW.Cod_Enfermeria, 
        NEW.Cod_Barra, NEW.Nombre_Prod, NEW.Fk_sucursal, NEW.Precio_Venta, NEW.Precio_C, 
        NEW.Max_Existencia, NEW.Min_Existencia, NEW.Existencias_R, NEW.Lote, NEW.Fecha_Caducidad, 
        NEW.Fecha_Ingreso, NEW.Tipo_Servicio, NEW.Tipo, NEW.FkCategoria, NEW.FkMarca, NEW.FkPresentacion, 
        NEW.Proveedor1, NEW.Proveedor2, NEW.Estatus, NEW.CodigoEstatus, NEW.Sistema, NEW.AgregadoPor, 
        NEW.AgregadoEl, NEW.ID_H_O_D, NEW.ActualizoFecha, NEW.Cod_Paquete, NEW.Contabilizado, 
        NEW.FechaDeInventario, NEW.Anaquel, NEW.Repisa, NEW.ActualizadoPor, NEW.UltimoIngresoRealizado, 
        NEW.UltimoIngresoRealizadoPor, NEW.UltimaFactura, NEW.ActualizadoPorBajaOCaducado, 
        NEW.ActualizadoPorBajaOCaducadoFechaHora, NEW.TipoMov
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `preciosactyakuzdis` AFTER UPDATE ON `Stock_POS` FOR EACH ROW IF OLD.Precio_Venta != NEW.Precio_Venta THEN
INSERT INTO Area_De_Notificaciones
(Tipo_Notificacion,Encabezado,Mensaje_Notificacion, Registrado, Sistema,Sucursal,Estado, ID_H_O_D) VALUES ('Actualización de datos',NEW.Nombre_Prod,NEW.Precio_Venta,NOW(),NEW.Sistema,NEW.Fk_sucursal,'1',NEW.ID_H_O_D);
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_stock_update` AFTER UPDATE ON `Stock_POS` FOR EACH ROW BEGIN
    DECLARE cantidad_anterior INT;
    DECLARE diferencia_cantidad INT;
    
    -- Obtener la cantidad anterior del producto en Stock_POS antes del cambio
    SET cantidad_anterior = OLD.Existencias_R;
    -- Calcular la diferencia entre la cantidad nueva y la anterior
    SET diferencia_cantidad = NEW.Existencias_R - cantidad_anterior;

    -- Si cambia el lote o la fecha de caducidad
    IF NEW.Lote <> OLD.Lote OR NEW.Fecha_Caducidad <> OLD.Fecha_Caducidad THEN
        -- Intentamos actualizar la fecha de caducidad del nuevo lote si ya existe
        UPDATE Lotes_Productos
        SET fecha_caducidad = NEW.Fecha_Caducidad
        WHERE producto_id = NEW.Folio_Prod_Stock
          AND lote = NEW.Lote
          AND sucursal_id = NEW.Fk_sucursal;

        -- Si no se actualizó ningún registro, insertar el nuevo lote con la cantidad adicional
        IF ROW_COUNT() = 0 THEN
            INSERT INTO Lotes_Productos (producto_id, lote, fecha_caducidad, sucursal_id, cantidad, estatus)
            VALUES (NEW.Folio_Prod_Stock, NEW.Lote, NEW.Fecha_Caducidad, NEW.Fk_sucursal, diferencia_cantidad, 'Activo');
        END IF;
    ELSE
        -- Si solo cambia la cantidad sin cambiar lote o fecha
        UPDATE Lotes_Productos
        SET cantidad = NEW.Existencias_R
        WHERE producto_id = NEW.Folio_Prod_Stock
          AND lote = NEW.Lote
          AND sucursal_id = NEW.Fk_sucursal;
    END IF;

    -- ???? Verificación de estatus
    -- Si un lote llega a 0, marcar como "Inactivo"
    UPDATE Lotes_Productos
    SET estatus = 'Inactivo'
    WHERE cantidad <= 0
      AND producto_id = OLD.Folio_Prod_Stock
      AND lote = OLD.Lote
      AND sucursal_id = OLD.Fk_sucursal;

    -- Si un lote recibe stock nuevamente, cambiar a "Disponible"
    UPDATE Lotes_Productos
    SET estatus = 'Disponible'
    WHERE cantidad > 0
      AND producto_id = NEW.Folio_Prod_Stock
      AND lote = NEW.Lote
      AND sucursal_id = NEW.Fk_sucursal;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_POS_ActualizaExistenciasStockOffline`
--

CREATE TABLE `Stock_POS_ActualizaExistenciasStockOffline` (
  `ID_Sincronizacion` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Fk_SucursalSincro` int(11) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `AgregadoPor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_POS_Audita`
--

CREATE TABLE `Stock_POS_Audita` (
  `ID_Audita_Stock` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkCategoria` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkMarca` int(10) UNSIGNED ZEROFILL NOT NULL,
  `FkPresentacion` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `Contabilizado` varchar(100) NOT NULL,
  `FechaDeInventario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_POS_PruebasInv`
--

CREATE TABLE `Stock_POS_PruebasInv` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Cod_Enfermeria` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` varchar(500) NOT NULL,
  `FkCategoria` varchar(500) NOT NULL,
  `FkMarca` varchar(500) NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `ActualizoFecha` varchar(200) NOT NULL,
  `Cod_Paquete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_POS_RespaldoPrevioAMontejo`
--

CREATE TABLE `Stock_POS_RespaldoPrevioAMontejo` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Cod_Enfermeria` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` varchar(500) NOT NULL,
  `FkCategoria` varchar(500) NOT NULL,
  `FkMarca` varchar(500) NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `ActualizoFecha` varchar(200) NOT NULL,
  `Cod_Paquete` int(11) NOT NULL,
  `Contabilizado` varchar(100) NOT NULL,
  `FechaDeInventario` date NOT NULL,
  `Anaquel` varchar(150) NOT NULL,
  `Repisa` varchar(150) NOT NULL,
  `ActualizadoPor` varchar(250) NOT NULL,
  `UltimoIngresoRealizado` date NOT NULL,
  `UltimoIngresoRealizadoPor` varchar(250) NOT NULL,
  `UltimaFactura` varchar(250) NOT NULL,
  `ActualizadoPorBajaOCaducado` varchar(200) NOT NULL,
  `ActualizadoPorBajaOCaducadoFechaHora` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_POS_RespaldoPrevioCaucel`
--

CREATE TABLE `Stock_POS_RespaldoPrevioCaucel` (
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Cod_Enfermeria` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` varchar(500) NOT NULL,
  `FkCategoria` varchar(500) NOT NULL,
  `FkMarca` varchar(500) NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `ActualizoFecha` varchar(200) NOT NULL,
  `Cod_Paquete` int(11) NOT NULL,
  `Contabilizado` varchar(100) NOT NULL,
  `FechaDeInventario` date NOT NULL,
  `Anaquel` varchar(150) NOT NULL,
  `Repisa` varchar(150) NOT NULL,
  `ActualizadoPor` varchar(250) NOT NULL,
  `UltimoIngresoRealizado` date NOT NULL,
  `UltimoIngresoRealizadoPor` varchar(250) NOT NULL,
  `UltimaFactura` varchar(250) NOT NULL,
  `ActualizadoPorBajaOCaducado` varchar(200) NOT NULL,
  `ActualizadoPorBajaOCaducadoFechaHora` timestamp NOT NULL,
  `TipoMov` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_POS_TablaAuditorias`
--

CREATE TABLE `Stock_POS_TablaAuditorias` (
  `IdAuditoria` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Clave_Levic` varchar(100) NOT NULL,
  `Cod_Enfermeria` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Max_Existencia` int(11) NOT NULL,
  `Min_Existencia` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Tipo` varchar(500) NOT NULL,
  `FkCategoria` varchar(500) NOT NULL,
  `FkMarca` varchar(500) NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `CodigoEstatus` varchar(300) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `ActualizoFecha` varchar(200) NOT NULL,
  `Cod_Paquete` int(11) NOT NULL,
  `Contabilizado` varchar(100) NOT NULL,
  `FechaDeInventario` date NOT NULL,
  `Anaquel` varchar(150) NOT NULL,
  `Repisa` varchar(150) NOT NULL,
  `ActualizadoPor` varchar(250) NOT NULL,
  `UltimoIngresoRealizado` date NOT NULL,
  `UltimoIngresoRealizadoPor` varchar(250) NOT NULL,
  `UltimaFactura` varchar(250) NOT NULL,
  `ActualizadoPorBajaOCaducado` varchar(200) NOT NULL,
  `ActualizadoPorBajaOCaducadoFechaHora` timestamp NOT NULL,
  `TipoMov` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Stock_registrosNuevos`
--

CREATE TABLE `Stock_registrosNuevos` (
  `Folio_Ingreso` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barras` varchar(200) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `ExistenciaPrev` int(11) NOT NULL,
  `Recibido` int(11) NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Fecha_Caducidad` date NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `Factura` varchar(200) NOT NULL,
  `Precio_compra` decimal(50,2) NOT NULL,
  `Total_Factura` decimal(50,2) NOT NULL,
  `TipoMov` varchar(400) NOT NULL,
  `FolioUnico` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Stock_registrosNuevos`
--
DELIMITER $$
CREATE TRIGGER `actualiza_devolucion` AFTER INSERT ON `Stock_registrosNuevos` FOR EACH ROW BEGIN
    -- Verifica que el campo FolioUnico tenga datos
    IF NEW.FolioUnico IS NOT NULL THEN
        UPDATE Devolucion_POS
        SET 
            Cantidad = Cantidad - NEW.Recibido,
            Estatus  = 'Ingresado a sucursal'
        WHERE 
            Num_Factura = NEW.Factura
            AND Cod_Barra = NEW.Cod_Barras;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_Stock_registrosNuevos` AFTER INSERT ON `Stock_registrosNuevos` FOR EACH ROW BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        
        DECLARE error_message TEXT;
        
        
        GET DIAGNOSTICS CONDITION 1
            error_message = MESSAGE_TEXT;

        
        INSERT INTO Errores_Stock (error_message) VALUES (CONCAT('Error al actualizar Stock_POS: ', error_message));
    END;

    
    UPDATE Stock_POS
    SET
        Existencias_R = Existencias_R + NEW.Recibido,
        UltimoIngresoRealizadoPor = NEW.AgregadoPor,
        UltimoIngresoRealizado = NOW(),
        AgregadoPor=NEW.AgregadoPor,
        TipoMov=NEW.TipoMov

    WHERE
        Cod_Barra = NEW.Cod_Barras AND
        Fk_sucursal = NEW.Fk_sucursal;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sucursales`
--

CREATE TABLE `Sucursales` (
  `Nombre_ID_Sucursal` varchar(150) NOT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Dueño_Propiedad` varchar(200) DEFAULT NULL,
  `Fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SucursalesCorre`
--

CREATE TABLE `SucursalesCorre` (
  `ID_SucursalC` int(11) NOT NULL,
  `Nombre_Sucursal` varchar(200) NOT NULL,
  `Direccion` varchar(250) NOT NULL,
  `CP` varchar(150) NOT NULL,
  `RFC` varchar(150) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Codigo_identificador` varchar(10) NOT NULL,
  `Telefono` varchar(12) DEFAULT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contra_correo` varchar(250) NOT NULL,
  `Cuenta_Clip` varchar(200) NOT NULL,
  `Clave_Clip` varchar(200) NOT NULL,
  `Pin_Equipo` varchar(20) NOT NULL,
  `Sucursal_Activa` varchar(100) NOT NULL,
  `Agrego` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `Impresora_Tickets` varchar(250) NOT NULL,
  `Url_Drive_Enfermeria` varchar(800) NOT NULL,
  `EstadoSucursalInv` varchar(200) NOT NULL,
  `sistemachecador` varchar(200) NOT NULL,
  `Latitud` varchar(300) NOT NULL,
  `Longitud` varchar(300) NOT NULL,
  `LinkMaps` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sucursales_Audita`
--

CREATE TABLE `Sucursales_Audita` (
  `Audita_Suc` int(11) NOT NULL,
  `ID_SucursalC` int(11) NOT NULL,
  `Nombre_Sucursal` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Telefono` varchar(12) DEFAULT NULL,
  `Agrego` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sucursales_Campañas`
--

CREATE TABLE `Sucursales_Campañas` (
  `ID_SucursalC` int(11) NOT NULL,
  `Nombre_Sucursal` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus_Sucursal` varchar(200) NOT NULL,
  `Color_Sucursal` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sucursales_CampañasV2`
--

CREATE TABLE `Sucursales_CampañasV2` (
  `ID_SucursalC` int(11) NOT NULL,
  `Nombre_Sucursal` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Estatus_Sucursal` varchar(200) NOT NULL,
  `Color_Sucursal` varchar(200) NOT NULL,
  `AgregadoPor` varchar(150) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sucursales_especialistas`
--

CREATE TABLE `Sucursales_especialistas` (
  `ID_Sucursal` int(11) NOT NULL,
  `Nombre_Sucursal` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `FK_Especialista` int(12) NOT NULL,
  `Estatus_Sucursal` varchar(100) NOT NULL,
  `CodigoColorSu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sugerencias_POS`
--

CREATE TABLE `Sugerencias_POS` (
  `Id_Sugerencia` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `NumOrdPedido` int(11) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Sugerencias_POS`
--
DELIMITER $$
CREATE TRIGGER `after_delete_sugerencias_pos` AFTER DELETE ON `Sugerencias_POS` FOR EACH ROW BEGIN
  INSERT INTO Sugerencias_POS_Eliminados (
    Id_Sugerencia, 
    Cod_Barra, 
    Nombre_Prod, 
    Fk_sucursal, 
    Precio_Venta, 
    Precio_C, 
    Cantidad, 
    Fecha_Ingreso, 
    FkPresentacion, 
    Proveedor1, 
    Proveedor2, 
    AgregadoPor, 
    AgregadoEl, 
    ID_H_O_D, 
    NumOrdPedido
  ) VALUES (
    OLD.Id_Sugerencia, 
    OLD.Cod_Barra, 
    OLD.Nombre_Prod, 
    OLD.Fk_sucursal, 
    OLD.Precio_Venta, 
    OLD.Precio_C, 
    OLD.Cantidad, 
    OLD.Fecha_Ingreso, 
    OLD.FkPresentacion, 
    OLD.Proveedor1, 
    OLD.Proveedor2, 
    OLD.AgregadoPor, 
    OLD.AgregadoEl, 
    OLD.ID_H_O_D, 
    OLD.NumOrdPedido
  );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sugerencias_POS_Eliminados`
--

CREATE TABLE `Sugerencias_POS_Eliminados` (
  `Id_eliminado` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Id_Sugerencia` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_C` decimal(50,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `FkPresentacion` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `NumOrdPedido` int(11) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tickets_Asigna`
--

CREATE TABLE `Tickets_Asigna` (
  `ID_Ticket_Asigna` int(11) NOT NULL,
  `Ticket` int(11) NOT NULL,
  `Fecha_Reporte` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Asigna` varchar(200) NOT NULL,
  `Fecha_Asigna` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Cierre` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tickets_Cierre`
--

CREATE TABLE `Tickets_Cierre` (
  `ID_Ticket_Cierre` int(11) NOT NULL,
  `Ticket` int(11) NOT NULL,
  `Fecha_Reporte` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Asigna` varchar(200) NOT NULL,
  `Fecha_Asigna` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Cierre` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Solucion` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tickets_Imagenes`
--

CREATE TABLE `Tickets_Imagenes` (
  `ID_Imagen` int(11) NOT NULL,
  `Ticket_Id` int(11) NOT NULL,
  `Imagen` varchar(255) NOT NULL,
  `Fecha_Subida` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tickets_Incidencias`
--

CREATE TABLE `Tickets_Incidencias` (
  `ID_incidencia` int(11) NOT NULL,
  `Ticket` int(11) NOT NULL,
  `Descripcion` varchar(400) NOT NULL,
  `Reporto` varchar(200) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Fecha_Reporte` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Asigna` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `Fecha_Asigna` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tickets_Reportes`
--

CREATE TABLE `Tickets_Reportes` (
  `Id_Ticket` int(11) NOT NULL,
  `No_Ticket` varchar(50) NOT NULL,
  `Sucursal` varchar(100) NOT NULL,
  `Reportado_Por` varchar(100) NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Problematica` varchar(255) NOT NULL,
  `DescripcionProblematica` text NOT NULL,
  `Solucion` text DEFAULT NULL,
  `Agregado_Por` varchar(100) NOT NULL,
  `Asignado` varchar(100) DEFAULT NULL,
  `Estatus` varchar(50) NOT NULL,
  `ID_H_O_D` int(11) DEFAULT NULL,
  `TipoTicket` varchar(50) DEFAULT 'Sistemas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_soporte`
--

CREATE TABLE `tickets_soporte` (
  `ID_Ticket` int(11) NOT NULL,
  `Fk_Sucursal` int(11) NOT NULL,
  `Fk_Departamento` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha_Creacion` datetime DEFAULT current_timestamp(),
  `Estado` enum('Abierto','En Proceso','Cerrado') DEFAULT 'Abierto',
  `Prioridad` enum('Baja','Media','Alta') DEFAULT 'Media',
  `AsignadoA` varchar(255) DEFAULT NULL,
  `Fecha_Cierre` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos_Consultas`
--

CREATE TABLE `Tipos_Consultas` (
  `Tipo_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Tipo` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL,
  `Especialidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos_Credit_POS`
--

CREATE TABLE `Tipos_Credit_POS` (
  `ID_Tip_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `CodigoCredito` decimal(50,0) NOT NULL,
  `Nombre_Tip` varchar(250) NOT NULL,
  `Costo` decimal(50,2) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Tipos_Credit_POS`
--
DELIMITER $$
CREATE TRIGGER `Audita_Tipo_Credi` AFTER INSERT ON `Tipos_Credit_POS` FOR EACH ROW INSERT INTO Tipos_Credit_POS_Updates
    (ID_Tip_Cred,Nombre_Tip,Costo,Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Tip_Cred,NEW.Nombre_Tip,NEW.Costo,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Updates_Tipo_Creditos` BEFORE UPDATE ON `Tipos_Credit_POS` FOR EACH ROW INSERT INTO Tipos_Credit_POS_Updates
    (ID_Tip_Cred,Nombre_Tip,Costo,Estatus,CodigoEstatus,Agrega,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.ID_Tip_Cred,NEW.Nombre_Tip,NEW.Costo,NEW.Estatus,NEW.CodigoEstatus,NEW.Agrega,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos_Credit_POS_Updates`
--

CREATE TABLE `Tipos_Credit_POS_Updates` (
  `ID_Update` int(11) NOT NULL,
  `ID_Tip_Cred` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Nombre_Tip` varchar(250) NOT NULL,
  `Costo` decimal(50,2) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `CodigoEstatus` varchar(200) NOT NULL,
  `Agrega` varchar(200) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Sistema` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos_estudios`
--

CREATE TABLE `Tipos_estudios` (
  `ID_tipo_analisis` int(11) NOT NULL,
  `Nombre_estudio` varchar(250) NOT NULL,
  `Fk_Tipo_analisis` int(11) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos_Mobiliarios_POS`
--

CREATE TABLE `Tipos_Mobiliarios_POS` (
  `Tip_Mob_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Tip_Mob` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Tipos_Mobiliarios_POS`
--
DELIMITER $$
CREATE TRIGGER `Tipo_Mobi_Audita` AFTER INSERT ON `Tipos_Mobiliarios_POS` FOR EACH ROW INSERT INTO Tipos_Mobiliarios_POS_Audita
    (Tip_Mob_ID,Nom_Tip_Mob,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Tip_Mob_ID,NEW.Nom_Tip_Mob,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Tipo_Mobi_Audita_Update` BEFORE UPDATE ON `Tipos_Mobiliarios_POS` FOR EACH ROW INSERT INTO Tipos_Mobiliarios_POS_Audita
    (Tip_Mob_ID,Nom_Tip_Mob,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Tip_Mob_ID,NEW.Nom_Tip_Mob,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos_Mobiliarios_POS_Audita`
--

CREATE TABLE `Tipos_Mobiliarios_POS_Audita` (
  `Tipo_Mob_Audita` int(11) NOT NULL,
  `Tip_Mob_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Tip_Mob` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo_analisis`
--

CREATE TABLE `Tipo_analisis` (
  `ID_Analisis` int(11) NOT NULL,
  `Nombre_analisis` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipProd_POS`
--

CREATE TABLE `TipProd_POS` (
  `Tip_Prod_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Tipo_Prod` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `TipProd_POS`
--
DELIMITER $$
CREATE TRIGGER `Audita_Tipo_Prod` AFTER INSERT ON `TipProd_POS` FOR EACH ROW INSERT INTO TipProd_POS_Audita
    (Tip_Prod_ID,Nom_Tipo_Prod,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Tip_Prod_ID,NEW.Nom_Tipo_Prod,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Audita_Tipo_Prod_Updates` BEFORE UPDATE ON `TipProd_POS` FOR EACH ROW INSERT INTO TipProd_POS_Audita
    (Tip_Prod_ID,Nom_Tipo_Prod,Estado,Cod_Estado,Agregado_Por,Agregadoel,Sistema,ID_H_O_D)
    VALUES (NEW.Tip_Prod_ID,NEW.Nom_Tipo_Prod,NEW.Estado,NEW.Cod_Estado,NEW.Agregado_Por,Now(),NEW.Sistema,NEW.ID_H_O_D)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipProd_POS_Audita`
--

CREATE TABLE `TipProd_POS_Audita` (
  `ID_Audita_TipoProd` int(11) NOT NULL,
  `Tip_Prod_ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Nom_Tipo_Prod` varchar(200) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cod_Estado` varchar(200) NOT NULL,
  `Agregado_Por` varchar(250) NOT NULL,
  `Agregadoel` timestamp NOT NULL DEFAULT current_timestamp(),
  `Sistema` varchar(250) NOT NULL,
  `ID_H_O_D` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Traspasos_Enfermeria`
--

CREATE TABLE `Traspasos_Enfermeria` (
  `ID_Traspaso_Generado` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Num_Orden` int(11) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_Compra` decimal(50,2) NOT NULL,
  `Total_traspaso` decimal(50,2) NOT NULL,
  `TotalVenta` double(50,2) NOT NULL,
  `Cantidad_Enviada` int(11) NOT NULL,
  `TraspasoGeneradoPor` varchar(300) NOT NULL,
  `ProveedorFijo` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `TotaldePiezas` int(11) NOT NULL,
  `Fecha_recepcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Traspasos_generados`
--

CREATE TABLE `Traspasos_generados` (
  `ID_Traspaso_Generado` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Num_Orden` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Num_Factura` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Fk_Sucursal_Destino` varchar(100) NOT NULL,
  `Fk_SucDestino` int(11) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_Compra` decimal(50,2) NOT NULL,
  `Total_traspaso` decimal(50,2) NOT NULL,
  `TotalVenta` double(50,2) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Cantidad_Enviada` int(11) NOT NULL,
  `Existencias_D_envio` int(11) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `TraspasoGeneradoPor` varchar(300) NOT NULL,
  `TraspasoRecibidoPor` varchar(250) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `ProveedorFijo` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `TotaldePiezas` int(11) NOT NULL,
  `Fecha_recepcion` varchar(1000) NOT NULL,
  `TipoMovimiento` varchar(200) NOT NULL,
  `Id_Devolucion` int(11) NOT NULL,
  `EstadoImPresion` varchar(300) NOT NULL,
  `UltimaImpresionPor` varchar(250) NOT NULL,
  `TipoMov` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Traspasos_generados`
--
DELIMITER $$
CREATE TRIGGER `Devoluciones_Cedis` BEFORE INSERT ON `Traspasos_generados` FOR EACH ROW Update Stock_POS
set Stock_POS.Existencias_R = Stock_POS.Existencias_R -NEW.Cantidad_Enviada
where  Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal AND NEW.ProveedorFijo ="Devolucion a cedis"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Insertar_Notificacion` AFTER INSERT ON `Traspasos_generados` FOR EACH ROW BEGIN 
    DECLARE primer_valor INT;
    DECLARE existe_factura INT;
    DECLARE mensaje_construido VARCHAR(255);

    
    SELECT COUNT(*) INTO existe_factura FROM Area_De_Notificaciones WHERE Num_Factura = NEW.Num_Factura;

    
    IF existe_factura = 0 THEN
        
        SELECT ID_Traspaso_Generado INTO primer_valor FROM Traspasos_generados WHERE ID_Traspaso_Generado = NEW.ID_Traspaso_Generado;

        
        SET mensaje_construido = CONCAT('Se ha generado un nuevo traspaso con ID : ', primer_valor, ',el numero de factura es: ', NEW.Num_Factura, ' del proveedor: ', NEW.ProveedorFijo);

        
        INSERT INTO Area_De_Notificaciones (Encabezado, Tipo_Notificacion, Mensaje_Notificacion, Registrado, Sistema, Sucursal, Estado, ID_H_O_D, Num_Factura) 
        VALUES ('Traspaso Generado', 'Nuevo traspaso', mensaje_construido, NOW(), 'Administrador', NEW.Fk_SucDestino, '1', 'Saluda', NEW.Num_Factura);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TraspasosGenerados_AfterInsert` AFTER INSERT ON `Traspasos_generados` FOR EACH ROW BEGIN
    
    IF NEW.TipoMovimiento IS NOT NULL AND NEW.Id_Devolucion IS NOT NULL THEN
        
        UPDATE Devolucion_POS
        SET Cantidad = Cantidad - NEW.Cantidad_Enviada,
            Movimiento = 'Registrado como Traspaso'
        WHERE ID_Registro = NEW.Id_Devolucion;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Traspasos_entre_Sucursales` BEFORE INSERT ON `Traspasos_generados` FOR EACH ROW Update Stock_POS
set Stock_POS.Existencias_R = Stock_POS.Existencias_R -NEW.Cantidad_Enviada
where  Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal AND NEW.ProveedorFijo ="Traspaso entre sucursales"
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_tipo_mov_stock` AFTER INSERT ON `Traspasos_generados` FOR EACH ROW BEGIN
    -- Verificamos si el valor de TipoMov no es "Traspaso de cedis"
    IF NEW.TipoMov != 'Traspaso de cedis' THEN
        -- Actualizamos el valor en la tabla Stock_POS con el mismo TipoMov del nuevo registro
        UPDATE Stock_POS
        SET TipoMov = NEW.TipoMov, AgregadoPor=NEW.TraspasoGeneradoPor
        WHERE Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS
          AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `auditoria_traspasos` BEFORE INSERT ON `Traspasos_generados` FOR EACH ROW INSERT INTO Traspasos_generados_audita
    (ID_Traspaso_Generado,Folio_Prod_Stock, ID_Prod_POS, Cod_Barra, Nombre_Prod,Fk_sucursal, Fk_Sucursal_Destino, Precio_Venta, Precio_Compra, Total_traspaso, TotalVenta, Existencias_R, Cantidad_Enviada, Existencias_D_envio, FechaEntrega, TraspasoGeneradoPor, TraspasoRecibidoPor, Tipo_Servicio, Proveedor1, Proveedor2,Estatus, AgregadoPor, AgregadoEl,ID_H_O_D)
    VALUES (NEW.ID_Traspaso_Generado,NEW.Folio_Prod_Stock, NEW.ID_Prod_POS, NEW.Cod_Barra, NEW.Nombre_Prod,NEW.Fk_sucursal, NEW.Fk_Sucursal_Destino, NEW.Precio_Venta, NEW.Precio_Compra, NEW.Total_traspaso, NEW.TotalVenta, NEW.Existencias_R, NEW.Cantidad_Enviada, NEW.Existencias_D_envio, NEW.FechaEntrega, NEW.TraspasoGeneradoPor, NEW.TraspasoRecibidoPor, NEW.Tipo_Servicio, NEW.Proveedor1, NEW.Proveedor2,NEW.Estatus, NEW.AgregadoPor, NOW(),NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `regresa_traspaso_cedis` AFTER DELETE ON `Traspasos_generados` FOR EACH ROW BEGIN
    -- Verificamos si el valor de ProveedorFijo es "CEDIS"
    IF OLD.ProveedorFijo = 'CEDIS' THEN
        -- Actualizamos el valor de Existencias_R en la tabla Stock_POS
        UPDATE Stock_POS
        SET Stock_POS.Existencias_R = Stock_POS.Existencias_R + OLD.Cantidad_Enviada
        WHERE Stock_POS.ID_Prod_POS = OLD.ID_Prod_POS
          AND Stock_POS.Fk_sucursal = OLD.Fk_sucursal;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `resta_traspaso` BEFORE INSERT ON `Traspasos_generados` FOR EACH ROW Update Stock_POS
set Stock_POS.Existencias_R = Stock_POS.Existencias_R -NEW.Cantidad_Enviada,Stock_POS.TipoMov=NEW.TipoMov,
Stock_POS.AgregadoPor=NEW.AgregadoPor
where  Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal AND NEW.ProveedorFijo ="CEDIS"
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Traspasos_generados_audita`
--

CREATE TABLE `Traspasos_generados_audita` (
  `id_audita_traspaso` int(11) NOT NULL,
  `ID_Traspaso_Generado` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Fk_Sucursal_Destino` int(11) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_Compra` decimal(50,2) NOT NULL,
  `Total_traspaso` decimal(50,2) NOT NULL,
  `TotalVenta` double(50,2) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Cantidad_Enviada` int(11) NOT NULL,
  `Existencias_D_envio` int(11) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `TraspasoGeneradoPor` varchar(300) NOT NULL,
  `TraspasoRecibidoPor` varchar(250) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Traspasos_generados_Eliminados`
--

CREATE TABLE `Traspasos_generados_Eliminados` (
  `ID_eliminado` int(11) NOT NULL,
  `ID_Traspaso_Generado` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Fk_Sucursal_Destino` varchar(100) NOT NULL,
  `Fk_SucDestino` int(11) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_Compra` decimal(50,2) NOT NULL,
  `Total_traspaso` decimal(50,2) NOT NULL,
  `TotalVenta` double(50,2) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Cantidad_Enviada` int(11) NOT NULL,
  `Existencias_D_envio` int(11) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `TraspasoGeneradoPor` varchar(300) NOT NULL,
  `TraspasoRecibidoPor` varchar(250) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `Estatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Traspasos_generados_Proveedores`
--

CREATE TABLE `Traspasos_generados_Proveedores` (
  `ID_Traspaso_Generado` int(11) NOT NULL,
  `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Num_Orden` int(11) NOT NULL,
  `Num_Factura` varchar(200) NOT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Fk_Sucursal_Destino` varchar(100) NOT NULL,
  `Fk_SucDestino` int(11) NOT NULL,
  `Precio_Venta` decimal(50,2) NOT NULL,
  `Precio_Compra` decimal(50,2) NOT NULL,
  `Total_traspaso` decimal(50,2) NOT NULL,
  `TotalVenta` double(50,2) NOT NULL,
  `Existencias_R` int(11) NOT NULL,
  `Cantidad_Enviada` int(11) NOT NULL,
  `Existencias_D_envio` int(11) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `TraspasoGeneradoPor` varchar(300) NOT NULL,
  `TraspasoRecibidoPor` varchar(250) NOT NULL,
  `Tipo_Servicio` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Proveedor1` varchar(250) DEFAULT NULL,
  `Proveedor2` varchar(250) DEFAULT NULL,
  `ProveedorFijo` varchar(200) NOT NULL,
  `Estatus` varchar(150) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `TotaldePiezas` int(11) NOT NULL,
  `Fecha_recepcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Turnos_Trabajo`
--

CREATE TABLE `Turnos_Trabajo` (
  `ID_TIPO_TURNO` varchar(200) NOT NULL,
  `ID_H_O_D` varchar(200) NOT NULL,
  `Registrado_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoriales_vistos`
--

CREATE TABLE `tutoriales_vistos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `sucursal` varchar(100) DEFAULT NULL,
  `tutorial` varchar(100) DEFAULT NULL,
  `fecha_visto` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UbicacionesRuta`
--

CREATE TABLE `UbicacionesRuta` (
  `Id_ruta` int(11) DEFAULT NULL,
  `Id_sucursal` int(11) DEFAULT NULL,
  `Id_personal` int(11) DEFAULT NULL,
  `Orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Update_Precios_Productos`
--

CREATE TABLE `Update_Precios_Productos` (
  `ID_UPDATE` int(11) NOT NULL,
  `ID_Prod_POS` int(11) UNSIGNED ZEROFILL NOT NULL,
  `Precio_Venta` int(11) NOT NULL,
  `Precio_C` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `nombre_completo` varchar(200) DEFAULT NULL,
  `puesto` varchar(200) NOT NULL,
  `sucursal` varchar(150) DEFAULT NULL,
  `fecha_crecion` timestamp NULL DEFAULT NULL,
  `pc_serial` varchar(100) DEFAULT NULL,
  `foto` longblob DEFAULT NULL,
  `ext` varchar(20) DEFAULT NULL,
  `agrego` varchar(150) NOT NULL,
  `sistema` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `UpdateEstadosEnfermeros` AFTER INSERT ON `usuarios` FOR EACH ROW Update Personal_Enfermeria
set Personal_Enfermeria.Biometrico= Personal_Enfermeria.Biometrico + 1 
where Personal_Enfermeria.Enfermero_ID = NEW.documento
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateEstadosMedicos` AFTER INSERT ON `usuarios` FOR EACH ROW Update Personal_Medico
set Personal_Medico.Biometrico= Personal_Medico.Biometrico + 1 
where Personal_Medico.Medico_ID = NEW.documento
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateEstadosPOS` AFTER INSERT ON `usuarios` FOR EACH ROW Update PersonalPOS
set PersonalPOS.Biometrico= PersonalPOS.Biometrico + 1 
where PersonalPOS.Pos_ID = NEW.documento
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdatePersonalCallCenter` AFTER INSERT ON `usuarios` FOR EACH ROW Update Personal_Agenda
set Personal_Agenda.Biometrico= Personal_Agenda.Biometrico + 1 
where Personal_Agenda.PersonalAgenda_ID = NEW.documento
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update_PersonalAdicional` AFTER INSERT ON `usuarios` FOR EACH ROW Update Personal_Intendecia
set Personal_Intendecia.Biometrico= Personal_Intendecia.Biometrico + 1 
where Personal_Intendecia.Intendencia_ID = NEW.documento
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas_POS`
--

CREATE TABLE `Ventas_POS` (
  `Venta_POS_ID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Identificador_tipo` varchar(300) NOT NULL,
  `Turno` varchar(250) NOT NULL,
  `FolioSucursal` varchar(100) NOT NULL,
  `Folio_Ticket` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Folio_Ticket_Old` varchar(200) NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Cantidad_Venta` int(11) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Total_Venta` decimal(50,2) NOT NULL,
  `Importe` decimal(50,2) NOT NULL,
  `Total_VentaG` decimal(50,2) NOT NULL,
  `DescuentoAplicado` int(11) DEFAULT NULL,
  `FormaDePago` varchar(200) NOT NULL,
  `CantidadPago` decimal(50,2) NOT NULL,
  `Cambio` decimal(50,2) NOT NULL,
  `Cliente` varchar(200) NOT NULL,
  `Fecha_venta` date NOT NULL,
  `Fk_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Motivo_Cancelacion` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `FolioSignoVital` varchar(200) NOT NULL,
  `TicketAnterior` varchar(100) NOT NULL,
  `Pagos_tarjeta` decimal(50,2) NOT NULL,
  `TipoDescuento` varchar(400) NOT NULL,
  `PuSindescuento` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Ventas_POS`
--
DELIMITER $$
CREATE TRIGGER `AuditaVentas_Insert` AFTER INSERT ON `Ventas_POS` FOR EACH ROW INSERT INTO  Ventas_POS_Audita
    (Venta_POS_ID,ID_Prod_POS,Identificador_tipo,Folio_Ticket, Clave_adicional, Cod_Barra,Nombre_Prod, Cantidad_Venta,Fk_sucursal, Total_Venta, Importe, Total_VentaG, CantidadPago, Cambio, Fecha_venta, Fk_Caja, Lote, Motivo_Cancelacion, Estatus, Sistema, AgregadoPor,AgregadoEl, ID_H_O_D)
    VALUES (NEW.Venta_POS_ID,NEW.ID_Prod_POS,NEW.Identificador_tipo,NEW.Folio_Ticket, NEW.Clave_adicional,NEW.Cod_Barra,NEW.Nombre_Prod,NEW.Cantidad_Venta,NEW.Fk_sucursal,NEW.Total_Venta,NEW.Importe,NEW.Total_VentaG,NEW.CantidadPago,NEW.Cambio, NEW.Fecha_venta, NEW.Fk_Caja, NEW.Lote, NEW.Motivo_Cancelacion, NEW.Estatus, NEW.Sistema, NEW.AgregadoPor,Now(), NEW.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Aumenta_Caja` AFTER INSERT ON `Ventas_POS` FOR EACH ROW Update Cajas_POS
set Cajas_POS.Valor_Total_Caja = Cajas_POS.Valor_Total_Caja + NEW.Importe
where Cajas_POS.ID_Caja = NEW.Fk_Caja
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ListaCancelaciones_Tickets` AFTER DELETE ON `Ventas_POS` FOR EACH ROW INSERT INTO Ventas_POS_Cancelaciones
(Venta_POS_ID,ID_Prod_POS,Identificador_tipo,Folio_Ticket,Clave_adicional,Cod_Barra,Nombre_Prod,Cantidad_Venta,Fk_sucursal,Total_Venta,Fk_Caja,Lote,Motivo_Cancelacion,Estatus,Sistema,AgregadoPor,AgregadoEl,ID_H_O_D) VALUES
(OLD.Venta_POS_ID,OLD.ID_Prod_POS,OLD.Identificador_tipo,OLD.Folio_Ticket,OLD.Clave_adicional,OLD.Cod_Barra,OLD.Nombre_Prod,OLD.Cantidad_Venta,OLD.Fk_sucursal,OLD.Total_Venta,OLD.Fk_Caja,OLD.Lote,OLD.Motivo_Cancelacion,OLD.Estatus,OLD.Sistema,OLD.AgregadoPor,NOW(),OLD.ID_H_O_D)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Resta_Stock` AFTER INSERT ON `Ventas_POS` FOR EACH ROW BEGIN
    IF NEW.Identificador_tipo IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 25, 26, 27, 31, 38, 39) THEN
        UPDATE Stock_POS
        SET Stock_POS.Existencias_R = Stock_POS.Existencias_R + NEW.Cantidad_Venta
        WHERE Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS
          AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal;
    ELSEIF NEW.Identificador_tipo IN (20, 21, 22, 23, 24, 29, 30, 32) THEN
        UPDATE Stock_POS
        SET Stock_POS.Existencias_R = Stock_POS.Existencias_R - NEW.Cantidad_Venta
        WHERE Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS
          AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Restaura_Stock` AFTER DELETE ON `Ventas_POS` FOR EACH ROW Update Stock_POS
set Stock_POS.Existencias_R = Stock_POS.Existencias_R + OLD.Cantidad_Venta
where Stock_POS.ID_Prod_POS = OLD.ID_Prod_POS AND Stock_POS.Fk_sucursal = OLD.Fk_sucursal
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `VentasEfectivo` BEFORE INSERT ON `Ventas_POS` FOR EACH ROW BEGIN
  IF NEW.FormaDePago IS NULL OR NEW.FormaDePago = '' THEN
    SET NEW.FormaDePago = 'Efectivo';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas_POS_Audita`
--

CREATE TABLE `Ventas_POS_Audita` (
  `ID_Audita` int(11) NOT NULL,
  `Venta_POS_ID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Identificador_tipo` varchar(300) NOT NULL,
  `Folio_Ticket` varchar(200) NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Cantidad_Venta` int(11) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Total_Venta` decimal(50,2) NOT NULL,
  `Importe` decimal(50,2) NOT NULL,
  `Total_VentaG` decimal(50,2) NOT NULL,
  `CantidadPago` decimal(50,2) NOT NULL,
  `Cambio` decimal(50,2) NOT NULL,
  `Fecha_venta` date NOT NULL,
  `Fk_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Motivo_Cancelacion` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas_POS_Cancelaciones`
--

CREATE TABLE `Ventas_POS_Cancelaciones` (
  `Cancelacion_IDVenPOS` int(11) NOT NULL,
  `Venta_POS_ID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Identificador_tipo` varchar(300) NOT NULL,
  `Folio_Ticket` varchar(200) NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Cantidad_Venta` int(11) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Total_Venta` decimal(50,2) NOT NULL,
  `Fk_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Motivo_Cancelacion` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Ventas_POS_Cancelaciones`
--
DELIMITER $$
CREATE TRIGGER `Disminuye_Caja_PorCancelacion` AFTER INSERT ON `Ventas_POS_Cancelaciones` FOR EACH ROW Update Cajas_POS
set Cajas_POS.Valor_Total_Caja = Cajas_POS.Valor_Total_Caja - NEW.Total_Venta
where Cajas_POS.ID_Caja = NEW.Fk_Caja
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ventas_POS_Pruebas`
--

CREATE TABLE `Ventas_POS_Pruebas` (
  `Venta_POS_ID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL,
  `Identificador_tipo` varchar(300) NOT NULL,
  `Turno` varchar(250) NOT NULL,
  `FolioSucursal` varchar(100) NOT NULL,
  `Folio_Ticket` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Folio_Ticket_Old` varchar(200) NOT NULL,
  `Clave_adicional` varchar(15) DEFAULT NULL,
  `Cod_Barra` varchar(100) NOT NULL,
  `Nombre_Prod` varchar(250) NOT NULL,
  `Cantidad_Venta` int(11) NOT NULL,
  `Fk_sucursal` int(12) NOT NULL,
  `Total_Venta` decimal(50,2) NOT NULL,
  `Importe` decimal(50,2) NOT NULL,
  `Total_VentaG` decimal(50,2) NOT NULL,
  `DescuentoAplicado` int(11) DEFAULT NULL,
  `FormaDePago` varchar(200) NOT NULL,
  `CantidadPago` decimal(50,2) NOT NULL,
  `Cambio` decimal(50,2) NOT NULL,
  `Cliente` varchar(200) NOT NULL,
  `Fecha_venta` date NOT NULL,
  `Fk_Caja` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Lote` varchar(100) NOT NULL,
  `Motivo_Cancelacion` varchar(250) NOT NULL,
  `Estatus` varchar(200) NOT NULL,
  `Sistema` varchar(200) NOT NULL,
  `AgregadoPor` varchar(250) NOT NULL,
  `AgregadoEl` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_H_O_D` varchar(100) NOT NULL,
  `FolioSignoVital` varchar(200) NOT NULL,
  `TicketAnterior` varchar(100) NOT NULL,
  `Pagos_tarjeta` decimal(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Disparadores `Ventas_POS_Pruebas`
--
DELIMITER $$
CREATE TRIGGER `ActualizarStock` AFTER INSERT ON `Ventas_POS_Pruebas` FOR EACH ROW BEGIN
    IF NEW.Identificador_tipo IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 25, 26, 27, 31, 38, 39) THEN
        UPDATE Stock_POS
        SET Stock_POS.Existencias_R = Stock_POS.Existencias_R + NEW.Cantidad_Venta
        WHERE Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS
          AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal;
    ELSEIF NEW.Identificador_tipo IN (20, 21, 22, 23, 24, 29, 30, 32) THEN
        UPDATE Stock_POS
        SET Stock_POS.Existencias_R = Stock_POS.Existencias_R - NEW.Cantidad_Venta
        WHERE Stock_POS.ID_Prod_POS = NEW.ID_Prod_POS
          AND Stock_POS.Fk_sucursal = NEW.Fk_sucursal;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VerificacionSincronizacion_Productos`
--

CREATE TABLE `VerificacionSincronizacion_Productos` (
  `ID_Sincronizacion` int(11) NOT NULL,
  `ID_Prod_POS` int(11) NOT NULL,
  `Fk_SucursalSincro` int(11) NOT NULL,
  `Fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VerificacionSincronizacion_Stock`
--

CREATE TABLE `VerificacionSincronizacion_Stock` (
  `ID_Sincronizacion` int(11) NOT NULL,
  `Folio_Prod_Stock` int(11) NOT NULL,
  `ID_Prod_POS` int(11) NOT NULL,
  `Fk_SucursalSincro` int(11) NOT NULL,
  `Fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Verificacion_Actualizacion_Stock`
--

CREATE TABLE `Verificacion_Actualizacion_Stock` (
  `ID_Sincronizacion` int(11) NOT NULL,
  `Folio_Prod_Stock` int(11) NOT NULL,
  `Fk_SucursalSincro` int(11) NOT NULL,
  `Fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `AbonoCreditos_Clinicas_POS`
--
ALTER TABLE `AbonoCreditos_Clinicas_POS`
  ADD PRIMARY KEY (`Folio_Abono`);

--
-- Indices de la tabla `AbonoCreditos_POS`
--
ALTER TABLE `AbonoCreditos_POS`
  ADD PRIMARY KEY (`Folio_Abono`);

--
-- Indices de la tabla `Administracion_Sistema`
--
ALTER TABLE `Administracion_Sistema`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Admin_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `Fk_Usuario` (`Fk_Usuario`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Advertencias_Inventario`
--
ALTER TABLE `Advertencias_Inventario`
  ADD PRIMARY KEY (`ID_Advertencia`);

--
-- Indices de la tabla `AgendaCitas_EspecialistasExt`
--
ALTER TABLE `AgendaCitas_EspecialistasExt`
  ADD PRIMARY KEY (`ID_Agenda_Especialista`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Agenda_Labs`
--
ALTER TABLE `Agenda_Labs`
  ADD PRIMARY KEY (`Id_genda`);

--
-- Indices de la tabla `Agenda_revaloraciones`
--
ALTER TABLE `Agenda_revaloraciones`
  ADD PRIMARY KEY (`Id_genda`);

--
-- Indices de la tabla `AjustesDeInventarios`
--
ALTER TABLE `AjustesDeInventarios`
  ADD PRIMARY KEY (`Folio_Ingreso`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Aperturas_Cajon`
--
ALTER TABLE `Aperturas_Cajon`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Areas_Credit_POS`
--
ALTER TABLE `Areas_Credit_POS`
  ADD PRIMARY KEY (`ID_Area_Cred`);

--
-- Indices de la tabla `Areas_Credit_POS_Audita`
--
ALTER TABLE `Areas_Credit_POS_Audita`
  ADD PRIMARY KEY (`ID_Audita_Ar_Cred`);

--
-- Indices de la tabla `Area_De_Notificaciones`
--
ALTER TABLE `Area_De_Notificaciones`
  ADD PRIMARY KEY (`ID_Notificacion`);

--
-- Indices de la tabla `Area_Enfermeria`
--
ALTER TABLE `Area_Enfermeria`
  ADD PRIMARY KEY (`Enfermero_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Enfermero_ID`),
  ADD UNIQUE KEY `Correo_Electronico` (`Correo_Electronico`),
  ADD KEY `ID_Sucursal` (`ID_Sucursal`,`ID_H_O_D`),
  ADD KEY `Area_Enfermeria_ibfk_2` (`ID_H_O_D`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `FK_rol` (`FK_rol`);

--
-- Indices de la tabla `Audita_Cambios_StockPruebas`
--
ALTER TABLE `Audita_Cambios_StockPruebas`
  ADD PRIMARY KEY (`Id_Audita`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Cajas_POS`
--
ALTER TABLE `Cajas_POS`
  ADD PRIMARY KEY (`ID_Caja`);

--
-- Indices de la tabla `Cajas_POS_Audita`
--
ALTER TABLE `Cajas_POS_Audita`
  ADD PRIMARY KEY (`ID_Caja_Audita`);

--
-- Indices de la tabla `Cancelaciones_Agenda`
--
ALTER TABLE `Cancelaciones_Agenda`
  ADD PRIMARY KEY (`ID_Agenda_Especialista`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Cancelaciones_AgendaSucursales`
--
ALTER TABLE `Cancelaciones_AgendaSucursales`
  ADD PRIMARY KEY (`ID_Cancelacion`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Cancelaciones_AgendaV2`
--
ALTER TABLE `Cancelaciones_AgendaV2`
  ADD PRIMARY KEY (`ID_Cancelacion`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Cancelaciones_Ext`
--
ALTER TABLE `Cancelaciones_Ext`
  ADD PRIMARY KEY (`ID_CancelacionExt`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `CARRITOS`
--
ALTER TABLE `CARRITOS`
  ADD PRIMARY KEY (`ID_CARRITO`),
  ADD KEY `FK_SUCURSAL` (`ID_SUCURSAL`);

--
-- Indices de la tabla `Categorias_Gastos_POS`
--
ALTER TABLE `Categorias_Gastos_POS`
  ADD PRIMARY KEY (`Cat_Gasto_ID`);

--
-- Indices de la tabla `Categorias_POS`
--
ALTER TABLE `Categorias_POS`
  ADD PRIMARY KEY (`Cat_ID`);

--
-- Indices de la tabla `Categorias_POS_Updates`
--
ALTER TABLE `Categorias_POS_Updates`
  ADD PRIMARY KEY (`ID_Update`);

--
-- Indices de la tabla `CierresDeInventarios`
--
ALTER TABLE `CierresDeInventarios`
  ADD PRIMARY KEY (`Id_Cierre`);

--
-- Indices de la tabla `CodigosSinResultadosEnStockInventario`
--
ALTER TABLE `CodigosSinResultadosEnStockInventario`
  ADD PRIMARY KEY (`Id_Cod`);

--
-- Indices de la tabla `ComponentesActivos`
--
ALTER TABLE `ComponentesActivos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Consultas`
--
ALTER TABLE `Consultas`
  ADD PRIMARY KEY (`Id_consulta`);

--
-- Indices de la tabla `ConteosDiarios`
--
ALTER TABLE `ConteosDiarios`
  ADD PRIMARY KEY (`Folio_Ingreso`),
  ADD KEY `ID_Prod_POS` (`Cod_Barra`);

--
-- Indices de la tabla `correos_corporativo`
--
ALTER TABLE `correos_corporativo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Cortes_Cajas_POS`
--
ALTER TABLE `Cortes_Cajas_POS`
  ADD PRIMARY KEY (`ID_Caja`);

--
-- Indices de la tabla `Costos_Especialistas`
--
ALTER TABLE `Costos_Especialistas`
  ADD PRIMARY KEY (`ID_Costo_Esp`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Horario_Disponibilidad` (`Costo_Especialista`),
  ADD KEY `FK_Especialista` (`FK_Especialista`);

--
-- Indices de la tabla `Costos_EspecialistasV2`
--
ALTER TABLE `Costos_EspecialistasV2`
  ADD PRIMARY KEY (`ID_Costo_Esp`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Horario_Disponibilidad` (`Costo_Especialista`),
  ADD KEY `FK_Especialista` (`FK_Especialista`);

--
-- Indices de la tabla `Cotizaciones_POS`
--
ALTER TABLE `Cotizaciones_POS`
  ADD PRIMARY KEY (`ID_Cotizacion`);

--
-- Indices de la tabla `Creditos_Clinicas_POS`
--
ALTER TABLE `Creditos_Clinicas_POS`
  ADD PRIMARY KEY (`Folio_Credito`);

--
-- Indices de la tabla `Creditos_POS`
--
ALTER TABLE `Creditos_POS`
  ADD PRIMARY KEY (`Folio_Credito`);

--
-- Indices de la tabla `Creditos_POS_Audita`
--
ALTER TABLE `Creditos_POS_Audita`
  ADD PRIMARY KEY (`Audita_Credi_POS`);

--
-- Indices de la tabla `Data_Facturacion_POS`
--
ALTER TABLE `Data_Facturacion_POS`
  ADD PRIMARY KEY (`ID_Factura`);

--
-- Indices de la tabla `Data_Pacientes`
--
ALTER TABLE `Data_Pacientes`
  ADD PRIMARY KEY (`ID_Data_Paciente`);

--
-- Indices de la tabla `Data_Pacientes_Respaldo`
--
ALTER TABLE `Data_Pacientes_Respaldo`
  ADD PRIMARY KEY (`ID_Data_Paciente`);

--
-- Indices de la tabla `Data_Pacientes_RespaldoV2`
--
ALTER TABLE `Data_Pacientes_RespaldoV2`
  ADD PRIMARY KEY (`ID_Data_Paciente`);

--
-- Indices de la tabla `Data_Pacientes_Updates`
--
ALTER TABLE `Data_Pacientes_Updates`
  ADD PRIMARY KEY (`ID_Update`);

--
-- Indices de la tabla `Datos_Generales_Personal`
--
ALTER TABLE `Datos_Generales_Personal`
  ADD PRIMARY KEY (`ID_Personal`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  ADD PRIMARY KEY (`ID_Departamento`);

--
-- Indices de la tabla `Devolucion_POS`
--
ALTER TABLE `Devolucion_POS`
  ADD PRIMARY KEY (`ID_Registro`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `device_id` (`device_id`);

--
-- Indices de la tabla `Encargados_Citas`
--
ALTER TABLE `Encargados_Citas`
  ADD PRIMARY KEY (`Encargado_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Encargado_ID`),
  ADD UNIQUE KEY `Correo_Electronico` (`Correo_Electronico`),
  ADD KEY `ID_Sucursal` (`ID_Sucursal`,`ID_H_O_D`),
  ADD KEY `Area_Enfermeria_ibfk_2` (`ID_H_O_D`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `Fk_Usuario` (`Fk_Usuario`);

--
-- Indices de la tabla `EncargosCancelados`
--
ALTER TABLE `EncargosCancelados`
  ADD PRIMARY KEY (`Id_Cancelacion`);

--
-- Indices de la tabla `EncargosSaldados`
--
ALTER TABLE `EncargosSaldados`
  ADD PRIMARY KEY (`Id_Saldado`);

--
-- Indices de la tabla `Encargos_POS`
--
ALTER TABLE `Encargos_POS`
  ADD PRIMARY KEY (`Id_Encargo`);

--
-- Indices de la tabla `Errores_Log`
--
ALTER TABLE `Errores_Log`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Errores_Stock`
--
ALTER TABLE `Errores_Stock`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Especialidades_Express`
--
ALTER TABLE `Especialidades_Express`
  ADD PRIMARY KEY (`ID_Especialidad`),
  ADD KEY `Nombre_Especialidad` (`Nombre_Especialidad`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Especialidades_Express_Audita`
--
ALTER TABLE `Especialidades_Express_Audita`
  ADD PRIMARY KEY (`ID_Auditoria`);

--
-- Indices de la tabla `Especialistas`
--
ALTER TABLE `Especialistas`
  ADD PRIMARY KEY (`ID_Especialista`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Especialidad` (`Especialidad`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `EspecialistasV2`
--
ALTER TABLE `EspecialistasV2`
  ADD PRIMARY KEY (`ID_Especialista`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Especialidad` (`Especialidad`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `Estados`
--
ALTER TABLE `Estados`
  ADD PRIMARY KEY (`ID_Estado`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Event_Log`
--
ALTER TABLE `Event_Log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Expediente_Medico`
--
ALTER TABLE `Expediente_Medico`
  ADD PRIMARY KEY (`Id_expediente`);

--
-- Indices de la tabla `Fechas_EspecialistasExt`
--
ALTER TABLE `Fechas_EspecialistasExt`
  ADD PRIMARY KEY (`ID_Fecha_Esp`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Horario_Disponibilidad` (`Fecha_Disponibilidad`),
  ADD KEY `FK_Especialista` (`FK_Especialista`);

--
-- Indices de la tabla `Fondos_Cajas`
--
ALTER TABLE `Fondos_Cajas`
  ADD PRIMARY KEY (`ID_Fon_Caja`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `Fondos_Cajas_Audita`
--
ALTER TABLE `Fondos_Cajas_Audita`
  ADD PRIMARY KEY (`ID_Audita_FonCaja`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `Fotografias`
--
ALTER TABLE `Fotografias`
  ADD PRIMARY KEY (`photoid`),
  ADD KEY `Fk_Nombre_paciente` (`Fk_Nombre_paciente`);

--
-- Indices de la tabla `Historial_Cambios_Lotes`
--
ALTER TABLE `Historial_Cambios_Lotes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Horarios_Citas_Ext`
--
ALTER TABLE `Horarios_Citas_Ext`
  ADD PRIMARY KEY (`ID_Horario`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Horario_Disponibilidad` (`Horario_Disponibilidad`),
  ADD KEY `FK_Especialista` (`FK_Especialista`);

--
-- Indices de la tabla `Hospital_Organizacion_Dueño`
--
ALTER TABLE `Hospital_Organizacion_Dueño`
  ADD PRIMARY KEY (`H_O_D`),
  ADD KEY `ID_ID` (`ID_ID`),
  ADD KEY `Logo_identidad` (`Logo_identidad`);

--
-- Indices de la tabla `huellas`
--
ALTER TABLE `huellas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `huellas_temp`
--
ALTER TABLE `huellas_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `impresiones`
--
ALTER TABLE `impresiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Incidencias_Express`
--
ALTER TABLE `Incidencias_Express`
  ADD PRIMARY KEY (`ID_incidencia`);

--
-- Indices de la tabla `IngresoAgendaEspecialistas`
--
ALTER TABLE `IngresoAgendaEspecialistas`
  ADD PRIMARY KEY (`PersonalAgendaEspecialista_ID`),
  ADD UNIQUE KEY `Correo_Electronico` (`Correo_Electronico`);

--
-- Indices de la tabla `IngresosRotaciones`
--
ALTER TABLE `IngresosRotaciones`
  ADD PRIMARY KEY (`IdIngreso`);

--
-- Indices de la tabla `Inserciones_Excel_inventarios`
--
ALTER TABLE `Inserciones_Excel_inventarios`
  ADD PRIMARY KEY (`Id_Insert`);

--
-- Indices de la tabla `Inserciones_Excel_inventarios_Respaldo1`
--
ALTER TABLE `Inserciones_Excel_inventarios_Respaldo1`
  ADD PRIMARY KEY (`Id_Insert`);

--
-- Indices de la tabla `Insumos`
--
ALTER TABLE `Insumos`
  ADD PRIMARY KEY (`ID_Insumo`);

--
-- Indices de la tabla `InventariosStocks_Conteos`
--
ALTER TABLE `InventariosStocks_Conteos`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Inventarios_Clinicas`
--
ALTER TABLE `Inventarios_Clinicas`
  ADD PRIMARY KEY (`ID_Inv_Clic`);

--
-- Indices de la tabla `Inventarios_Clinicas_audita`
--
ALTER TABLE `Inventarios_Clinicas_audita`
  ADD PRIMARY KEY (`ID_Inv_Clic_Audita`);

--
-- Indices de la tabla `Inventarios_Procesados`
--
ALTER TABLE `Inventarios_Procesados`
  ADD PRIMARY KEY (`ID_Registro`),
  ADD UNIQUE KEY `UnicoProducto` (`Cod_Barra`,`Fk_Sucursal`);

--
-- Indices de la tabla `inventario_inicial_estado`
--
ALTER TABLE `inventario_inicial_estado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fkSucursal` (`fkSucursal`,`fecha_establecido`);

--
-- Indices de la tabla `Inventario_Mobiliario`
--
ALTER TABLE `Inventario_Mobiliario`
  ADD PRIMARY KEY (`Id_inventario`);

--
-- Indices de la tabla `IPsAutorizadas`
--
ALTER TABLE `IPsAutorizadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Localidades`
--
ALTER TABLE `Localidades`
  ADD PRIMARY KEY (`ID_Localidad`),
  ADD KEY `Fk_Municipio` (`Fk_Municipio`);

--
-- Indices de la tabla `Logs_Sistema`
--
ALTER TABLE `Logs_Sistema`
  ADD PRIMARY KEY (`ID_Log`);

--
-- Indices de la tabla `Logs_Sistema_Agenda`
--
ALTER TABLE `Logs_Sistema_Agenda`
  ADD PRIMARY KEY (`ID_ingreso`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Lotes_Productos`
--
ALTER TABLE `Lotes_Productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_lote_sucursal` (`producto_id`,`lote`,`sucursal_id`);

--
-- Indices de la tabla `Marcas_POS`
--
ALTER TABLE `Marcas_POS`
  ADD PRIMARY KEY (`Marca_ID`);

--
-- Indices de la tabla `Marcas_POS_Updates`
--
ALTER TABLE `Marcas_POS_Updates`
  ADD PRIMARY KEY (`ID_Update_Mar`);

--
-- Indices de la tabla `MedicamentosCaducados`
--
ALTER TABLE `MedicamentosCaducados`
  ADD PRIMARY KEY (`Id_Baja`);

--
-- Indices de la tabla `Medicos_Credit_POS`
--
ALTER TABLE `Medicos_Credit_POS`
  ADD PRIMARY KEY (`ID_Med_Cred`);

--
-- Indices de la tabla `Medicos_Credit_POS_Audita`
--
ALTER TABLE `Medicos_Credit_POS_Audita`
  ADD PRIMARY KEY (`ID_Upd_Med_Cred`);

--
-- Indices de la tabla `Mobiliario_Asignado`
--
ALTER TABLE `Mobiliario_Asignado`
  ADD PRIMARY KEY (`ID_Mobiliario`);

--
-- Indices de la tabla `Mobiliario_Asignado_Audita`
--
ALTER TABLE `Mobiliario_Asignado_Audita`
  ADD PRIMARY KEY (`Audita_Mobiliario_ID`);

--
-- Indices de la tabla `MovimientosAgenda`
--
ALTER TABLE `MovimientosAgenda`
  ADD PRIMARY KEY (`ID_Agenda_Especialista`),
  ADD UNIQUE KEY `unique_movement` (`GoogleEventId`,`Fecha_Hora`);

--
-- Indices de la tabla `MovimientosCarritos`
--
ALTER TABLE `MovimientosCarritos`
  ADD PRIMARY KEY (`ID_Movimiento`);

--
-- Indices de la tabla `MovimientosEncargos`
--
ALTER TABLE `MovimientosEncargos`
  ADD PRIMARY KEY (`Id_Movimiento`);

--
-- Indices de la tabla `Municipios`
--
ALTER TABLE `Municipios`
  ADD PRIMARY KEY (`ID_Municipio`),
  ADD KEY `Fk_Estado` (`Fk_Estado`);

--
-- Indices de la tabla `Ordenes_Laboratorios`
--
ALTER TABLE `Ordenes_Laboratorios`
  ADD PRIMARY KEY (`Folio_Orden`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Otros_Gastos_POS`
--
ALTER TABLE `Otros_Gastos_POS`
  ADD PRIMARY KEY (`ID_Gastos`);

--
-- Indices de la tabla `Paquetes`
--
ALTER TABLE `Paquetes`
  ADD PRIMARY KEY (`Id_Paquete`);

--
-- Indices de la tabla `PedidosConfirmados`
--
ALTER TABLE `PedidosConfirmados`
  ADD PRIMARY KEY (`Id_Sugerencia`);

--
-- Indices de la tabla `PedidosRealizadosEnfermeria`
--
ALTER TABLE `PedidosRealizadosEnfermeria`
  ADD PRIMARY KEY (`ID_Pedido`);

--
-- Indices de la tabla `PersonalPOS`
--
ALTER TABLE `PersonalPOS`
  ADD PRIMARY KEY (`Pos_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `Fk_Usuario` (`Fk_Usuario`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `PersonalPOS_Audita`
--
ALTER TABLE `PersonalPOS_Audita`
  ADD PRIMARY KEY (`Audita_Pos_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `Fk_Usuario` (`Fk_Usuario`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `PersonalPOS_LOGS`
--
ALTER TABLE `PersonalPOS_LOGS`
  ADD PRIMARY KEY (`Pos_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `Fk_Usuario` (`Fk_Usuario`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `Personal_Agenda`
--
ALTER TABLE `Personal_Agenda`
  ADD PRIMARY KEY (`PersonalAgenda_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`PersonalAgenda_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Personal_Agenda_Audita`
--
ALTER TABLE `Personal_Agenda_Audita`
  ADD PRIMARY KEY (`Personal_AgendaAudita`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Personal_Agenda_Logs`
--
ALTER TABLE `Personal_Agenda_Logs`
  ADD PRIMARY KEY (`PersonalAgenda_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Personal_Enfermeria`
--
ALTER TABLE `Personal_Enfermeria`
  ADD PRIMARY KEY (`Enfermero_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Enfermero_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Personal_Enfermeria_Audita`
--
ALTER TABLE `Personal_Enfermeria_Audita`
  ADD PRIMARY KEY (`Auditoria_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Personal_Intendecia`
--
ALTER TABLE `Personal_Intendecia`
  ADD PRIMARY KEY (`Intendencia_ID`);

--
-- Indices de la tabla `Personal_Intendecia_Audita`
--
ALTER TABLE `Personal_Intendecia_Audita`
  ADD PRIMARY KEY (`ID_Auditable`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `Fk_Usuario` (`Fk_Usuario`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Fk_Sucursal` (`Fk_Sucursal`);

--
-- Indices de la tabla `Personal_Medico`
--
ALTER TABLE `Personal_Medico`
  ADD PRIMARY KEY (`Medico_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Medico_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Personal_Medico_Express`
--
ALTER TABLE `Personal_Medico_Express`
  ADD PRIMARY KEY (`Medico_ID`);

--
-- Indices de la tabla `Personal_Medico_Express_Sucursales`
--
ALTER TABLE `Personal_Medico_Express_Sucursales`
  ADD PRIMARY KEY (`Esp_X_Sucursal`);

--
-- Indices de la tabla `Personal_Medico_Respaldo`
--
ALTER TABLE `Personal_Medico_Respaldo`
  ADD PRIMARY KEY (`Medico_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Medico_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Personal_Medico_v2`
--
ALTER TABLE `Personal_Medico_v2`
  ADD PRIMARY KEY (`Medico_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Medico_ID`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`);

--
-- Indices de la tabla `Precios_Originales`
--
ALTER TABLE `Precios_Originales`
  ADD PRIMARY KEY (`Cod_Barra`);

--
-- Indices de la tabla `Presentacion_Prod_POS`
--
ALTER TABLE `Presentacion_Prod_POS`
  ADD PRIMARY KEY (`Pprod_ID`);

--
-- Indices de la tabla `Presentacion_Prod_POS_Updates`
--
ALTER TABLE `Presentacion_Prod_POS_Updates`
  ADD PRIMARY KEY (`ID_Update_Pre`);

--
-- Indices de la tabla `Procedimientos_Medicos`
--
ALTER TABLE `Procedimientos_Medicos`
  ADD PRIMARY KEY (`ID_Proce`);

--
-- Indices de la tabla `Procedimientos_Medicos_Audita`
--
ALTER TABLE `Procedimientos_Medicos_Audita`
  ADD PRIMARY KEY (`Procede_Audita`);

--
-- Indices de la tabla `Procedimientos_Medicos_Eliminados`
--
ALTER TABLE `Procedimientos_Medicos_Eliminados`
  ADD PRIMARY KEY (`Procede_Audita`);

--
-- Indices de la tabla `Procedimientos_POS`
--
ALTER TABLE `Procedimientos_POS`
  ADD PRIMARY KEY (`IDProcedimiento`);

--
-- Indices de la tabla `Procedimientos_Realizados`
--
ALTER TABLE `Procedimientos_Realizados`
  ADD PRIMARY KEY (`IDRealizado`),
  ADD KEY `IDProcedimiento` (`IDProcedimiento`);

--
-- Indices de la tabla `PRODUCTOS_EN_CARRITO`
--
ALTER TABLE `PRODUCTOS_EN_CARRITO`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `ID_CARRITO` (`ID_CARRITO`);

--
-- Indices de la tabla `Productos_En_Procedimientos`
--
ALTER TABLE `Productos_En_Procedimientos`
  ADD PRIMARY KEY (`IDProductoProc`),
  ADD KEY `Fk_Produc_Stock` (`Fk_Produc_Stock`),
  ADD KEY `Productos_En_Procedimientos_ibfk_1` (`Fk_Proced`);

--
-- Indices de la tabla `Productos_Equivalentes`
--
ALTER TABLE `Productos_Equivalentes`
  ADD PRIMARY KEY (`ID_Equivalencia`);

--
-- Indices de la tabla `Productos_POS`
--
ALTER TABLE `Productos_POS`
  ADD PRIMARY KEY (`ID_Prod_POS`);

--
-- Indices de la tabla `Productos_POSV2`
--
ALTER TABLE `Productos_POSV2`
  ADD PRIMARY KEY (`ID_Prod_POS`);

--
-- Indices de la tabla `Productos_POS_Eliminados`
--
ALTER TABLE `Productos_POS_Eliminados`
  ADD PRIMARY KEY (`ID_Eliminado`);

--
-- Indices de la tabla `Productos_POS_SincronizarNuevos`
--
ALTER TABLE `Productos_POS_SincronizarNuevos`
  ADD PRIMARY KEY (`ID_Sincronizacion`);

--
-- Indices de la tabla `Programacion_MedicosExt`
--
ALTER TABLE `Programacion_MedicosExt`
  ADD PRIMARY KEY (`ID_Programacion`);

--
-- Indices de la tabla `Programacion_MedicosExt_Completos`
--
ALTER TABLE `Programacion_MedicosExt_Completos`
  ADD PRIMARY KEY (`Audita_Programacion`);

--
-- Indices de la tabla `Programacion_Medicos_Sucursales`
--
ALTER TABLE `Programacion_Medicos_Sucursales`
  ADD PRIMARY KEY (`ID_Programacion`);

--
-- Indices de la tabla `Promos_Credit_POS`
--
ALTER TABLE `Promos_Credit_POS`
  ADD PRIMARY KEY (`ID_Promo_Cred`);

--
-- Indices de la tabla `Promos_Credit_POS_Audita`
--
ALTER TABLE `Promos_Credit_POS_Audita`
  ADD PRIMARY KEY (`ID_Update`);

--
-- Indices de la tabla `Proveedores_POS`
--
ALTER TABLE `Proveedores_POS`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `Proveedores_POS_Updates`
--
ALTER TABLE `Proveedores_POS_Updates`
  ADD PRIMARY KEY (`ID_Update_Prov`);

--
-- Indices de la tabla `Recetario_Medicos`
--
ALTER TABLE `Recetario_Medicos`
  ADD PRIMARY KEY (`ID_Receta`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Registros_Combustibles`
--
ALTER TABLE `Registros_Combustibles`
  ADD PRIMARY KEY (`Id_Registro`);

--
-- Indices de la tabla `Registros_Energia`
--
ALTER TABLE `Registros_Energia`
  ADD PRIMARY KEY (`Id_Registro`);

--
-- Indices de la tabla `Registros_Mantenimiento`
--
ALTER TABLE `Registros_Mantenimiento`
  ADD PRIMARY KEY (`Id_Registro`);

--
-- Indices de la tabla `registro_errores_Actualizacionanaqueles`
--
ALTER TABLE `registro_errores_Actualizacionanaqueles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Registro_Traspasos`
--
ALTER TABLE `Registro_Traspasos`
  ADD PRIMARY KEY (`ID_registro`);

--
-- Indices de la tabla `ReimpresionesTickets_CreditosClinicas`
--
ALTER TABLE `ReimpresionesTickets_CreditosClinicas`
  ADD PRIMARY KEY (`ID_Reimpresion`);

--
-- Indices de la tabla `ReimpresionesTickets_CreditosDentales`
--
ALTER TABLE `ReimpresionesTickets_CreditosDentales`
  ADD PRIMARY KEY (`ID_Reimpresion`);

--
-- Indices de la tabla `Reloj_Checador`
--
ALTER TABLE `Reloj_Checador`
  ADD PRIMARY KEY (`ID_Chequeo`);

--
-- Indices de la tabla `Reloj_ChecadorV2`
--
ALTER TABLE `Reloj_ChecadorV2`
  ADD PRIMARY KEY (`ID_Chequeo`);

--
-- Indices de la tabla `Reloj_ChecadorV2Entrada`
--
ALTER TABLE `Reloj_ChecadorV2Entrada`
  ADD PRIMARY KEY (`ID_Chequeo`);

--
-- Indices de la tabla `Reloj_ChecadorV2_EntradasComida`
--
ALTER TABLE `Reloj_ChecadorV2_EntradasComida`
  ADD PRIMARY KEY (`ID_Chequeo`);

--
-- Indices de la tabla `Reloj_ChecadorV2_Salidas`
--
ALTER TABLE `Reloj_ChecadorV2_Salidas`
  ADD PRIMARY KEY (`ID_Chequeo`);

--
-- Indices de la tabla `Reloj_ChecadorV2_SalidasComida`
--
ALTER TABLE `Reloj_ChecadorV2_SalidasComida`
  ADD PRIMARY KEY (`ID_Chequeo`);

--
-- Indices de la tabla `Resultados_Ultrasonidos`
--
ALTER TABLE `Resultados_Ultrasonidos`
  ADD PRIMARY KEY (`ID_resultado`),
  ADD KEY `Nombre_paciente` (`Nombre_paciente`);

--
-- Indices de la tabla `Roles_Puestos`
--
ALTER TABLE `Roles_Puestos`
  ADD PRIMARY KEY (`ID_rol`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Nombre_rol` (`Nombre_rol`);

--
-- Indices de la tabla `Rutas`
--
ALTER TABLE `Rutas`
  ADD PRIMARY KEY (`Id_ruta`),
  ADD KEY `Id_personal` (`Id_personal`);

--
-- Indices de la tabla `Servicios_Especializados`
--
ALTER TABLE `Servicios_Especializados`
  ADD PRIMARY KEY (`Especialista_ID`),
  ADD UNIQUE KEY `Enfermero_ID` (`Especialista_ID`),
  ADD UNIQUE KEY `Correo_Electronico` (`Correo_Electronico`),
  ADD KEY `ID_Sucursal` (`ID_Sucursal`,`ID_H_O_D`),
  ADD KEY `Area_Enfermeria_ibfk_2` (`ID_H_O_D`),
  ADD KEY `Nombre_Apellidos` (`Nombre_Apellidos`),
  ADD KEY `Fk_Logo_identidad` (`Fk_Logo_identidad`);

--
-- Indices de la tabla `Servicios_POS`
--
ALTER TABLE `Servicios_POS`
  ADD PRIMARY KEY (`Servicio_ID`);

--
-- Indices de la tabla `Servicios_POS_Audita`
--
ALTER TABLE `Servicios_POS_Audita`
  ADD PRIMARY KEY (`Audita_Serv_ID`);

--
-- Indices de la tabla `Signos_Vitales`
--
ALTER TABLE `Signos_Vitales`
  ADD PRIMARY KEY (`ID_SignoV`),
  ADD UNIQUE KEY `ID_DIAGNOSTICO` (`ID_SignoV`),
  ADD KEY `Nombres_Enfermero` (`Nombres_Enfermero`),
  ADD KEY `Nombre_Doctor` (`Nombre_Doctor`,`Fk_Sucursal`,`FK_ID_H_O_D`,`ID_TURNO`),
  ADD KEY `Diagnosticio_inicial_enfermeros_ibfk_2` (`FK_ID_H_O_D`),
  ADD KEY `Diagnosticio_inicial_enfermeros_ibfk_3` (`Fk_Sucursal`),
  ADD KEY `Diagnosticio_inicial_enfermeros_ibfk_4` (`ID_TURNO`);

--
-- Indices de la tabla `Signos_VitalesV2`
--
ALTER TABLE `Signos_VitalesV2`
  ADD PRIMARY KEY (`ID_SignoV`),
  ADD UNIQUE KEY `ID_DIAGNOSTICO` (`ID_SignoV`),
  ADD KEY `Nombre_Doctor` (`Nombre_Doctor`,`Fk_Sucursal`,`FK_ID_H_O_D`,`ID_TURNO`),
  ADD KEY `Diagnosticio_inicial_enfermeros_ibfk_2` (`FK_ID_H_O_D`),
  ADD KEY `Diagnosticio_inicial_enfermeros_ibfk_3` (`Fk_Sucursal`),
  ADD KEY `Diagnosticio_inicial_enfermeros_ibfk_4` (`ID_TURNO`);

--
-- Indices de la tabla `Sincronizacion_Cajas`
--
ALTER TABLE `Sincronizacion_Cajas`
  ADD PRIMARY KEY (`Id_Sincroniza`);

--
-- Indices de la tabla `Solicitudes_Ingresos`
--
ALTER TABLE `Solicitudes_Ingresos`
  ADD PRIMARY KEY (`IdProdCedis`);

--
-- Indices de la tabla `Solicitudes_Traspasos`
--
ALTER TABLE `Solicitudes_Traspasos`
  ADD PRIMARY KEY (`ID_Sol_Traspaso`);

--
-- Indices de la tabla `Stock_Bajas`
--
ALTER TABLE `Stock_Bajas`
  ADD PRIMARY KEY (`Id_Baja`);

--
-- Indices de la tabla `Stock_Dental`
--
ALTER TABLE `Stock_Dental`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_Enfermeria`
--
ALTER TABLE `Stock_Enfermeria`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_Med`
--
ALTER TABLE `Stock_Med`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_POS`
--
ALTER TABLE `Stock_POS`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_POS_Audita`
--
ALTER TABLE `Stock_POS_Audita`
  ADD PRIMARY KEY (`ID_Audita_Stock`);

--
-- Indices de la tabla `Stock_POS_PruebasInv`
--
ALTER TABLE `Stock_POS_PruebasInv`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_POS_RespaldoPrevioAMontejo`
--
ALTER TABLE `Stock_POS_RespaldoPrevioAMontejo`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_POS_RespaldoPrevioCaucel`
--
ALTER TABLE `Stock_POS_RespaldoPrevioCaucel`
  ADD PRIMARY KEY (`Folio_Prod_Stock`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_POS_TablaAuditorias`
--
ALTER TABLE `Stock_POS_TablaAuditorias`
  ADD PRIMARY KEY (`IdAuditoria`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Stock_registrosNuevos`
--
ALTER TABLE `Stock_registrosNuevos`
  ADD PRIMARY KEY (`Folio_Ingreso`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Sucursales`
--
ALTER TABLE `Sucursales`
  ADD PRIMARY KEY (`Nombre_ID_Sucursal`),
  ADD UNIQUE KEY `Nombre_ID_Sucursal` (`Nombre_ID_Sucursal`),
  ADD KEY `Dueño_Propiedad` (`Dueño_Propiedad`);

--
-- Indices de la tabla `SucursalesCorre`
--
ALTER TABLE `SucursalesCorre`
  ADD PRIMARY KEY (`ID_SucursalC`),
  ADD UNIQUE KEY `Nombre_Sucursal` (`Nombre_Sucursal`,`ID_H_O_D`);

--
-- Indices de la tabla `Sucursales_Audita`
--
ALTER TABLE `Sucursales_Audita`
  ADD PRIMARY KEY (`Audita_Suc`),
  ADD UNIQUE KEY `Nombre_Sucursal` (`Nombre_Sucursal`,`ID_H_O_D`);

--
-- Indices de la tabla `Sucursales_Campañas`
--
ALTER TABLE `Sucursales_Campañas`
  ADD PRIMARY KEY (`ID_SucursalC`),
  ADD UNIQUE KEY `Nombre_Sucursal` (`Nombre_Sucursal`,`ID_H_O_D`);

--
-- Indices de la tabla `Sucursales_CampañasV2`
--
ALTER TABLE `Sucursales_CampañasV2`
  ADD PRIMARY KEY (`ID_SucursalC`),
  ADD UNIQUE KEY `Nombre_Sucursal` (`Nombre_Sucursal`,`ID_H_O_D`);

--
-- Indices de la tabla `Sucursales_especialistas`
--
ALTER TABLE `Sucursales_especialistas`
  ADD PRIMARY KEY (`ID_Sucursal`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`),
  ADD KEY `Horario_Disponibilidad` (`Nombre_Sucursal`),
  ADD KEY `FK_Especialista` (`FK_Especialista`);

--
-- Indices de la tabla `Sugerencias_POS`
--
ALTER TABLE `Sugerencias_POS`
  ADD PRIMARY KEY (`Id_Sugerencia`);

--
-- Indices de la tabla `Sugerencias_POS_Eliminados`
--
ALTER TABLE `Sugerencias_POS_Eliminados`
  ADD PRIMARY KEY (`Id_eliminado`);

--
-- Indices de la tabla `Tickets_Asigna`
--
ALTER TABLE `Tickets_Asigna`
  ADD PRIMARY KEY (`ID_Ticket_Asigna`);

--
-- Indices de la tabla `Tickets_Cierre`
--
ALTER TABLE `Tickets_Cierre`
  ADD PRIMARY KEY (`ID_Ticket_Cierre`);

--
-- Indices de la tabla `Tickets_Imagenes`
--
ALTER TABLE `Tickets_Imagenes`
  ADD PRIMARY KEY (`ID_Imagen`),
  ADD KEY `Ticket_Id` (`Ticket_Id`);

--
-- Indices de la tabla `Tickets_Incidencias`
--
ALTER TABLE `Tickets_Incidencias`
  ADD PRIMARY KEY (`ID_incidencia`);

--
-- Indices de la tabla `Tickets_Reportes`
--
ALTER TABLE `Tickets_Reportes`
  ADD PRIMARY KEY (`Id_Ticket`);

--
-- Indices de la tabla `tickets_soporte`
--
ALTER TABLE `tickets_soporte`
  ADD PRIMARY KEY (`ID_Ticket`);

--
-- Indices de la tabla `Tipos_Consultas`
--
ALTER TABLE `Tipos_Consultas`
  ADD PRIMARY KEY (`Tipo_ID`);

--
-- Indices de la tabla `Tipos_Credit_POS`
--
ALTER TABLE `Tipos_Credit_POS`
  ADD PRIMARY KEY (`ID_Tip_Cred`);

--
-- Indices de la tabla `Tipos_Credit_POS_Updates`
--
ALTER TABLE `Tipos_Credit_POS_Updates`
  ADD PRIMARY KEY (`ID_Update`);

--
-- Indices de la tabla `Tipos_estudios`
--
ALTER TABLE `Tipos_estudios`
  ADD PRIMARY KEY (`ID_tipo_analisis`),
  ADD KEY `Fk_Tipo_analisis` (`Fk_Tipo_analisis`,`ID_H_O_D`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `Tipos_Mobiliarios_POS`
--
ALTER TABLE `Tipos_Mobiliarios_POS`
  ADD PRIMARY KEY (`Tip_Mob_ID`);

--
-- Indices de la tabla `Tipos_Mobiliarios_POS_Audita`
--
ALTER TABLE `Tipos_Mobiliarios_POS_Audita`
  ADD PRIMARY KEY (`Tipo_Mob_Audita`);

--
-- Indices de la tabla `Tipo_analisis`
--
ALTER TABLE `Tipo_analisis`
  ADD PRIMARY KEY (`ID_Analisis`),
  ADD UNIQUE KEY `Nombre_analisis` (`Nombre_analisis`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `TipProd_POS`
--
ALTER TABLE `TipProd_POS`
  ADD PRIMARY KEY (`Tip_Prod_ID`);

--
-- Indices de la tabla `TipProd_POS_Audita`
--
ALTER TABLE `TipProd_POS_Audita`
  ADD PRIMARY KEY (`ID_Audita_TipoProd`);

--
-- Indices de la tabla `Traspasos_Enfermeria`
--
ALTER TABLE `Traspasos_Enfermeria`
  ADD PRIMARY KEY (`ID_Traspaso_Generado`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Traspasos_generados`
--
ALTER TABLE `Traspasos_generados`
  ADD PRIMARY KEY (`ID_Traspaso_Generado`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Traspasos_generados_audita`
--
ALTER TABLE `Traspasos_generados_audita`
  ADD PRIMARY KEY (`id_audita_traspaso`);

--
-- Indices de la tabla `Traspasos_generados_Eliminados`
--
ALTER TABLE `Traspasos_generados_Eliminados`
  ADD PRIMARY KEY (`ID_eliminado`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Traspasos_generados_Proveedores`
--
ALTER TABLE `Traspasos_generados_Proveedores`
  ADD PRIMARY KEY (`ID_Traspaso_Generado`),
  ADD KEY `ID_Prod_POS` (`ID_Prod_POS`);

--
-- Indices de la tabla `Turnos_Trabajo`
--
ALTER TABLE `Turnos_Trabajo`
  ADD PRIMARY KEY (`ID_TIPO_TURNO`),
  ADD KEY `ID_H_O_D` (`ID_H_O_D`);

--
-- Indices de la tabla `tutoriales_vistos`
--
ALTER TABLE `tutoriales_vistos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `UbicacionesRuta`
--
ALTER TABLE `UbicacionesRuta`
  ADD KEY `Id_ruta` (`Id_ruta`),
  ADD KEY `Id_sucursal` (`Id_sucursal`),
  ADD KEY `Id_personal` (`Id_personal`);

--
-- Indices de la tabla `Update_Precios_Productos`
--
ALTER TABLE `Update_Precios_Productos`
  ADD PRIMARY KEY (`ID_UPDATE`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Ventas_POS`
--
ALTER TABLE `Ventas_POS`
  ADD PRIMARY KEY (`Venta_POS_ID`);

--
-- Indices de la tabla `Ventas_POS_Audita`
--
ALTER TABLE `Ventas_POS_Audita`
  ADD PRIMARY KEY (`ID_Audita`);

--
-- Indices de la tabla `Ventas_POS_Cancelaciones`
--
ALTER TABLE `Ventas_POS_Cancelaciones`
  ADD PRIMARY KEY (`Cancelacion_IDVenPOS`);

--
-- Indices de la tabla `Ventas_POS_Pruebas`
--
ALTER TABLE `Ventas_POS_Pruebas`
  ADD PRIMARY KEY (`Venta_POS_ID`);

--
-- Indices de la tabla `VerificacionSincronizacion_Productos`
--
ALTER TABLE `VerificacionSincronizacion_Productos`
  ADD PRIMARY KEY (`ID_Sincronizacion`);

--
-- Indices de la tabla `VerificacionSincronizacion_Stock`
--
ALTER TABLE `VerificacionSincronizacion_Stock`
  ADD PRIMARY KEY (`ID_Sincronizacion`);

--
-- Indices de la tabla `Verificacion_Actualizacion_Stock`
--
ALTER TABLE `Verificacion_Actualizacion_Stock`
  ADD PRIMARY KEY (`ID_Sincronizacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `AbonoCreditos_Clinicas_POS`
--
ALTER TABLE `AbonoCreditos_Clinicas_POS`
  MODIFY `Folio_Abono` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `AbonoCreditos_POS`
--
ALTER TABLE `AbonoCreditos_POS`
  MODIFY `Folio_Abono` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Administracion_Sistema`
--
ALTER TABLE `Administracion_Sistema`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Advertencias_Inventario`
--
ALTER TABLE `Advertencias_Inventario`
  MODIFY `ID_Advertencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `AgendaCitas_EspecialistasExt`
--
ALTER TABLE `AgendaCitas_EspecialistasExt`
  MODIFY `ID_Agenda_Especialista` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Agenda_Labs`
--
ALTER TABLE `Agenda_Labs`
  MODIFY `Id_genda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Agenda_revaloraciones`
--
ALTER TABLE `Agenda_revaloraciones`
  MODIFY `Id_genda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `AjustesDeInventarios`
--
ALTER TABLE `AjustesDeInventarios`
  MODIFY `Folio_Ingreso` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Aperturas_Cajon`
--
ALTER TABLE `Aperturas_Cajon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Areas_Credit_POS`
--
ALTER TABLE `Areas_Credit_POS`
  MODIFY `ID_Area_Cred` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Areas_Credit_POS_Audita`
--
ALTER TABLE `Areas_Credit_POS_Audita`
  MODIFY `ID_Audita_Ar_Cred` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Area_De_Notificaciones`
--
ALTER TABLE `Area_De_Notificaciones`
  MODIFY `ID_Notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Area_Enfermeria`
--
ALTER TABLE `Area_Enfermeria`
  MODIFY `Enfermero_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Audita_Cambios_StockPruebas`
--
ALTER TABLE `Audita_Cambios_StockPruebas`
  MODIFY `Id_Audita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cajas_POS`
--
ALTER TABLE `Cajas_POS`
  MODIFY `ID_Caja` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cajas_POS_Audita`
--
ALTER TABLE `Cajas_POS_Audita`
  MODIFY `ID_Caja_Audita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cancelaciones_Agenda`
--
ALTER TABLE `Cancelaciones_Agenda`
  MODIFY `ID_Agenda_Especialista` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cancelaciones_AgendaSucursales`
--
ALTER TABLE `Cancelaciones_AgendaSucursales`
  MODIFY `ID_Cancelacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cancelaciones_AgendaV2`
--
ALTER TABLE `Cancelaciones_AgendaV2`
  MODIFY `ID_Cancelacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cancelaciones_Ext`
--
ALTER TABLE `Cancelaciones_Ext`
  MODIFY `ID_CancelacionExt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CARRITOS`
--
ALTER TABLE `CARRITOS`
  MODIFY `ID_CARRITO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Categorias_Gastos_POS`
--
ALTER TABLE `Categorias_Gastos_POS`
  MODIFY `Cat_Gasto_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Categorias_POS`
--
ALTER TABLE `Categorias_POS`
  MODIFY `Cat_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Categorias_POS_Updates`
--
ALTER TABLE `Categorias_POS_Updates`
  MODIFY `ID_Update` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CierresDeInventarios`
--
ALTER TABLE `CierresDeInventarios`
  MODIFY `Id_Cierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CodigosSinResultadosEnStockInventario`
--
ALTER TABLE `CodigosSinResultadosEnStockInventario`
  MODIFY `Id_Cod` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ComponentesActivos`
--
ALTER TABLE `ComponentesActivos`
  MODIFY `ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Consultas`
--
ALTER TABLE `Consultas`
  MODIFY `Id_consulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ConteosDiarios`
--
ALTER TABLE `ConteosDiarios`
  MODIFY `Folio_Ingreso` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correos_corporativo`
--
ALTER TABLE `correos_corporativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cortes_Cajas_POS`
--
ALTER TABLE `Cortes_Cajas_POS`
  MODIFY `ID_Caja` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Costos_Especialistas`
--
ALTER TABLE `Costos_Especialistas`
  MODIFY `ID_Costo_Esp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Costos_EspecialistasV2`
--
ALTER TABLE `Costos_EspecialistasV2`
  MODIFY `ID_Costo_Esp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Cotizaciones_POS`
--
ALTER TABLE `Cotizaciones_POS`
  MODIFY `ID_Cotizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Creditos_Clinicas_POS`
--
ALTER TABLE `Creditos_Clinicas_POS`
  MODIFY `Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Creditos_POS`
--
ALTER TABLE `Creditos_POS`
  MODIFY `Folio_Credito` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Creditos_POS_Audita`
--
ALTER TABLE `Creditos_POS_Audita`
  MODIFY `Audita_Credi_POS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Data_Facturacion_POS`
--
ALTER TABLE `Data_Facturacion_POS`
  MODIFY `ID_Factura` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Data_Pacientes`
--
ALTER TABLE `Data_Pacientes`
  MODIFY `ID_Data_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Data_Pacientes_Respaldo`
--
ALTER TABLE `Data_Pacientes_Respaldo`
  MODIFY `ID_Data_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Data_Pacientes_RespaldoV2`
--
ALTER TABLE `Data_Pacientes_RespaldoV2`
  MODIFY `ID_Data_Paciente` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Data_Pacientes_Updates`
--
ALTER TABLE `Data_Pacientes_Updates`
  MODIFY `ID_Update` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Datos_Generales_Personal`
--
ALTER TABLE `Datos_Generales_Personal`
  MODIFY `ID_Personal` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Folio del personal';

--
-- AUTO_INCREMENT de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  MODIFY `ID_Departamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Devolucion_POS`
--
ALTER TABLE `Devolucion_POS`
  MODIFY `ID_Registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Encargados_Citas`
--
ALTER TABLE `Encargados_Citas`
  MODIFY `Encargado_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `EncargosCancelados`
--
ALTER TABLE `EncargosCancelados`
  MODIFY `Id_Cancelacion` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `EncargosSaldados`
--
ALTER TABLE `EncargosSaldados`
  MODIFY `Id_Saldado` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Encargos_POS`
--
ALTER TABLE `Encargos_POS`
  MODIFY `Id_Encargo` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Errores_Log`
--
ALTER TABLE `Errores_Log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Errores_Stock`
--
ALTER TABLE `Errores_Stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Especialidades_Express`
--
ALTER TABLE `Especialidades_Express`
  MODIFY `ID_Especialidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Especialidades_Express_Audita`
--
ALTER TABLE `Especialidades_Express_Audita`
  MODIFY `ID_Auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Especialistas`
--
ALTER TABLE `Especialistas`
  MODIFY `ID_Especialista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `EspecialistasV2`
--
ALTER TABLE `EspecialistasV2`
  MODIFY `ID_Especialista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Estados`
--
ALTER TABLE `Estados`
  MODIFY `ID_Estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Event_Log`
--
ALTER TABLE `Event_Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Fechas_EspecialistasExt`
--
ALTER TABLE `Fechas_EspecialistasExt`
  MODIFY `ID_Fecha_Esp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Fondos_Cajas`
--
ALTER TABLE `Fondos_Cajas`
  MODIFY `ID_Fon_Caja` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Fondos_Cajas_Audita`
--
ALTER TABLE `Fondos_Cajas_Audita`
  MODIFY `ID_Audita_FonCaja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Fotografias`
--
ALTER TABLE `Fotografias`
  MODIFY `photoid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Historial_Cambios_Lotes`
--
ALTER TABLE `Historial_Cambios_Lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Horarios_Citas_Ext`
--
ALTER TABLE `Horarios_Citas_Ext`
  MODIFY `ID_Horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Hospital_Organizacion_Dueño`
--
ALTER TABLE `Hospital_Organizacion_Dueño`
  MODIFY `ID_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `huellas`
--
ALTER TABLE `huellas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `huellas_temp`
--
ALTER TABLE `huellas_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `impresiones`
--
ALTER TABLE `impresiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Incidencias_Express`
--
ALTER TABLE `Incidencias_Express`
  MODIFY `ID_incidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `IngresoAgendaEspecialistas`
--
ALTER TABLE `IngresoAgendaEspecialistas`
  MODIFY `PersonalAgendaEspecialista_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `IngresosRotaciones`
--
ALTER TABLE `IngresosRotaciones`
  MODIFY `IdIngreso` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Inserciones_Excel_inventarios`
--
ALTER TABLE `Inserciones_Excel_inventarios`
  MODIFY `Id_Insert` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Inserciones_Excel_inventarios_Respaldo1`
--
ALTER TABLE `Inserciones_Excel_inventarios_Respaldo1`
  MODIFY `Id_Insert` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Insumos`
--
ALTER TABLE `Insumos`
  MODIFY `ID_Insumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `InventariosStocks_Conteos`
--
ALTER TABLE `InventariosStocks_Conteos`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Inventarios_Clinicas`
--
ALTER TABLE `Inventarios_Clinicas`
  MODIFY `ID_Inv_Clic` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Inventarios_Clinicas_audita`
--
ALTER TABLE `Inventarios_Clinicas_audita`
  MODIFY `ID_Inv_Clic_Audita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Inventarios_Procesados`
--
ALTER TABLE `Inventarios_Procesados`
  MODIFY `ID_Registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_inicial_estado`
--
ALTER TABLE `inventario_inicial_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Inventario_Mobiliario`
--
ALTER TABLE `Inventario_Mobiliario`
  MODIFY `Id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `IPsAutorizadas`
--
ALTER TABLE `IPsAutorizadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Localidades`
--
ALTER TABLE `Localidades`
  MODIFY `ID_Localidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Logs_Sistema`
--
ALTER TABLE `Logs_Sistema`
  MODIFY `ID_Log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Logs_Sistema_Agenda`
--
ALTER TABLE `Logs_Sistema_Agenda`
  MODIFY `ID_ingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Lotes_Productos`
--
ALTER TABLE `Lotes_Productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Marcas_POS`
--
ALTER TABLE `Marcas_POS`
  MODIFY `Marca_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Marcas_POS_Updates`
--
ALTER TABLE `Marcas_POS_Updates`
  MODIFY `ID_Update_Mar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `MedicamentosCaducados`
--
ALTER TABLE `MedicamentosCaducados`
  MODIFY `Id_Baja` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Medicos_Credit_POS`
--
ALTER TABLE `Medicos_Credit_POS`
  MODIFY `ID_Med_Cred` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Medicos_Credit_POS_Audita`
--
ALTER TABLE `Medicos_Credit_POS_Audita`
  MODIFY `ID_Upd_Med_Cred` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Mobiliario_Asignado`
--
ALTER TABLE `Mobiliario_Asignado`
  MODIFY `ID_Mobiliario` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Mobiliario_Asignado_Audita`
--
ALTER TABLE `Mobiliario_Asignado_Audita`
  MODIFY `Audita_Mobiliario_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `MovimientosAgenda`
--
ALTER TABLE `MovimientosAgenda`
  MODIFY `ID_Agenda_Especialista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `MovimientosCarritos`
--
ALTER TABLE `MovimientosCarritos`
  MODIFY `ID_Movimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `MovimientosEncargos`
--
ALTER TABLE `MovimientosEncargos`
  MODIFY `Id_Movimiento` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Municipios`
--
ALTER TABLE `Municipios`
  MODIFY `ID_Municipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Ordenes_Laboratorios`
--
ALTER TABLE `Ordenes_Laboratorios`
  MODIFY `Folio_Orden` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Otros_Gastos_POS`
--
ALTER TABLE `Otros_Gastos_POS`
  MODIFY `ID_Gastos` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Paquetes`
--
ALTER TABLE `Paquetes`
  MODIFY `Id_Paquete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PedidosConfirmados`
--
ALTER TABLE `PedidosConfirmados`
  MODIFY `Id_Sugerencia` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PedidosRealizadosEnfermeria`
--
ALTER TABLE `PedidosRealizadosEnfermeria`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PersonalPOS`
--
ALTER TABLE `PersonalPOS`
  MODIFY `Pos_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Folio del personal';

--
-- AUTO_INCREMENT de la tabla `PersonalPOS_Audita`
--
ALTER TABLE `PersonalPOS_Audita`
  MODIFY `Audita_Pos_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PersonalPOS_LOGS`
--
ALTER TABLE `PersonalPOS_LOGS`
  MODIFY `Pos_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Folio del personal';

--
-- AUTO_INCREMENT de la tabla `Personal_Agenda`
--
ALTER TABLE `Personal_Agenda`
  MODIFY `PersonalAgenda_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Agenda_Audita`
--
ALTER TABLE `Personal_Agenda_Audita`
  MODIFY `Personal_AgendaAudita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Enfermeria`
--
ALTER TABLE `Personal_Enfermeria`
  MODIFY `Enfermero_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Enfermeria_Audita`
--
ALTER TABLE `Personal_Enfermeria_Audita`
  MODIFY `Auditoria_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Intendecia`
--
ALTER TABLE `Personal_Intendecia`
  MODIFY `Intendencia_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Folio del personal';

--
-- AUTO_INCREMENT de la tabla `Personal_Intendecia_Audita`
--
ALTER TABLE `Personal_Intendecia_Audita`
  MODIFY `ID_Auditable` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Medico`
--
ALTER TABLE `Personal_Medico`
  MODIFY `Medico_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Medico_Express`
--
ALTER TABLE `Personal_Medico_Express`
  MODIFY `Medico_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Medico_Express_Sucursales`
--
ALTER TABLE `Personal_Medico_Express_Sucursales`
  MODIFY `Esp_X_Sucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Medico_Respaldo`
--
ALTER TABLE `Personal_Medico_Respaldo`
  MODIFY `Medico_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Personal_Medico_v2`
--
ALTER TABLE `Personal_Medico_v2`
  MODIFY `Medico_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Presentacion_Prod_POS`
--
ALTER TABLE `Presentacion_Prod_POS`
  MODIFY `Pprod_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Presentacion_Prod_POS_Updates`
--
ALTER TABLE `Presentacion_Prod_POS_Updates`
  MODIFY `ID_Update_Pre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Procedimientos_Medicos`
--
ALTER TABLE `Procedimientos_Medicos`
  MODIFY `ID_Proce` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Procedimientos_Medicos_Audita`
--
ALTER TABLE `Procedimientos_Medicos_Audita`
  MODIFY `Procede_Audita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Procedimientos_Medicos_Eliminados`
--
ALTER TABLE `Procedimientos_Medicos_Eliminados`
  MODIFY `Procede_Audita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Procedimientos_POS`
--
ALTER TABLE `Procedimientos_POS`
  MODIFY `IDProcedimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Procedimientos_Realizados`
--
ALTER TABLE `Procedimientos_Realizados`
  MODIFY `IDRealizado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PRODUCTOS_EN_CARRITO`
--
ALTER TABLE `PRODUCTOS_EN_CARRITO`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Productos_Equivalentes`
--
ALTER TABLE `Productos_Equivalentes`
  MODIFY `ID_Equivalencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Productos_POS`
--
ALTER TABLE `Productos_POS`
  MODIFY `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Productos_POSV2`
--
ALTER TABLE `Productos_POSV2`
  MODIFY `ID_Prod_POS` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Productos_POS_Eliminados`
--
ALTER TABLE `Productos_POS_Eliminados`
  MODIFY `ID_Eliminado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Productos_POS_SincronizarNuevos`
--
ALTER TABLE `Productos_POS_SincronizarNuevos`
  MODIFY `ID_Sincronizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Programacion_MedicosExt`
--
ALTER TABLE `Programacion_MedicosExt`
  MODIFY `ID_Programacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Programacion_MedicosExt_Completos`
--
ALTER TABLE `Programacion_MedicosExt_Completos`
  MODIFY `Audita_Programacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Programacion_Medicos_Sucursales`
--
ALTER TABLE `Programacion_Medicos_Sucursales`
  MODIFY `ID_Programacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Promos_Credit_POS`
--
ALTER TABLE `Promos_Credit_POS`
  MODIFY `ID_Promo_Cred` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Promos_Credit_POS_Audita`
--
ALTER TABLE `Promos_Credit_POS_Audita`
  MODIFY `ID_Update` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Proveedores_POS`
--
ALTER TABLE `Proveedores_POS`
  MODIFY `ID_Proveedor` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Proveedores_POS_Updates`
--
ALTER TABLE `Proveedores_POS_Updates`
  MODIFY `ID_Update_Prov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Recetario_Medicos`
--
ALTER TABLE `Recetario_Medicos`
  MODIFY `ID_Receta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Registros_Combustibles`
--
ALTER TABLE `Registros_Combustibles`
  MODIFY `Id_Registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Registros_Energia`
--
ALTER TABLE `Registros_Energia`
  MODIFY `Id_Registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Registros_Mantenimiento`
--
ALTER TABLE `Registros_Mantenimiento`
  MODIFY `Id_Registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_errores_Actualizacionanaqueles`
--
ALTER TABLE `registro_errores_Actualizacionanaqueles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Registro_Traspasos`
--
ALTER TABLE `Registro_Traspasos`
  MODIFY `ID_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ReimpresionesTickets_CreditosClinicas`
--
ALTER TABLE `ReimpresionesTickets_CreditosClinicas`
  MODIFY `ID_Reimpresion` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ReimpresionesTickets_CreditosDentales`
--
ALTER TABLE `ReimpresionesTickets_CreditosDentales`
  MODIFY `ID_Reimpresion` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reloj_Checador`
--
ALTER TABLE `Reloj_Checador`
  MODIFY `ID_Chequeo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reloj_ChecadorV2`
--
ALTER TABLE `Reloj_ChecadorV2`
  MODIFY `ID_Chequeo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reloj_ChecadorV2Entrada`
--
ALTER TABLE `Reloj_ChecadorV2Entrada`
  MODIFY `ID_Chequeo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reloj_ChecadorV2_EntradasComida`
--
ALTER TABLE `Reloj_ChecadorV2_EntradasComida`
  MODIFY `ID_Chequeo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reloj_ChecadorV2_Salidas`
--
ALTER TABLE `Reloj_ChecadorV2_Salidas`
  MODIFY `ID_Chequeo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reloj_ChecadorV2_SalidasComida`
--
ALTER TABLE `Reloj_ChecadorV2_SalidasComida`
  MODIFY `ID_Chequeo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Resultados_Ultrasonidos`
--
ALTER TABLE `Resultados_Ultrasonidos`
  MODIFY `ID_resultado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Roles_Puestos`
--
ALTER TABLE `Roles_Puestos`
  MODIFY `ID_rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Rutas`
--
ALTER TABLE `Rutas`
  MODIFY `Id_ruta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Servicios_Especializados`
--
ALTER TABLE `Servicios_Especializados`
  MODIFY `Especialista_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Servicios_POS`
--
ALTER TABLE `Servicios_POS`
  MODIFY `Servicio_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Servicios_POS_Audita`
--
ALTER TABLE `Servicios_POS_Audita`
  MODIFY `Audita_Serv_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Signos_Vitales`
--
ALTER TABLE `Signos_Vitales`
  MODIFY `ID_SignoV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Signos_VitalesV2`
--
ALTER TABLE `Signos_VitalesV2`
  MODIFY `ID_SignoV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Sincronizacion_Cajas`
--
ALTER TABLE `Sincronizacion_Cajas`
  MODIFY `Id_Sincroniza` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Solicitudes_Ingresos`
--
ALTER TABLE `Solicitudes_Ingresos`
  MODIFY `IdProdCedis` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Solicitudes_Traspasos`
--
ALTER TABLE `Solicitudes_Traspasos`
  MODIFY `ID_Sol_Traspaso` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_Bajas`
--
ALTER TABLE `Stock_Bajas`
  MODIFY `Id_Baja` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_Dental`
--
ALTER TABLE `Stock_Dental`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_Enfermeria`
--
ALTER TABLE `Stock_Enfermeria`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_Med`
--
ALTER TABLE `Stock_Med`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_POS`
--
ALTER TABLE `Stock_POS`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_POS_Audita`
--
ALTER TABLE `Stock_POS_Audita`
  MODIFY `ID_Audita_Stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_POS_PruebasInv`
--
ALTER TABLE `Stock_POS_PruebasInv`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_POS_RespaldoPrevioAMontejo`
--
ALTER TABLE `Stock_POS_RespaldoPrevioAMontejo`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_POS_RespaldoPrevioCaucel`
--
ALTER TABLE `Stock_POS_RespaldoPrevioCaucel`
  MODIFY `Folio_Prod_Stock` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_POS_TablaAuditorias`
--
ALTER TABLE `Stock_POS_TablaAuditorias`
  MODIFY `IdAuditoria` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Stock_registrosNuevos`
--
ALTER TABLE `Stock_registrosNuevos`
  MODIFY `Folio_Ingreso` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `SucursalesCorre`
--
ALTER TABLE `SucursalesCorre`
  MODIFY `ID_SucursalC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Sucursales_Audita`
--
ALTER TABLE `Sucursales_Audita`
  MODIFY `Audita_Suc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Sucursales_Campañas`
--
ALTER TABLE `Sucursales_Campañas`
  MODIFY `ID_SucursalC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Sucursales_especialistas`
--
ALTER TABLE `Sucursales_especialistas`
  MODIFY `ID_Sucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Sugerencias_POS`
--
ALTER TABLE `Sugerencias_POS`
  MODIFY `Id_Sugerencia` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Sugerencias_POS_Eliminados`
--
ALTER TABLE `Sugerencias_POS_Eliminados`
  MODIFY `Id_eliminado` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tickets_Asigna`
--
ALTER TABLE `Tickets_Asigna`
  MODIFY `ID_Ticket_Asigna` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tickets_Cierre`
--
ALTER TABLE `Tickets_Cierre`
  MODIFY `ID_Ticket_Cierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tickets_Imagenes`
--
ALTER TABLE `Tickets_Imagenes`
  MODIFY `ID_Imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tickets_Incidencias`
--
ALTER TABLE `Tickets_Incidencias`
  MODIFY `ID_incidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tickets_Reportes`
--
ALTER TABLE `Tickets_Reportes`
  MODIFY `Id_Ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tickets_soporte`
--
ALTER TABLE `tickets_soporte`
  MODIFY `ID_Ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipos_Consultas`
--
ALTER TABLE `Tipos_Consultas`
  MODIFY `Tipo_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipos_Credit_POS`
--
ALTER TABLE `Tipos_Credit_POS`
  MODIFY `ID_Tip_Cred` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipos_Credit_POS_Updates`
--
ALTER TABLE `Tipos_Credit_POS_Updates`
  MODIFY `ID_Update` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipos_estudios`
--
ALTER TABLE `Tipos_estudios`
  MODIFY `ID_tipo_analisis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipos_Mobiliarios_POS`
--
ALTER TABLE `Tipos_Mobiliarios_POS`
  MODIFY `Tip_Mob_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipos_Mobiliarios_POS_Audita`
--
ALTER TABLE `Tipos_Mobiliarios_POS_Audita`
  MODIFY `Tipo_Mob_Audita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipo_analisis`
--
ALTER TABLE `Tipo_analisis`
  MODIFY `ID_Analisis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TipProd_POS`
--
ALTER TABLE `TipProd_POS`
  MODIFY `Tip_Prod_ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TipProd_POS_Audita`
--
ALTER TABLE `TipProd_POS_Audita`
  MODIFY `ID_Audita_TipoProd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Traspasos_Enfermeria`
--
ALTER TABLE `Traspasos_Enfermeria`
  MODIFY `ID_Traspaso_Generado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Traspasos_generados`
--
ALTER TABLE `Traspasos_generados`
  MODIFY `ID_Traspaso_Generado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Traspasos_generados_audita`
--
ALTER TABLE `Traspasos_generados_audita`
  MODIFY `id_audita_traspaso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Traspasos_generados_Eliminados`
--
ALTER TABLE `Traspasos_generados_Eliminados`
  MODIFY `ID_eliminado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Traspasos_generados_Proveedores`
--
ALTER TABLE `Traspasos_generados_Proveedores`
  MODIFY `ID_Traspaso_Generado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tutoriales_vistos`
--
ALTER TABLE `tutoriales_vistos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Update_Precios_Productos`
--
ALTER TABLE `Update_Precios_Productos`
  MODIFY `ID_UPDATE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Ventas_POS`
--
ALTER TABLE `Ventas_POS`
  MODIFY `Venta_POS_ID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Ventas_POS_Audita`
--
ALTER TABLE `Ventas_POS_Audita`
  MODIFY `ID_Audita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Ventas_POS_Cancelaciones`
--
ALTER TABLE `Ventas_POS_Cancelaciones`
  MODIFY `Cancelacion_IDVenPOS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Ventas_POS_Pruebas`
--
ALTER TABLE `Ventas_POS_Pruebas`
  MODIFY `Venta_POS_ID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `VerificacionSincronizacion_Productos`
--
ALTER TABLE `VerificacionSincronizacion_Productos`
  MODIFY `ID_Sincronizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `VerificacionSincronizacion_Stock`
--
ALTER TABLE `VerificacionSincronizacion_Stock`
  MODIFY `ID_Sincronizacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Verificacion_Actualizacion_Stock`
--
ALTER TABLE `Verificacion_Actualizacion_Stock`
  MODIFY `ID_Sincronizacion` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Estructura para la vista `diciembreenero`
--
DROP TABLE IF EXISTS `diciembreenero`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludDevCenter`@`127.0.0.1` SQL SECURITY DEFINER VIEW `diciembreenero`  AS SELECT `Signos_VitalesV2`.`ID_SignoV` AS `ID_SignoV`, `Signos_VitalesV2`.`Folio_Paciente` AS `Folio_Paciente`, `Signos_VitalesV2`.`Nombre_Paciente` AS `Nombre_Paciente`, `Signos_VitalesV2`.`Motivo_Consulta` AS `Motivo_Consulta`, `Signos_VitalesV2`.`Nombre_Doctor` AS `Nombre_Doctor`, `Signos_VitalesV2`.`Edad` AS `Edad`, `Signos_VitalesV2`.`Sexo` AS `Sexo`, `Signos_VitalesV2`.`Telefono` AS `Telefono`, `Signos_VitalesV2`.`Fk_Enfermero` AS `Fk_Enfermero`, `Signos_VitalesV2`.`Fk_Sucursal` AS `Fk_Sucursal`, `Signos_VitalesV2`.`FK_ID_H_O_D` AS `FK_ID_H_O_D`, `Signos_VitalesV2`.`Fecha_Visita` AS `Fecha_Visita`, `Signos_VitalesV2`.`Estatus` AS `Estatus`, `Signos_VitalesV2`.`CodigoEstatus` AS `CodigoEstatus`, `Data_Pacientes`.`ID_Data_Paciente` AS `ID_Data_Paciente`, `Data_Pacientes`.`Fecha_Nacimiento` AS `Fecha_Nacimiento`, `SucursalesCorre`.`ID_SucursalC` AS `ID_SucursalC`, `SucursalesCorre`.`Nombre_Sucursal` AS `Nombre_Sucursal`, timestampdiff(YEAR,`Data_Pacientes`.`Fecha_Nacimiento`,curdate()) AS `Edad_Calculada` FROM ((`Signos_VitalesV2` join `SucursalesCorre` on(`Signos_VitalesV2`.`Fk_Sucursal` = `SucursalesCorre`.`ID_SucursalC`)) join `Data_Pacientes` on(`Data_Pacientes`.`ID_Data_Paciente` = `Signos_VitalesV2`.`Folio_Paciente`)) WHERE `Signos_VitalesV2`.`Fecha_Visita` between '2023-12-01' and '2024-01-31' GROUP BY `Signos_VitalesV2`.`ID_SignoV` ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CARRITOS`
--
ALTER TABLE `CARRITOS`
  ADD CONSTRAINT `FK_SUCURSAL` FOREIGN KEY (`ID_SUCURSAL`) REFERENCES `SucursalesCorre` (`ID_SucursalC`);

--
-- Filtros para la tabla `Municipios`
--
ALTER TABLE `Municipios`
  ADD CONSTRAINT `Municipios_ibfk_1` FOREIGN KEY (`Fk_Estado`) REFERENCES `Estados` (`ID_Estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `PersonalPOS`
--
ALTER TABLE `PersonalPOS`
  ADD CONSTRAINT `PersonalPOS_ibfk_1` FOREIGN KEY (`Fk_Usuario`) REFERENCES `Roles_Puestos` (`ID_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PersonalPOS_ibfk_2` FOREIGN KEY (`ID_H_O_D`) REFERENCES `Hospital_Organizacion_Dueño` (`H_O_D`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Procedimientos_Realizados`
--
ALTER TABLE `Procedimientos_Realizados`
  ADD CONSTRAINT `Procedimientos_Realizados_ibfk_1` FOREIGN KEY (`IDProcedimiento`) REFERENCES `Procedimientos_POS` (`IDProcedimiento`);

--
-- Filtros para la tabla `PRODUCTOS_EN_CARRITO`
--
ALTER TABLE `PRODUCTOS_EN_CARRITO`
  ADD CONSTRAINT `PRODUCTOS_EN_CARRITO_ibfk_1` FOREIGN KEY (`ID_CARRITO`) REFERENCES `CARRITOS` (`ID_CARRITO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Productos_En_Procedimientos`
--
ALTER TABLE `Productos_En_Procedimientos`
  ADD CONSTRAINT `Productos_En_Procedimientos_ibfk_1` FOREIGN KEY (`Fk_Proced`) REFERENCES `Procedimientos_POS` (`IDProcedimiento`),
  ADD CONSTRAINT `Productos_En_Procedimientos_ibfk_2` FOREIGN KEY (`Fk_Produc_Stock`) REFERENCES `Stock_POS` (`Folio_Prod_Stock`);

--
-- Filtros para la tabla `Roles_Puestos`
--
ALTER TABLE `Roles_Puestos`
  ADD CONSTRAINT `Roles_Puestos_ibfk_2` FOREIGN KEY (`ID_H_O_D`) REFERENCES `Hospital_Organizacion_Dueño` (`H_O_D`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Rutas`
--
ALTER TABLE `Rutas`
  ADD CONSTRAINT `Rutas_ibfk_1` FOREIGN KEY (`Id_personal`) REFERENCES `dispositivos` (`id`);

--
-- Filtros para la tabla `Servicios_Especializados`
--
ALTER TABLE `Servicios_Especializados`
  ADD CONSTRAINT `Servicios_Especializados_ibfk_2` FOREIGN KEY (`ID_H_O_D`) REFERENCES `Hospital_Organizacion_Dueño` (`H_O_D`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Servicios_Especializados_ibfk_3` FOREIGN KEY (`Fk_Logo_identidad`) REFERENCES `Hospital_Organizacion_Dueño` (`Logo_identidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Sucursales`
--
ALTER TABLE `Sucursales`
  ADD CONSTRAINT `Sucursales_ibfk_1` FOREIGN KEY (`Dueño_Propiedad`) REFERENCES `Hospital_Organizacion_Dueño` (`H_O_D`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Sucursales_especialistas`
--
ALTER TABLE `Sucursales_especialistas`
  ADD CONSTRAINT `Sucursales_especialistas_ibfk_1` FOREIGN KEY (`Nombre_Sucursal`) REFERENCES `Sucursales` (`Nombre_ID_Sucursal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Sucursales_especialistas_ibfk_2` FOREIGN KEY (`FK_Especialista`) REFERENCES `Especialistas` (`ID_Especialista`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Tickets_Imagenes`
--
ALTER TABLE `Tickets_Imagenes`
  ADD CONSTRAINT `Tickets_Imagenes_ibfk_1` FOREIGN KEY (`Ticket_Id`) REFERENCES `Tickets_Soporte` (`Id_Ticket`);

--
-- Filtros para la tabla `Tipo_analisis`
--
ALTER TABLE `Tipo_analisis`
  ADD CONSTRAINT `Tipo_analisis_ibfk_1` FOREIGN KEY (`ID_H_O_D`) REFERENCES `Hospital_Organizacion_Dueño` (`H_O_D`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Turnos_Trabajo`
--
ALTER TABLE `Turnos_Trabajo`
  ADD CONSTRAINT `Turnos_Trabajo_ibfk_1` FOREIGN KEY (`ID_H_O_D`) REFERENCES `Hospital_Organizacion_Dueño` (`H_O_D`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `UbicacionesRuta`
--
ALTER TABLE `UbicacionesRuta`
  ADD CONSTRAINT `UbicacionesRuta_ibfk_1` FOREIGN KEY (`Id_ruta`) REFERENCES `Rutas` (`Id_ruta`),
  ADD CONSTRAINT `UbicacionesRuta_ibfk_2` FOREIGN KEY (`Id_sucursal`) REFERENCES `SucursalesCorre` (`ID_SucursalC`),
  ADD CONSTRAINT `UbicacionesRuta_ibfk_3` FOREIGN KEY (`Id_personal`) REFERENCES `dispositivos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
