
<?php
// Archivo para validar la existencia del NumOrden en la base de datos

// Verifica si se recibió el valor del NumOrden
if (isset($_POST['NumOrden'])) {
    $numOrden = $_POST['NumOrden'];

    // Realiza la conexión a la base de datos (ajusta los parámetros según tu configuración)
    $mysqli = new mysqli('localhost', 'somosgr1_SHWEB', 'yH.0a-v?T*1R', 'somosgr1_Sistema_Hospitalario');

    // Verifica la conexión
    if ($mysqli->connect_error) {
        die('Error en la conexión a la base de datos: ' . $mysqli->connect_error);
    }

    
    $numOrden = $mysqli->real_escape_string($numOrden);

    // Consulta SQL para obtener el valor más reciente en función de la fecha de creación
    $consulta = "SELECT Num_Orden FROM Traspasos_generados ORDER BY ID_Traspaso_Generado DESC LIMIT 1";

    // Ejecuta la consulta
    $resultado = $mysqli->query($consulta);

    // Verifica si hubo un error en la consulta
    if (!$resultado) {
        die('Error en la consulta: ' . $mysqli->error);
    }

    // Obtiene el resultado de la consulta como un array asociativo
    $fila = $resultado->fetch_assoc();
 // Imprime los valores para depuración
 echo "Valor obtenido de la base de datos: " . $fila['Num_Orden'] . "<br>";
 echo "Valor enviado desde el formulario: " . $numOrden . "<br>";

 // Ajusta el valor obtenido de la base de datos a la longitud del valor enviado desde el formulario
 $valorBaseDatosAjustado = str_pad($fila['Num_Orden'], strlen($numOrden), '0', STR_PAD_LEFT);

 // Devuelve la respuesta al script JavaScript
 if ($valorBaseDatosAjustado === $numOrden) {
     // El NumOrden ya existe
     echo 'existe';
 } else {
     // El NumOrden no existe
     echo 'no_existe';
 }
} else {
 // Si no se recibió el valor del NumOrden
 echo 'error_parametros';
}
?>

