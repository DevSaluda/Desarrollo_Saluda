<?php
// Permitir solicitudes CORS desde otro dominio
header("Access-Control-Allow-Origin: https://saluda.mx");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si el método es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Guardar imagen en la carpeta
    $target_dir = "/path/to/your/directory/FotografiasCredenciales/";  // Ajusta esta ruta en tu servidor
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;

    // Comprobar si el archivo es una imagen
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(["success" => false, "message" => "El archivo no es una imagen."]);
        $uploadOk = 0;
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        echo json_encode(["success" => false, "message" => "El archivo ya existe."]);
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo (máximo 5MB)
    if ($_FILES["foto"]["size"] > 5000000) {
        echo json_encode(["success" => false, "message" => "El archivo es demasiado grande."]);
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos de imagen
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo json_encode(["success" => false, "message" => "Solo se permiten archivos JPG, JPEG y PNG."]);
        $uploadOk = 0;
    }

    // Si no hubo errores, subir el archivo
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            // Guardar datos en la base de datos
            $nombre = $_POST['nombre'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $escuela = $_POST['escuela'];
            $matricula = $_POST['matricula'];

            // Conectar a la base de datos (debes configurar los datos de tu base)
            $conn = new mysqli("localhost", "u155356178_SaludDevCenter", "uE;bAISz;*6c|I4PvEnfSys324\Zavp2zJ:9TLx{]L&QMcmhAdmSCDBSN3iH4UV3D24WMF@2024myV>", "u155356178_saludapos");

            if ($conn->connect_error) {
                die(json_encode(["success" => false, "message" => "Conexión fallida a la base de datos."]));
            }

            // Insertar los datos en la base de datos
            $sql = "INSERT INTO registro (nombre, fecha_nacimiento, correo, telefono, escuela, matricula, foto)
                    VALUES ('$nombre', '$fecha_nacimiento', '$correo', '$telefono', '$escuela', '$matricula', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["success" => true, "message" => "Datos guardados con éxito."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al guardar los datos."]);
            }

            $conn->close();

        } else {
            echo json_encode(["success" => false, "message" => "Hubo un error al subir el archivo."]);
        }
    }

} else {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
}
?>
