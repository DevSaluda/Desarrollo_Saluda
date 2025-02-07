<?php
include_once "db_connection.php";
include_once "Consultas.php";

// Obtener el código de barras enviado por AJAX
$codigo = $_POST['codigoEscaneado'];

// Consultar la base de datos para obtener el artículo correspondiente al código de barras
$sql = "SELECT Cod_Barra, Fecha_Caducidad, 
               GROUP_CONCAT(ID_Prod_POS) AS IDs, 
               GROUP_CONCAT(Nombre_Prod) AS descripciones, 
               GROUP_CONCAT(Precio_Venta) AS precios, 
               GROUP_CONCAT(Lote SEPARATOR ', ') AS lotes,
               GROUP_CONCAT(Clave_adicional) AS claves, 
               GROUP_CONCAT(Tipo_Servicio) AS tipos, 
               GROUP_CONCAT(Existencias_R) AS stockactual,
               GROUP_CONCAT(Precio_C) AS precioscompra
        FROM Stock_POS
        WHERE Cod_Barra = ? 
        AND Lote IS NOT NULL 
        AND Lote <> ''
        GROUP BY Cod_Barra;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si se encontró el artículo, obtener los valores concatenados
    $row = $result->fetch_assoc();
    $ids = explode(',', $row['IDs']);
    $descripciones = explode(',', $row['descripciones']);
    $precios = explode(',', $row['precios']);
    $precioscompra = explode(',', $row['precioscompra']);
    $fechacaducidad = explode(',', $row['Fecha_Caducidad']);
    $lotesArray = explode(',', $row['lotes']);
    $claves = explode(',', $row['claves']);
    $tipos = explode(',', $row['tipos']);
    
    // Tomar el primer lote válido
    $lote = '';
    foreach ($lotesArray as $l) {
        if (!empty(trim($l))) {
            $lote = trim($l);
            break; // Tomar el primer lote válido
        }
    }
    
    // Armar la respuesta
    $data = array(
        "id" => $ids[0],
        "codigo" => $row["Cod_Barra"],
        "descripcion" => $descripciones[0],
        "cantidad" => 1,
        "existencia" => $fechacaducidad[0],
        "precio" => $precios[0],
        "preciocompra" => $precioscompra[0],
        "lote" => $lote,
        "lotes" => $lotesArray, // Enviar todos los lotes en la respuesta
        "fechacaducidades" => $fechacaducidad,
        "clave" => $claves[0],
        "tipo" => $tipos[0],
        "eliminar" => ""
    );

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Si no se encontró el artículo, devolver un array vacío en formato JSON
    $data = array();
    header('Content-Type: application/json');
    echo json_encode($data);
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>
