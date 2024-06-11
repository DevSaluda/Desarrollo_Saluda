<?php
include_once 'db_connection.php';

// Obtener y sanitizar los datos del formulario
$Nom_Tipo =  $conn->real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['NombreTipoConsulta']))))));
$Estado =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['VigenciaTipoConsulta']))));
$Agregado_Por =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['UsuarioTipoConsulta']))));
$Sistema =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['SistemaTipoConsulta']))));
$ID_H_O_D =  $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['EmpresaTipoConsulta']))));

// Verificar si ya existe el tipo de consulta
$sql = "SELECT Nom_Tipo, ID_H_O_D FROM Tipos_Consultas WHERE Nom_Tipo='$Nom_Tipo' AND ID_H_O_D='$ID_H_O_D'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

if($row['Nom_Tipo'] == $Nom_Tipo AND $row['ID_H_O_D'] == $ID_H_O_D) {				
    echo json_encode(array("statusCode" => 250));
} else {
    // Insertar el nuevo tipo de consulta en la base de datos
    $sql = "INSERT INTO `Tipos_Consultas`(`Nom_Tipo`, `Estado`, `Agregado_Por`, `Sistema`, `ID_H_O_D`, `Agregadoel`) 
            VALUES ('$Nom_Tipo', '$Estado', '$Agregado_Por', '$Sistema', '$ID_H_O_D', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
?>
