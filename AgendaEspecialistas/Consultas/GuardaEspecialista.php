<?php

include_once 'db_connection.php';
$EstatusVigencia = "Disponible";

// Sanitizar y escapar datos de entrada
$Nombre_Apellidos = $conn->real_escape_string(htmlentities(strip_tags(trim(ucwords(strtolower($_POST['NombreApellidos']))))));
$Correo_Electronico = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Correo']))));
$Telefono = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Telefono']))));
$Especialidad_Express = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['EspecialidadSuc']))));
$ID_H_O_D = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Empresa']))));
$Estatus = $conn->real_escape_string(htmlentities(strip_tags(trim($EstatusVigencia))));
$AgregadoPor = $conn->real_escape_string(htmlentities(strip_tags(trim($_POST['Usuario']))));

// Consulta para verificar si ya existe el registro
$sql = "SELECT Nombre_Apellidos, Correo_Electronico, Especialidad_Express, Telefono 
        FROM Personal_Medico_Express 
        WHERE Nombre_Apellidos = '$Nombre_Apellidos' 
          AND Especialidad_Express = '$Especialidad_Express' 
          AND Correo_Electronico = '$Correo_Electronico' 
          AND Telefono = '$Telefono'";
$resultset = mysqli_query($conn, $sql) or die("database error: " . mysqli_error($conn));
$row = mysqli_fetch_assoc($resultset);

// Verificar si la consulta devolvió resultados
if ($row) {
    // Verifica si los datos coinciden
    if ($row['Nombre_Apellidos'] == $Nombre_Apellidos && 
        $row['Especialidad_Express'] == $Especialidad_Express && 
        $row['Correo_Electronico'] == $Correo_Electronico && 
        $row['Telefono'] == $Telefono) {
        echo json_encode(array("statusCode" => 250)); // Registro ya existe
    } else {
        // Si no existe, insertar nuevo registro
        $sql = "INSERT INTO Personal_Medico_Express (Nombre_Apellidos, Correo_Electronico, Telefono, Especialidad_Express, ID_H_O_D, Estatus, AgregadoPor) 
                VALUES ('$Nombre_Apellidos', '$Correo_Electronico', '$Telefono', '$Especialidad_Express', '$ID_H_O_D', '$Estatus', '$AgregadoPor')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode" => 200)); // Inserción exitosa
        } else {
            echo json_encode(array("statusCode" => 201)); // Error al insertar
        }
    }
} else {
    // Si no hay resultados, insertar nuevo registro
    $sql = "INSERT INTO Personal_Medico_Express (Nombre_Apellidos, Correo_Electronico, Telefono, Especialidad_Express, ID_H_O_D, Estatus, AgregadoPor) 
            VALUES ('$Nombre_Apellidos', '$Correo_Electronico', '$Telefono', '$Especialidad_Express', '$ID_H_O_D', '$Estatus', '$AgregadoPor')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200)); // Inserción exitosa
    } else {
        echo json_encode(array("statusCode" => 201)); // Error al insertar
    }
}

mysqli_close($conn);

?>
