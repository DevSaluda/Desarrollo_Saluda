<?php
include_once 'db_connection.php';

if (!empty($_POST['name']) || !empty($_FILES['file']['name'])) {
    $uploadedFiles = [];

    foreach ($_FILES['file']['name'] as $key => $val) {
        $fileName = time() . '_' . $_FILES['file']['name'][$key];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"][$key]);
        $file_extension = end($temporary);

        if (
            (
                ($_FILES["file"]["type"][$key] == "image/png") ||
                ($_FILES["file"]["type"][$key] == "image/jpg") ||
                ($_FILES["file"]["type"][$key] == "image/jpeg")
            ) && in_array($file_extension, $valid_extensions)
        ) {
            $sourcePath = $_FILES['file']['tmp_name'][$key];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/RegistroMantenimiento/" . $fileName;

            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedFiles[] = $fileName; // Guarda solo el nombre del archivo
            } else {
                $response = array("statusCode" => 202, "message" => "Error al mover el archivo: $targetPath");
                echo json_encode($response);
                exit;
            }
        }
    }

    if (!empty($uploadedFiles)) {
        $fileNames = implode('|', $uploadedFiles); // Combina los nombres de los archivos usando un carácter especial

        // Inserta la información en la base de datos
        $comentario = $_POST['Comentario'];
        $fecha = $_POST['Fecha'];
        $registro = $_POST['Registro'];
        $sucursal = $_POST['Sucursal'];
        $empresa = $_POST['Empresa'];

        $query =  "INSERT INTO Registros_antenimiento 
        (Registro_mantenimiento, Fecha_registro, Sucursal, Comentario, Registro, Agregadoel, ID_H_O_D, file_name) 
        VALUES ('$tipoEquipo', '$fecha', '$sucursal', '$comentario', '$registro', NOW(), '$empresa', '$fileNames')";
        
        if (mysqli_query($conn, $query)) {
            $response = array("statusCode" => 200);
        } else {
            $response = array("statusCode" => 201);
        }
    } else {
        $response = array("statusCode" => 201);
    }
    echo json_encode($response);
}
?>
