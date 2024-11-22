<?php
include_once 'db_connection.php';

if (!empty($_POST['Problematica']) && !empty($_POST['DescripcionProblematica'])) {
    // Validación y sanitización de datos
    $tipoProblema = mysqli_real_escape_string($conn, $_POST['Problematica']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['DescripcionProblematica']);
    $fecha = mysqli_real_escape_string($conn, $_POST['Fecha']);
    $reportadoPor = mysqli_real_escape_string($conn, $_POST['Agregado_Por']);
    $sucursal = mysqli_real_escape_string($conn, $_POST['Sucursal']);
    $id_h_o_d = mysqli_real_escape_string($conn, $_POST['ID_H_O_D']);
    
    // Definir estatus inicial
    $estatus = "Pendiente";

    // Generar un número de ticket único
    $noTicket = "TS-" . strtoupper(uniqid());

    // Preparar la consulta para el ticket
    $query = "INSERT INTO Tickets_Soporte 
        (No_Ticket, Sucursal, Reportado_Por, Fecha_Registro, Problematica, DescripcionProblematica, Estatus, Agregado_Por, ID_H_O_D) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $noTicket, $sucursal, $reportadoPor, $fecha, $tipoProblema, $descripcion, $estatus, $reportadoPor, $id_h_o_d);

        if (mysqli_stmt_execute($stmt)) {
            // Obtener el ID del ticket recién creado
            $ticketId = mysqli_insert_id($conn);

            // Manejar la subida de imágenes
            if (!empty($_FILES['imagenes']['name'][0])) {
                $uploadedFiles = [];
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/ImagenesTickets/"; // Ruta de la carpeta para las imágenes

                foreach ($_FILES['imagenes']['name'] as $key => $fileName) {
                    $fileTmpPath = $_FILES['imagenes']['tmp_name'][$key];
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newFileName = time() . '-' . uniqid() . '.' . $fileExtension;

                    // Validar tipos de archivo
                    $validExtensions = ['jpeg', 'jpg', 'png'];
                    if (in_array($fileExtension, $validExtensions) && 
                        in_array($_FILES['imagenes']['type'][$key], ['image/jpeg', 'image/jpg', 'image/png'])) {

                        // Subir el archivo
                        $targetPath = $uploadDir . $newFileName;
                        if (move_uploaded_file($fileTmpPath, $targetPath)) {
                            $uploadedFiles[] = $newFileName;

                            // Guardar el nombre de la imagen en la base de datos
                            $queryImg = "INSERT INTO Tickets_Imagenes (Ticket_Id, Imagen) VALUES (?, ?)";
                            if ($stmtImg = mysqli_prepare($conn, $queryImg)) {
                                mysqli_stmt_bind_param($stmtImg, "is", $ticketId, $newFileName);
                                mysqli_stmt_execute($stmtImg);
                                mysqli_stmt_close($stmtImg);
                            }
                        }
                    }
                }

                // Verificar si no se subió ninguna imagen
                if (empty($uploadedFiles)) {
                    $response = array("statusCode" => 202, "message" => "Error al subir las imágenes.");
                    echo json_encode($response);
                    exit;
                }
            }

            // Respuesta de éxito
            $response = array("statusCode" => 200, "message" => "Ticket creado exitosamente.");
        } else {
            // Respuesta de error al ejecutar la consulta del ticket
            $response = array("statusCode" => 201, "message" => "Error: " . mysqli_stmt_error($stmt));
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        // Respuesta de error al preparar la consulta del ticket
        $response = array("statusCode" => 201, "message" => "Error: " . mysqli_error($conn));
    }
} else {
    // Respuesta en caso de campos faltantes
    $response = array("statusCode" => 400, "message" => "Todos los campos son obligatorios.");
}

// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Enviar la respuesta en formato JSON
echo json_encode($response);

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
