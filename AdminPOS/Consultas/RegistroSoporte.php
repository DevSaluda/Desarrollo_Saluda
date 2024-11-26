<?php
include_once 'db_connection.php';
header('Content-Type: application/json');

$response = ["statusCode" => 500, "message" => "Error desconocido"]; // Valor predeterminado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['tipoProblema']) && !empty($_POST['DescripcionProblematica'])) {
        $uploadedFiles = [];

        if (!empty($_FILES['file']['name'][0])) {
            foreach ($_FILES['file']['name'] as $key => $val) {
                $fileName = time() . '_' . $_FILES['file']['name'][$key];
                $valid_extensions = ["jpeg", "jpg", "png"];
                $file_extension = pathinfo($fileName, PATHINFO_EXTENSION);

                if (
                    in_array($file_extension, $valid_extensions) &&
                    ($_FILES['file']['size'][$key] <= 5 * 1024 * 1024) // Máximo 5 MB
                ) {
                    $sourcePath = $_FILES['file']['tmp_name'][$key];
                    $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/TicketsSoporte/" . $fileName;

                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $uploadedFiles[] = $fileName;
                    } else {
                        $response = ["statusCode" => 202, "message" => "Error al mover el archivo: $fileName"];
                        echo json_encode($response);
                        exit;
                    }
                }
            }
        }

        // Inserción en la base de datos
        $tipoProblema = mysqli_real_escape_string($conn, $_POST['tipoProblema']);
        $descripcion = mysqli_real_escape_string($conn, $_POST['DescripcionProblematica']);
        $fecha = mysqli_real_escape_string($conn, $_POST['Fecha']);
        $registro = mysqli_real_escape_string($conn, $_POST['Agregado_Por']);
        $sucursal = mysqli_real_escape_string($conn, $_POST['Sucursal']);
        $empresa = mysqli_real_escape_string($conn, $_POST['Empresa']);

        $query = "INSERT INTO TicketsSoporte 
            (Tipo_Problema, Descripcion, Fecha_Registro, Sucursal, Registro, AgregadoEl, ID_H_O_D) 
            VALUES ('$tipoProblema', '$descripcion', '$fecha', '$sucursal', '$registro', NOW(), '$empresa')";

        if (mysqli_query($conn, $query)) {
            $response = ["statusCode" => 200, "message" => "Ticket registrado correctamente"];
        } else {
            $response = ["statusCode" => 201, "message" => "Error al guardar en la base de datos"];
        }
    } else {
        $response = ["statusCode" => 400, "message" => "Campos requeridos incompletos"];
    }
} else {
    $response = ["statusCode" => 405, "message" => "Método no permitido"];
}

echo json_encode($response);
?>
