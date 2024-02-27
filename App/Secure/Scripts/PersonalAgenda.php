<?php
session_start();
include_once("../db_connect.php");

if(isset($_POST['login_button'])) {
    $correo_electronico = trim($_POST['user_email']);
    $password = trim($_POST['password']);
    
    // Preparar la consulta SQL
    $sql ="SELECT Personal_Agenda.PersonalAgenda_ID, Personal_Agenda.Correo_Electronico, Personal_Agenda.Password, Personal_Agenda.Estatus, Personal_Agenda.Fk_Usuario, Roles_Puestos.ID_rol, Roles_Puestos.Nombre_rol
    FROM Personal_Agenda
    INNER JOIN Roles_Puestos ON Personal_Agenda.Fk_Usuario = Roles_Puestos.ID_rol
    WHERE Correo_electronico = ?";

    // Preparar la declaración
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $correo_electronico);
    mysqli_stmt_execute($stmt);
    $resultset = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultset)) {
        // Verificar la contraseña y el estatus
        if(password_verify($password, $row['Password']) && $row['Estatus'] == "Vigente") {
            switch($row['Nombre_rol']) {
                case "ADM agenda":
                    $_SESSION['AdminAgenda'] = $row['PersonalAgenda_ID'];
                    echo "ok";
                    break;
                case "Call Center":
                    $_SESSION['AgendaCallCenter'] = $row['PersonalAgenda_ID'];
                    echo "ok";
                    break;
                default:
                    echo "Rol no reconocido";
                    break;
            }
        } else {
            echo "Contraseña incorrecta o cuenta no vigente";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado";
    }
    
    // Cerrar la declaración
    mysqli_stmt_close($stmt);
}
?>
