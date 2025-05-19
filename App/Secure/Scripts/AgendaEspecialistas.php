<?php
session_start();
include_once("../db_connect.php");
if(isset($_POST['login_button'])) {
    $Correo_Electronico = trim($_POST['user_email']);
    $Password = trim($_POST['password']);
    $sql = "SELECT PersonalAgendaEspecialista_ID, Nombre_Apellidos, Password, Correo_Electronico, ID_H_O_D, Fk_Usuario, file_name FROM IngresoAgendaEspecialistas WHERE Correo_Electronico='$Correo_Electronico' AND Estatus = 1 LIMIT 1";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $row = mysqli_fetch_assoc($resultset);
    if($row && $row['Password'] == $Password){
        echo "ok";
        $_SESSION['Especialista_ID'] = $row['PersonalAgendaEspecialista_ID'];
        $_SESSION['Nombre_Apellidos'] = $row['Nombre_Apellidos'];
        $_SESSION['AgendaEspecialista'] = $row['PersonalAgendaEspecialista_ID'];
    }
    // Si no coincide, no imprime nada (puedes poner un mensaje si lo deseas)
}
?>
