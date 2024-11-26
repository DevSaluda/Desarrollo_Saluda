<?php
include_once 'db_connection.php';

if (!empty($_POST['name']) || !empty($_FILES['file']['name'])) {
    $uploadedFiles = [];
    $ticketId = null;

    // Inserta el registro principal en la tabla `TicketsSoporte`
    $tipoProblema = $_POST['tipoProblema'];
    $descripcion = $_POST['DescripcionProblematica'];
    $fecha = $_POST['Fecha'];
    $registro = $_POST['Registro'];
    $sucursal = $_POST['Sucursal'];
    $empresa = $_POST['Empresa'];

    $queryTicket = "INSERT INTO TicketsSoporte 
    (Tipo_Problema, Descripcion, Fecha_Registro, Sucursal, Registro, AgregadoEl, ID_H_O_D) 
    VALUES ('$tipoProblema', '$descripcion', '$fecha', '$sucursal', '$registro', NOW(), '$empresa')";

    if (mysqli_query($conn, $queryTicket)) {
        // Obtén el ID del ticket recién creado
        $ticketId = mysqli_insert_id($conn);
    } else {
        $response = array("statusCode" => 201, "message" => "Error al registrar el ticket principal");
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    // Procesa las imágenes y guárdalas en la tabla `Tickets_Imagenes`
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
                $imagePath = "/TicketsSoporte/" . $fileName;
                $uploadedFiles[] = $imagePath;

                // Inserta cada imagen en la tabla `Tickets_Imagenes`
                $queryImage = "INSERT INTO Tickets_Imagenes 
                (Ticket_Id, Imagen, Fecha_Subida) 
                VALUES ('$ticketId', '$imagePath', NOW())";

                if (!mysqli_query($conn, $queryImage)) {
                    $response = array("statusCode" => 202, "message" => "Error al registrar la imagen: $imagePath");
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response = array("statusCode" => 202, "message" => "Error al mover el archivo: $targetPath");
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }
    }

    if (!empty($uploadedFiles)) {
        $response = array("statusCode" => 200, "message" => "Ticket y imágenes registrados exitosamente");
    } else {
        $response = array("statusCode" => 201, "message" => "No se subieron imágenes, pero el ticket se registró");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
