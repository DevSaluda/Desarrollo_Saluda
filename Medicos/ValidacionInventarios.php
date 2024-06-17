<?php
spl_autoload_register(function ($class) {
    $classPath = str_replace("\\", "/", $class);
    require 'https://controlfarmacia.com/AdminPOS/PhpSpreadsheet/src/' . $classPath . '.php';
});

use PhpSpreadsheet\IOFactory;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviado un archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        // Obtener información del archivo
        $nombreArchivo = $_FILES['archivo']['name'];
        $tipoArchivo = $_FILES['archivo']['type'];
        $rutaTemporal = $_FILES['archivo']['tmp_name'];

        // Mover el archivo a una ubicación permanente
        $rutaDestino = 'uploads/' . $nombreArchivo;
        move_uploaded_file($rutaTemporal, $rutaDestino);

        // Procesar el archivo Excel y actualizar la base de datos
        $spreadsheet = IOFactory::load($rutaDestino);
        $hoja = $spreadsheet->getActiveSheet();

        // Conectar a la base de datos
        $conexion = new mysqli("localhost", "somosgr1_SHWEB", "yH.0a-v?T*1R", "somosgr1_Sistema_Hospitalario");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Recorrer las filas y actualizar la base de datos
        foreach ($hoja->getRowIterator() as $fila) {
            $datosFila = $hoja->rangeToArray('A' . $fila->getRowIndex() . ':C' . $fila->getRowIndex(), null, true, false)[0];

            // Procesar e insertar datos en la base de datos (ajusta según tu esquema de base de datos)
            $Cod_Barra = $conexion->real_escape_string($datosFila[0]);
            $Nombre_prod = $conexion->real_escape_string($datosFila[1]);
            $Cantidad = $conexion->real_escape_string($datosFila[2]);

            $sql = "INSERT INTO Inserciones_Excel_inventarios (Cod_Barra, Nombre_prod, Cantidad) VALUES ('$Cod_Barra', '$Nombre_prod', '$Cantidad')";

            if ($conexion->query($sql) !== TRUE) {
                echo "Error al insertar el registro: " . $conexion->error;
            }
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Redirigir o mostrar un mensaje de éxito
        header("Location: formulario.php?mensaje=Archivo subido y procesado exitosamente");
        exit();
    } else {
        echo "Error al subir el archivo.";
    }
}
?>
