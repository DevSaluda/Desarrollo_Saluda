<?php
date_default_timezone_set("America/Monterrey");
if (session_status() == PHP_SESSION_NONE) {
   session_start();
 }
 
if(!isset($_SESSION['AgendaEspecialista'])){
    header("Location: Expiro");
    exit();
}

include_once("db_connection.php");

$id_medico = $_SESSION['AgendaEspecialista'];

$sql = "SELECT Personal_Medico_Express.Medico_ID, Personal_Medico_Express.Nombre_Apellidos, Personal_Medico_Express.file_name, 
               Personal_Medico_Express.Estatus, Personal_Medico_Express.Fk_Usuario, Roles_Puestos.ID_rol, Roles_Puestos.Nombre_rol 
        FROM Personal_Medico_Express
        LEFT JOIN Roles_Puestos ON Personal_Medico_Express.Fk_Usuario = Roles_Puestos.ID_rol
        WHERE Medico_ID='$id_medico'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

if($row && ($row['Estatus']=="1" || strtolower($row['Estatus'])=="vigente")){
    // Acceso permitido
    $_SESSION['Nombre_Medico'] = $row['Nombre_Apellidos']; // Para el filtro de citas y sidebar
} 
else {
    header("Location:Stop");
    exit();
}
?>

