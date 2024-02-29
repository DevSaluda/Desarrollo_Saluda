<?php
include_once("db_connection.php");
$sql = "SELECT AgendaCita_Analisis.ID_Agenda,AgendaCita_Analisis.ID_H_O_D,AgendaCita_Analisis.Sucursal,
AgendaCita_Analisis.Fecha,AgendaCita_Analisis.Hora_cita,AgendaCita_Analisis.Tipo_analisis, 
AgendaCita_Analisis.Tipo_estudio,AgendaCita_Analisis.Nombre_solicitante,AgendaCita_Analisis.Edad,
AgendaCita_Analisis.Telefono,AgendaCita_Analisis.Estado_cita,AgendaCita_Analisis.Nombre_empleado, 
Tipo_analisis.Nombre_analisis, Tipos_estudios.Nombre_estudio FROM AgendaCita_Analisis, Tipo_analisis, 
Tipos_estudios WHERE AgendaCita_Analisis.Tipo_analisis= Tipo_analisis.ID_Analisis
 and AgendaCita_Analisis.Tipo_estudio= Tipos_estudios.ID_tipo_analisis AND AgendaCita_Analisis.ID_H_O_D='".$row['ID_H_O_D']."' LIMIT 5";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));


?>
