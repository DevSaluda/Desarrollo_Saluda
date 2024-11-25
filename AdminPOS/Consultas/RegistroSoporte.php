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
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/TicketsSoporte/" . $fileName;

            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedFiles[] = $fileName;
            } else {
                $response = array("statusCode" => 202, "message" => "Error al mover el archivo: $targetPath");
                echo json_encode($response);
                exit;
            }
        }
    }

    if (!empty($uploadedFiles)) {
        $fileNames = implode('|', $uploadedFiles);

        // Inserta la información en la base de datos
        $tipoProblema = $_POST['tipoProblema'];
        $descripcion = $_POST['DescripcionProblematica'];
        $fecha = $_POST['Fecha'];
        $registro = $_POST['Registro'];
        $sucursal = $_POST['Sucursal'];
        $empresa = $_POST['Empresa'];

        $query =  "INSERT INTO TicketsSoporte 
        (Tipo_Problema, Descripcion, Fecha_Registro, Sucursal, Registro, AgregadoEl, ID_H_O_D) 
        VALUES ('$tipoProblema', '$descripcion', '$fecha', '$sucursal', '$registro', NOW(), '$empresa')";
        
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
