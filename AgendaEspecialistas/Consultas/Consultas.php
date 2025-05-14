<?php
date_default_timezone_set("America/Monterrey");
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

// Cambia la validación de sesión al identificador de especialistas
if(!isset($_SESSION['Especialista_ID'])){
    header("Location: Expiro");
    exit();
}

include_once("db_connection.php");

// Ajusta la consulta para la tabla de especialistas
$sql = "SELECT 
    IngresoAgendaEspecialistas.PersonalAgendaEspecialista_ID,
    IngresoAgendaEspecialistas.Nombre_Apellidos,
    IngresoAgendaEspecialistas.file_name,
    IngresoAgendaEspecialistas.Estatus,
    IngresoAgendaEspecialistas.ID_H_O_D,
    IngresoAgendaEspecialistas.Fk_Usuario,
    IngresoAgendaEspecialistas.Correo_Electronico,
    IngresoAgendaEspecialistas.ColorEstatus
FROM 
    IngresoAgendaEspecialistas
WHERE 
    PersonalAgendaEspecialista_ID = '".$_SESSION['Especialista_ID']."'";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

// Ajusta el valor de estatus según tu lógica de especialistas
if(strtolower($row['Estatus'])=="vigente" ){				

} 
else {
    header("Location:Stop");
    exit();
}
?>