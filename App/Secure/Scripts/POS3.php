<?php
session_start();
include_once("../db_connect.php");

if (isset($_POST['login_button'])) {

    $Correo_electronico = trim($_POST['user_email']);
    $Password = trim($_POST['password']);

    $sql = "SELECT PersonalPOS.Pos_ID, PersonalPOS.Correo_Electronico, PersonalPOS.Password, PersonalPOS.Estatus,
            PersonalPOS.Fk_Usuario, Roles_Puestos.ID_rol, Roles_Puestos.Nombre_rol 
            FROM PersonalPOS, Roles_Puestos
            WHERE PersonalPOS.Fk_Usuario = Roles_Puestos.ID_rol AND Correo_electronico = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Correo_electronico);
    mysqli_stmt_execute($stmt);

    $resultset = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultset)) {
        if ($row['Password'] == $Password && $row['Estatus'] == "Vigente") {
            switch ($row['Nombre_rol']) {
                case "Administrador":
                    $_SESSION['AdminPOS'] = $row['Pos_ID'];
                    break;
                case "Ventas":
                    $_SESSION['VentasPos'] = $row['Pos_ID'];
                    break;
                case "ADM Punto de venta":
                    $_SESSION['SuperAdmin'] = $row['Pos_ID'];
                    break;
                case "Logística y compras":
                    $_SESSION['LogisticaPOS'] = $row['Pos_ID'];
                    break;
                case "Administrador CEDIS":
                    $_SESSION['ResponsableCedis'] = $row['Pos_ID'];
                    break;
                case "Encargado de inventarios":
                    $_SESSION['ResponsableInventarios'] = $row['Pos_ID'];
                    break;
                case "Responsable de farmacias":
                    $_SESSION['ResponsableDeFarmacias'] = $row['Pos_ID'];
                    break;
                case "Jefe de odontología":
                    $_SESSION['CoordinadorDental'] = $row['Pos_ID'];
                    break;
                case "Supervisor":
                    $_SESSION['Supervisor'] = $row['Pos_ID'];
                    break;
                case "Jefatura de enfermeria":
                    $_SESSION['JefeEnfermeros'] = $row['Pos_ID'];
                    break;
                default:

             
                    // Manejar el caso donde el rol no coincide con ninguno de los anteriores
                    break;
            }

            echo "ok";
        } else {
            echo "La contraseña o el estado del usuario no son válidos.";
        }
    } else {
        echo "El usuario no existe.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
