-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-07-2025 a las 20:09:16
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
-- Base de datos: `u155356178_SaludaHuellas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaper`
--

CREATE TABLE `asistenciaper` (
  `Id_asis` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Id_Pernl` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `FechaAsis` date DEFAULT NULL,
  `Nombre_dia` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `HoIngreso` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `HoSalida` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Tardanzas` int(11) DEFAULT NULL,
  `Justifacion` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `EstadoAsis` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tipoturno` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `idgrupo_al` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `totalhora_tr` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaperRespaldo2025`
--

CREATE TABLE `asistenciaperRespaldo2025` (
  `Id_asis` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Id_Pernl` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `FechaAsis` date DEFAULT NULL,
  `Nombre_dia` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `HoIngreso` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `HoSalida` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Tardanzas` int(11) DEFAULT NULL,
  `Justifacion` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `EstadoAsis` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tipoturno` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `idgrupo_al` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `totalhora_tr` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaperxdxx`
--

CREATE TABLE `asistenciaperxdxx` (
  `Id_asis` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Id_Pernl` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `FechaAsis` date DEFAULT NULL,
  `Nombre_dia` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `HoIngreso` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `HoSalida` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Tardanzas` int(11) DEFAULT NULL,
  `Justifacion` varchar(350) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `EstadoAsis` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tipoturno` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `idgrupo_al` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `totalhora_tr` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaper_Respaldov2`
--

CREATE TABLE `asistenciaper_Respaldov2` (
  `Id_asis` char(255) NOT NULL,
  `Id_Pernl` char(6) NOT NULL,
  `FechaAsis` date DEFAULT NULL,
  `Nombre_dia` varchar(12) NOT NULL,
  `HoIngreso` varchar(10) NOT NULL,
  `HoSalida` varchar(10) NOT NULL,
  `Tardanzas` int(11) DEFAULT NULL,
  `Justifacion` varchar(350) DEFAULT NULL,
  `EstadoAsis` varchar(15) DEFAULT NULL,
  `tipoturno` varchar(15) DEFAULT NULL,
  `idgrupo_al` char(5) DEFAULT NULL,
  `totalhora_tr` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaper_respaldov3`
--

CREATE TABLE `asistenciaper_respaldov3` (
  `Id_asis` char(255) NOT NULL,
  `Id_Pernl` char(6) NOT NULL,
  `FechaAsis` date DEFAULT NULL,
  `Nombre_dia` varchar(12) NOT NULL,
  `HoIngreso` varchar(10) NOT NULL,
  `HoSalida` varchar(10) NOT NULL,
  `Tardanzas` int(11) DEFAULT NULL,
  `Justifacion` varchar(350) DEFAULT NULL,
  `EstadoAsis` varchar(15) DEFAULT NULL,
  `tipoturno` varchar(15) DEFAULT NULL,
  `idgrupo_al` char(5) DEFAULT NULL,
  `totalhora_tr` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargarhoraria`
--

CREATE TABLE `cargarhoraria` (
  `Id_Carga` char(6) NOT NULL,
  `Id_Pernl` char(6) NOT NULL,
  `AreaTrabajo` varchar(90) DEFAULT NULL,
  `Id_Hor` char(6) NOT NULL,
  `DiaTrabajo` varchar(12) DEFAULT NULL,
  `EstadoCarga` varchar(15) DEFAULT NULL,
  `turnohor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `idconfig` int(11) NOT NULL,
  `nom_institucion` varchar(190) DEFAULT NULL,
  `direccion_insti` varchar(220) DEFAULT NULL,
  `Nro_legal` char(12) DEFAULT NULL,
  `correo_institu` varchar(150) DEFAULT NULL,
  `clave_correo` varchar(18) DEFAULT NULL,
  `logo_institu` mediumblob DEFAULT NULL,
  `licenciatipo` varchar(15) DEFAULT NULL,
  `fechaexpira` datetime DEFAULT NULL,
  `noti_xaudio_justi` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_grupo_acad`
--

CREATE TABLE `det_grupo_acad` (
  `iddet_gr` int(11) NOT NULL,
  `idgrup` char(5) NOT NULL,
  `Id_pernl` char(6) NOT NULL,
  `estado_alum` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_acad`
--

CREATE TABLE `grado_acad` (
  `idgrad` int(11) NOT NULL,
  `idnive` char(3) NOT NULL,
  `nomgrad` varchar(8) DEFAULT NULL,
  `estadograd` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_acad`
--

CREATE TABLE `grupo_acad` (
  `idgrup` char(5) NOT NULL,
  `idsecc` int(11) NOT NULL,
  `id_docnte` char(6) NOT NULL,
  `nombreDocente` varchar(190) DEFAULT NULL,
  `Dni_docen` char(10) DEFAULT NULL,
  `nomgrupo_acad` varchar(25) DEFAULT NULL,
  `estado_grup` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `Id_Hor` char(6) NOT NULL,
  `HoEntrada` datetime DEFAULT NULL,
  `Mitolrncia` int(11) DEFAULT NULL,
  `HoSalida` datetime DEFAULT NULL,
  `resumenhor` varchar(30) DEFAULT NULL,
  `HoLimite` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificacion`
--

CREATE TABLE `justificacion` (
  `Id_justi` char(6) NOT NULL,
  `Id_Pernl` char(6) NOT NULL,
  `PrincipalMotivo` varchar(50) DEFAULT NULL,
  `Detalle_Justi` varchar(500) DEFAULT NULL,
  `FechaJusti` datetime DEFAULT NULL,
  `EstadoJus` varchar(50) DEFAULT NULL,
  `FechaEmi` datetime DEFAULT NULL,
  `fotodoc` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_acad`
--

CREATE TABLE `nivel_acad` (
  `idnive` char(3) NOT NULL,
  `nomnive` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `Id_pernl` char(6) NOT NULL,
  `Cedula` char(10) DEFAULT NULL,
  `Nombre_Completo` varchar(150) DEFAULT NULL,
  `Fec_Naci` date DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `Domicilio` varchar(190) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Celular` varchar(10) DEFAULT NULL,
  `Cargo_rol` varchar(20) DEFAULT NULL,
  `Foto` longblob DEFAULT NULL,
  `huelladedo` blob DEFAULT NULL,
  `Estado_Per` varchar(20) DEFAULT NULL,
  `notificarxemail` char(2) DEFAULT NULL,
  `usu_per` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Id_rol` char(6) NOT NULL,
  `NomRol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_acad`
--

CREATE TABLE `seccion_acad` (
  `idsecc` int(11) NOT NULL,
  `nomsecc` varchar(8) DEFAULT NULL,
  `idgrad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodoc`
--

CREATE TABLE `tipodoc` (
  `Idtipo` int(11) NOT NULL,
  `NombreTipo` varchar(30) DEFAULT NULL,
  `Serie` varchar(2) DEFAULT NULL,
  `Numero_T` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usu` char(6) NOT NULL,
  `Nombre_Completo` varchar(150) DEFAULT NULL,
  `Avatar` blob DEFAULT NULL,
  `nomusu` varchar(8) DEFAULT NULL,
  `claveus` varchar(8) DEFAULT NULL,
  `Estado_Usu` varchar(30) DEFAULT NULL,
  `Id_rol` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_personal_asistencia`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_personal_asistencia` (
`Id_Pernl` char(6)
,`Cedula` char(10)
,`Nombre_Completo` varchar(150)
,`Sexo` char(1)
,`Cargo_rol` varchar(20)
,`Domicilio` varchar(190)
,`Id_asis` char(255)
,`FechaAsis` date
,`Nombre_dia` varchar(12)
,`HoIngreso` varchar(10)
,`HoSalida` varchar(10)
,`Tardanzas` int(11)
,`Justifacion` varchar(350)
,`tipoturno` varchar(15)
,`EstadoAsis` varchar(15)
,`totalhora_tr` double
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_cargahoraria_personhor`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_cargahoraria_personhor` (
`Id_Carga` char(6)
,`AreaTrabajo` varchar(90)
,`DiaTrabajo` varchar(12)
,`EstadoCarga` varchar(15)
,`turnohor` varchar(30)
,`Id_Hor` char(6)
,`HoEntrada` datetime
,`Mitolrncia` int(11)
,`HoSalida` datetime
,`resumenHor` varchar(30)
,`Holimite` datetime
,`Id_Pernl` char(6)
,`Cedula` char(10)
,`Nombre_Completo` varchar(150)
,`Foto` longblob
,`huelladedo` blob
,`Cargo_rol` varchar(20)
,`Sexo` char(1)
,`Domicilio` varchar(190)
,`Celular` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_niveles_grado`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_niveles_grado` (
`idnive` char(3)
,`nomnive` varchar(10)
,`idgrad` int(11)
,`nomgrad` varchar(8)
,`gradnive` varchar(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_personal_justificacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_personal_justificacion` (
`Id_Justi` char(6)
,`PrincipalMotivo` varchar(50)
,`Detalle_Justi` varchar(500)
,`FechaJusti` datetime
,`EstadoJus` varchar(50)
,`FechaEmi` datetime
,`fotodoc` longblob
,`Id_Pernl` char(6)
,`Cedula` char(10)
,`Nombre_Completo` varchar(150)
,`Correo` varchar(50)
,`notificarxemail` char(2)
,`Cargo_rol` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_seccion_grado`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_seccion_grado` (
`idsecc` int(11)
,`nomsecc` varchar(8)
,`idgrad` int(11)
,`nomgrad` varchar(8)
,`idnive` char(3)
,`nomnive` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_union_de_grupo`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_union_de_grupo` (
`idgrup` char(5)
,`id_docnte` char(6)
,`nombreDocente` varchar(190)
,`Dni_docen` char(10)
,`nomgrupo_acad` varchar(25)
,`estado_grup` varchar(15)
,`idgrad` int(11)
,`nomgrad` varchar(8)
,`idnive` char(3)
,`nomnive` varchar(10)
,`idsecc` int(11)
,`nomsecc` varchar(8)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_union_de_grupo_detalle`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_union_de_grupo_detalle` (
`idgrup` char(5)
,`id_docnte` char(6)
,`nombreDocente` varchar(190)
,`Dni_docen` char(10)
,`nomgrupo_acad` varchar(25)
,`estado_grup` varchar(15)
,`iddet_gr` int(11)
,`estado_alum` varchar(15)
,`idgrad` int(11)
,`nomgrad` varchar(8)
,`idnive` char(3)
,`nomnive` varchar(10)
,`idsecc` int(11)
,`nomsecc` varchar(8)
,`Id_pernl` char(6)
,`Nombre_Completo` varchar(150)
,`Sexo` char(1)
,`Cedula` char(10)
,`Correo` varchar(50)
,`Celular` varchar(10)
,`Foto` longblob
,`Fec_Naci` date
,`Domicilio` varchar(190)
,`Estado_Per` varchar(20)
,`Cargo_rol` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_usuarios_roles`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_usuarios_roles` (
`Id_Usu` char(6)
,`Nombre_Completo` varchar(150)
,`Avatar` blob
,`nomusu` varchar(8)
,`claveus` varchar(8)
,`Estado_Usu` varchar(30)
,`Id_rol` char(6)
,`NomRol` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_personal_asistencia`
--
DROP TABLE IF EXISTS `vista_personal_asistencia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `vista_personal_asistencia`  AS SELECT `p`.`Id_pernl` AS `Id_Pernl`, `p`.`Cedula` AS `Cedula`, `p`.`Nombre_Completo` AS `Nombre_Completo`, `p`.`Sexo` AS `Sexo`, `p`.`Cargo_rol` AS `Cargo_rol`, `p`.`Domicilio` AS `Domicilio`, `a`.`Id_asis` AS `Id_asis`, `a`.`FechaAsis` AS `FechaAsis`, `a`.`Nombre_dia` AS `Nombre_dia`, `a`.`HoIngreso` AS `HoIngreso`, `a`.`HoSalida` AS `HoSalida`, `a`.`Tardanzas` AS `Tardanzas`, `a`.`Justifacion` AS `Justifacion`, `a`.`tipoturno` AS `tipoturno`, `a`.`EstadoAsis` AS `EstadoAsis`, `a`.`totalhora_tr` AS `totalhora_tr` FROM (`personal` `p` join `asistenciaper` `a`) WHERE `a`.`Id_Pernl` = `p`.`Id_pernl` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_cargahoraria_personhor`
--
DROP TABLE IF EXISTS `v_cargahoraria_personhor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_cargahoraria_personhor`  AS SELECT `c`.`Id_Carga` AS `Id_Carga`, `c`.`AreaTrabajo` AS `AreaTrabajo`, `c`.`DiaTrabajo` AS `DiaTrabajo`, `c`.`EstadoCarga` AS `EstadoCarga`, `c`.`turnohor` AS `turnohor`, `h`.`Id_Hor` AS `Id_Hor`, `h`.`HoEntrada` AS `HoEntrada`, `h`.`Mitolrncia` AS `Mitolrncia`, `h`.`HoSalida` AS `HoSalida`, `h`.`resumenhor` AS `resumenHor`, `h`.`HoLimite` AS `Holimite`, `p`.`Id_pernl` AS `Id_Pernl`, `p`.`Cedula` AS `Cedula`, `p`.`Nombre_Completo` AS `Nombre_Completo`, `p`.`Foto` AS `Foto`, `p`.`huelladedo` AS `huelladedo`, `p`.`Cargo_rol` AS `Cargo_rol`, `p`.`Sexo` AS `Sexo`, `p`.`Domicilio` AS `Domicilio`, `p`.`Celular` AS `Celular` FROM ((`cargarhoraria` `c` join `horario` `h`) join `personal` `p`) WHERE `c`.`Id_Hor` = `h`.`Id_Hor` AND `c`.`Id_Pernl` = `p`.`Id_pernl` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_niveles_grado`
--
DROP TABLE IF EXISTS `v_niveles_grado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_niveles_grado`  AS SELECT `n`.`idnive` AS `idnive`, `n`.`nomnive` AS `nomnive`, `g`.`idgrad` AS `idgrad`, `g`.`nomgrad` AS `nomgrad`, concat_ws(' - ',`g`.`nomgrad`,`n`.`nomnive`) AS `gradnive` FROM (`nivel_acad` `n` join `grado_acad` `g`) WHERE `g`.`idnive` = `n`.`idnive` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_personal_justificacion`
--
DROP TABLE IF EXISTS `v_personal_justificacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_personal_justificacion`  AS SELECT `j`.`Id_justi` AS `Id_Justi`, `j`.`PrincipalMotivo` AS `PrincipalMotivo`, `j`.`Detalle_Justi` AS `Detalle_Justi`, `j`.`FechaJusti` AS `FechaJusti`, `j`.`EstadoJus` AS `EstadoJus`, `j`.`FechaEmi` AS `FechaEmi`, `j`.`fotodoc` AS `fotodoc`, `p`.`Id_pernl` AS `Id_Pernl`, `p`.`Cedula` AS `Cedula`, `p`.`Nombre_Completo` AS `Nombre_Completo`, `p`.`Correo` AS `Correo`, `p`.`notificarxemail` AS `notificarxemail`, `p`.`Cargo_rol` AS `Cargo_rol` FROM (`justificacion` `j` join `personal` `p`) WHERE `j`.`Id_Pernl` = `p`.`Id_pernl` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_seccion_grado`
--
DROP TABLE IF EXISTS `v_seccion_grado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_seccion_grado`  AS SELECT `s`.`idsecc` AS `idsecc`, `s`.`nomsecc` AS `nomsecc`, `g`.`idgrad` AS `idgrad`, `g`.`nomgrad` AS `nomgrad`, `n`.`idnive` AS `idnive`, `n`.`nomnive` AS `nomnive` FROM ((`seccion_acad` `s` join `grado_acad` `g`) join `nivel_acad` `n`) WHERE `s`.`idgrad` = `g`.`idgrad` AND `g`.`idnive` = `n`.`idnive` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_union_de_grupo`
--
DROP TABLE IF EXISTS `v_union_de_grupo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_union_de_grupo`  AS SELECT `ga`.`idgrup` AS `idgrup`, `ga`.`id_docnte` AS `id_docnte`, `ga`.`nombreDocente` AS `nombreDocente`, `ga`.`Dni_docen` AS `Dni_docen`, `ga`.`nomgrupo_acad` AS `nomgrupo_acad`, `ga`.`estado_grup` AS `estado_grup`, `g`.`idgrad` AS `idgrad`, `g`.`nomgrad` AS `nomgrad`, `n`.`idnive` AS `idnive`, `n`.`nomnive` AS `nomnive`, `s`.`idsecc` AS `idsecc`, `s`.`nomsecc` AS `nomsecc` FROM (((`grupo_acad` `ga` join `grado_acad` `g`) join `nivel_acad` `n`) join `seccion_acad` `s`) WHERE `ga`.`idsecc` = `s`.`idsecc` AND `s`.`idgrad` = `g`.`idgrad` AND `g`.`idnive` = `n`.`idnive` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_union_de_grupo_detalle`
--
DROP TABLE IF EXISTS `v_union_de_grupo_detalle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_union_de_grupo_detalle`  AS SELECT `ga`.`idgrup` AS `idgrup`, `ga`.`id_docnte` AS `id_docnte`, `ga`.`nombreDocente` AS `nombreDocente`, `ga`.`Dni_docen` AS `Dni_docen`, `ga`.`nomgrupo_acad` AS `nomgrupo_acad`, `ga`.`estado_grup` AS `estado_grup`, `dt`.`iddet_gr` AS `iddet_gr`, `dt`.`estado_alum` AS `estado_alum`, `g`.`idgrad` AS `idgrad`, `g`.`nomgrad` AS `nomgrad`, `n`.`idnive` AS `idnive`, `n`.`nomnive` AS `nomnive`, `s`.`idsecc` AS `idsecc`, `s`.`nomsecc` AS `nomsecc`, `p`.`Id_pernl` AS `Id_pernl`, `p`.`Nombre_Completo` AS `Nombre_Completo`, `p`.`Sexo` AS `Sexo`, `p`.`Cedula` AS `Cedula`, `p`.`Correo` AS `Correo`, `p`.`Celular` AS `Celular`, `p`.`Foto` AS `Foto`, `p`.`Fec_Naci` AS `Fec_Naci`, `p`.`Domicilio` AS `Domicilio`, `p`.`Estado_Per` AS `Estado_Per`, `p`.`Cargo_rol` AS `Cargo_rol` FROM (((((`grupo_acad` `ga` join `det_grupo_acad` `dt`) join `grado_acad` `g`) join `nivel_acad` `n`) join `seccion_acad` `s`) join `personal` `p`) WHERE `ga`.`idsecc` = `s`.`idsecc` AND `dt`.`idgrup` = `ga`.`idgrup` AND `dt`.`Id_pernl` = `p`.`Id_pernl` AND `s`.`idgrad` = `g`.`idgrad` AND `g`.`idnive` = `n`.`idnive` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_usuarios_roles`
--
DROP TABLE IF EXISTS `v_usuarios_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u155356178_SaludaCapturad`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_usuarios_roles`  AS SELECT `p`.`Id_Usu` AS `Id_Usu`, `p`.`Nombre_Completo` AS `Nombre_Completo`, `p`.`Avatar` AS `Avatar`, `p`.`nomusu` AS `nomusu`, `p`.`claveus` AS `claveus`, `p`.`Estado_Usu` AS `Estado_Usu`, `r`.`Id_rol` AS `Id_rol`, `r`.`NomRol` AS `NomRol` FROM (`usuario` `p` join `rol` `r`) WHERE `p`.`Id_rol` = `r`.`Id_rol` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistenciaper`
--
ALTER TABLE `asistenciaper`
  ADD PRIMARY KEY (`Id_asis`),
  ADD KEY `Id_Pernl` (`Id_Pernl`);

--
-- Indices de la tabla `asistenciaperRespaldo2025`
--
ALTER TABLE `asistenciaperRespaldo2025`
  ADD PRIMARY KEY (`Id_asis`),
  ADD KEY `Id_Pernl` (`Id_Pernl`);

--
-- Indices de la tabla `asistenciaperxdxx`
--
ALTER TABLE `asistenciaperxdxx`
  ADD PRIMARY KEY (`Id_asis`),
  ADD KEY `FK_ASIS_PER` (`Id_Pernl`);

--
-- Indices de la tabla `cargarhoraria`
--
ALTER TABLE `cargarhoraria`
  ADD PRIMARY KEY (`Id_Carga`),
  ADD KEY `PK_Hordet` (`Id_Hor`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`idconfig`);

--
-- Indices de la tabla `grado_acad`
--
ALTER TABLE `grado_acad`
  ADD PRIMARY KEY (`idgrad`);

--
-- Indices de la tabla `grupo_acad`
--
ALTER TABLE `grupo_acad`
  ADD PRIMARY KEY (`idgrup`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`Id_Hor`);

--
-- Indices de la tabla `nivel_acad`
--
ALTER TABLE `nivel_acad`
  ADD PRIMARY KEY (`idnive`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`Id_pernl`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id_rol`);

--
-- Indices de la tabla `seccion_acad`
--
ALTER TABLE `seccion_acad`
  ADD PRIMARY KEY (`idsecc`);

--
-- Indices de la tabla `tipodoc`
--
ALTER TABLE `tipodoc`
  ADD PRIMARY KEY (`Idtipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipodoc`
--
ALTER TABLE `tipodoc`
  MODIFY `Idtipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargarhoraria`
--
ALTER TABLE `cargarhoraria`
  ADD CONSTRAINT `PK_Hordet` FOREIGN KEY (`Id_Hor`) REFERENCES `horario` (`Id_Hor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
