<?php
include_once 'db_connection.php';

if (!empty($_POST['Problematica']) && !empty($_POST['DescripcionProblematica'])) {
    $tipoProblema = $conn->real_escape_string(trim($_POST['Problematica']));
    $descripcion = $conn->real_escape_string(trim($_POST['DescripcionProblematica']));
    $fecha = $conn->real_escape_string(trim($_POST['Fecha']));
    $reportadoPor = $conn->real_escape_string(trim($_POST['Agregado_Por']));
    $sucursal = $conn->real_escape_string(trim($_POST['Sucursal']));
    $id_h_o_d = $conn->real_escape_string(trim($_POST['ID_H_O_D']));

    $estatus = "Pendiente";
    $noTicket = "TS-" . strtoupper(uniqid());

    // Subir imágenes primero
    $uploadedFiles = [];
    if (!empty($_FILES['imagenes']['name'][0])) {
        $uploadDir = "../../ImagenesTickets/";

        // Crear directorio si no existe
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
            echo json_encode(["statusCode" => 500, "message" => "Error al crear el directorio de imágenes."]);
            exit;
        }

        // Procesar cada archivo subido
        foreach ($_FILES['imagenes']['name'] as $key => $fileName) {
            $fileTmpPath = $_FILES['imagenes']['tmp_name'][$key];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = time() . '-' . uniqid() . '.' . $fileExtension;
            $validExtensions = ['jpeg', 'jpg', 'png'];

            if (in_array($fileExtension, $validExtensions)) {
                $targetPath = $uploadDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $targetPath)) {
                    $uploadedFiles[] = $newFileName;
                } else {
                    error_log("Error al mover el archivo $fileTmpPath a $targetPath");
                }
            } else {
                error_log("Extensión no permitida para $fileName");
            }
        }
    }

    if (empty($uploadedFiles) && !empty($_FILES['imagenes']['name'][0])) {
        echo json_encode(["statusCode" => 202, "message" => "No se pudo subir ninguna imagen."]);
        exit;
    }

    // Insertar datos del ticket en la base de datos
    $query = "INSERT INTO Tickets_Soporte 
        (No_Ticket, Sucursal, Reportado_Por, Fecha_Registro, Problematica, DescripcionProblematica, Estatus, Agregado_Por, ID_H_O_D) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssssssss", $noTicket, $sucursal, $reportadoPor, $fecha, $tipoProblema, $descripcion, $estatus, $reportadoPor, $id_h_o_d);

        if ($stmt->execute()) {
            $ticketId = $conn->insert_id;

            // Registrar imágenes subidas en la base de datos
            foreach ($uploadedFiles as $fileName) {
                $queryImg = "INSERT INTO Tickets_Imagenes (Ticket_Id, Imagen) VALUES (?, ?)";
                if ($stmtImg = $conn->prepare($queryImg)) {
                    $stmtImg->bind_param("is", $ticketId, $fileName);
                    if (!$stmtImg->execute()) {
                        error_log("Error al insertar imagen: " . $stmtImg->error);
                    }
                    $stmtImg->close();
                } else {
                    error_log("Error al preparar la consulta de imagen: " . $conn->error);
                }
            }

            echo json_encode(["statusCode" => 200, "message" => "Ticket creado exitosamente."]);
        } else {
            echo json_encode(["statusCode" => 201, "message" => "Error al crear el ticket: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["statusCode" => 201, "message" => "Error al preparar la consulta: " . $conn->error]);
    }
} else {
    echo json_encode(["statusCode" => 400, "message" => "Todos los campos son obligatorios."]);
}

mysqli_close($conn);
?>
