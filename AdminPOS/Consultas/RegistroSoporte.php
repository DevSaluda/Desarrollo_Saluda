<?php
include_once 'db_connection.php';

if (!empty($_POST['Problematica']) && !empty($_POST['DescripcionProblematica'])) {
    $tipoProblema = mysqli_real_escape_string($conn, $_POST['Problematica']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['DescripcionProblematica']);
    $fecha = mysqli_real_escape_string($conn, $_POST['Fecha']);
    $reportadoPor = mysqli_real_escape_string($conn, $_POST['Agregado_Por']);
    $sucursal = mysqli_real_escape_string($conn, $_POST['Sucursal']);
    $id_h_o_d = mysqli_real_escape_string($conn, $_POST['ID_H_O_D']);

    $estatus = "Pendiente";
    $noTicket = "TS-" . strtoupper(uniqid());

    // Preparar consulta principal
    $query = "INSERT INTO Tickets_Soporte 
        (No_Ticket, Sucursal, Reportado_Por, Fecha_Registro, Problematica, DescripcionProblematica, Estatus, Agregado_Por, ID_H_O_D) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $noTicket, $sucursal, $reportadoPor, $fecha, $tipoProblema, $descripcion, $estatus, $reportadoPor, $id_h_o_d);

        if (mysqli_stmt_execute($stmt)) {
            $ticketId = mysqli_insert_id($conn);

            if (!empty($_FILES['imagenes']['name'][0])) {
                $uploadedFiles = [];
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/ImagenesTickets/";

                foreach ($_FILES['imagenes']['name'] as $key => $fileName) {
                    $fileTmpPath = $_FILES['imagenes']['tmp_name'][$key];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = time() . '-' . uniqid() . '.' . $fileExtension;

                    $validExtensions = ['jpeg', 'jpg', 'png'];

                    if (in_array($fileExtension, $validExtensions)) {
                        $targetPath = $uploadDir . $newFileName;

                        if (move_uploaded_file($fileTmpPath, $targetPath)) {
                            $uploadedFiles[] = $newFileName;

                            $queryImg = "INSERT INTO Tickets_Imagenes (Ticket_Id, Imagen) VALUES (?, ?)";
                            if ($stmtImg = mysqli_prepare($conn, $queryImg)) {
                                mysqli_stmt_bind_param($stmtImg, "is", $ticketId, $newFileName);
                                mysqli_stmt_execute($stmtImg);
                                mysqli_stmt_close($stmtImg);
                            }
                        } else {
                            error_log("Error al mover el archivo $fileTmpPath a $targetPath");
                        }
                    } else {
                        error_log("Extensión no permitida para $fileName");
                    }
                }

                if (empty($uploadedFiles)) {
                    $response = array("statusCode" => 202, "message" => "No se pudo subir ninguna imagen.");
                    echo json_encode($response);
                    exit;
                }
            }

            $response = array("statusCode" => 200, "message" => "Ticket creado exitosamente.");
        } else {
            $response = array("statusCode" => 201, "message" => "Error al crear el ticket: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
    } else {
        $response = array("statusCode" => 201, "message" => "Error al preparar la consulta: " . mysqli_error($conn));
    }
} else {
    $response = array("statusCode" => 400, "message" => "Todos los campos son obligatorios.");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo json_encode($response);
mysqli_close($conn);
?>
