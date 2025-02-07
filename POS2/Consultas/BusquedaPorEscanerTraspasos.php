<?php
include_once "db_connection.php";
include_once "Consultas.php";

// Obtener el código de barras enviado por AJAX
$codigo = $_POST['codigoEscaneado'];

// Consulta original con GROUP_CONCAT para agrupar los registros
$sql = "SELECT Cod_Barra, Fecha_Caducidad, 
               GROUP_CONCAT(ID_Prod_POS) AS IDs, 
               GROUP_CONCAT(Nombre_Prod) AS descripciones, 
               GROUP_CONCAT(Precio_Venta) AS precios, 
               GROUP_CONCAT(Lote) AS lotes,
               GROUP_CONCAT(Clave_adicional) AS claves, 
               GROUP_CONCAT(Tipo_Servicio) AS tipos, 
               GROUP_CONCAT(Existencias_R) AS stockactual, 
               GROUP_CONCAT(Precio_C) AS precioscompra
        FROM Stock_POS
        WHERE Cod_Barra = ?
        GROUP BY Cod_Barra;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Convertir las cadenas concatenadas en arreglos
    $ids             = explode(',', $row['IDs']);
    $descripciones   = explode(',', $row['descripciones']);
    $precios         = explode(',', $row['precios']);
    $precioscompra   = explode(',', $row['precioscompra']);
    $fechacaducidad  = explode(',', $row['Fecha_Caducidad']);
    $lotes           = explode(',', $row['lotes']);
    $claves          = explode(',', $row['claves']);
    $tipos           = explode(',', $row['tipos']);
    
    // Si solo hay un lote, lo asignamos directamente; de lo contrario dejamos "lote" vacío para que se seleccione en el modal.
    $loteSeleccionado = (count($lotes) == 1 ? $lotes[0] : "");
    
    // Armar el array de respuesta. Además, incluimos el arreglo completo de lotes y fechas de caducidad para la selección.
    $data = array(
        "id"               => $ids[0],
        "codigo"           => $row["Cod_Barra"],
        "descripcion"      => $descripciones[0],
        "cantidad"         => 1,
        "existencia"       => $fechacaducidad[0],
        "precio"           => $precios[0],
        "preciocompra"     => $precioscompra[0],
        "lote"             => $loteSeleccionado,  // Asignado solo si hay un lote
        "lotes"            => $lotes,             // Arreglo de todos los lotes
        "fechacaducidades" => $fechacaducidad,    // Arreglo de fechas de caducidad correspondientes
        "clave"            => $claves[0],
        "tipo"             => $tipos[0],
        "eliminar"         => ""
    );
    
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    header('Content-Type: application/json');
    echo json_encode(array());
}

$stmt->close();
$conn->close();
?>
