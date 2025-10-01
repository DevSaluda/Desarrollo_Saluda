<?php
require_once 'db_connection.php';

// Verificar que se haya enviado un archivo
if (!isset($_FILES['archivoExcel']) || $_FILES['archivoExcel']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'No se ha enviado ningún archivo o hay un error en la carga']);
    exit;
}

$action = $_POST['action'] ?? 'preview';
$archivo = $_FILES['archivoExcel'];

// Verificar extensión del archivo
$extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
if (!in_array($extension, ['xlsx', 'xls'])) {
    echo json_encode(['success' => false, 'message' => 'El archivo debe ser de tipo Excel (.xlsx o .xls)']);
    exit;
}

// Crear directorio temporal si no existe
$directorioTemp = '../temp/';
if (!file_exists($directorioTemp)) {
    mkdir($directorioTemp, 0777, true);
}

// Mover archivo a directorio temporal
$nombreArchivo = uniqid() . '_' . $archivo['name'];
$rutaArchivo = $directorioTemp . $nombreArchivo;

if (!move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
    echo json_encode(['success' => false, 'message' => 'Error al guardar el archivo temporalmente']);
    exit;
}

try {
    // Cargar librería PhpSpreadsheet
    require_once '../vendor/autoload.php';
    
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($rutaArchivo);
    $spreadsheet = $reader->load($rutaArchivo);
    $worksheet = $spreadsheet->getActiveSheet();
    $data = $worksheet->toArray();
    
    // Eliminar archivo temporal
    unlink($rutaArchivo);
    
    if (empty($data)) {
        echo json_encode(['success' => false, 'message' => 'El archivo Excel está vacío']);
        exit;
    }
    
    // Obtener encabezados (primera fila)
    $headers = array_map('trim', $data[0]);
    
    // Verificar que existan las columnas requeridas
    $columnasRequeridas = ['Clave', 'Nombre', 'Stock', 'Conteo fisico', 'Diferencia', 'Observaciones'];
    $columnasEncontradas = [];
    
    foreach ($columnasRequeridas as $columna) {
        $indice = array_search($columna, $headers);
        if ($indice !== false) {
            $columnasEncontradas[$columna] = $indice;
        }
    }
    
    if (count($columnasEncontradas) < 4) { // Mínimo 4 columnas requeridas
        echo json_encode([
            'success' => false, 
            'message' => 'El archivo debe contener al menos las columnas: Clave, Nombre, Stock, Conteo fisico'
        ]);
        exit;
    }
    
    // Procesar datos (excluyendo la primera fila que son los encabezados)
    $datosProcesados = [];
    $errores = [];
    
    for ($i = 1; $i < count($data); $i++) {
        $fila = $data[$i];
        
        // Saltar filas vacías
        if (empty(array_filter($fila))) {
            continue;
        }
        
        $dato = [];
        $dato['Clave'] = isset($columnasEncontradas['Clave']) ? trim($fila[$columnasEncontradas['Clave']]) : '';
        $dato['Nombre'] = isset($columnasEncontradas['Nombre']) ? trim($fila[$columnasEncontradas['Nombre']]) : '';
        $dato['Stock'] = isset($columnasEncontradas['Stock']) ? (float)$fila[$columnasEncontradas['Stock']] : 0;
        $dato['Conteo fisico'] = isset($columnasEncontradas['Conteo fisico']) ? (float)$fila[$columnasEncontradas['Conteo fisico']] : 0;
        $dato['Diferencia'] = isset($columnasEncontradas['Diferencia']) ? (float)$fila[$columnasEncontradas['Diferencia']] : 0;
        $dato['Observaciones'] = isset($columnasEncontradas['Observaciones']) ? trim($fila[$columnasEncontradas['Observaciones']]) : '';
        
        // Validar datos básicos
        if (empty($dato['Clave'])) {
            $errores[] = "Fila " . ($i + 1) . ": La clave no puede estar vacía";
            continue;
        }
        
        // Calcular diferencia si no está especificada
        if ($dato['Diferencia'] == 0 && $dato['Stock'] != 0 && $dato['Conteo fisico'] != 0) {
            $dato['Diferencia'] = $dato['Conteo fisico'] - $dato['Stock'];
        }
        
        $datosProcesados[] = $dato;
    }
    
    if ($action === 'preview') {
        // Devolver datos para vista previa
        echo json_encode([
            'success' => true,
            'data' => $datosProcesados,
            'total' => count($datosProcesados),
            'errores' => $errores
        ]);
    } else if ($action === 'cargar') {
        // Cargar datos a la tabla principal
        $tipoAjuste = $_POST['tipoAjuste'] ?? '';
        $anaquel = $_POST['anaquel'] ?? '';
        $repisa = $_POST['repisa'] ?? '';
        
        if (empty($tipoAjuste) || empty($anaquel) || empty($repisa)) {
            echo json_encode(['success' => false, 'message' => 'Faltan parámetros requeridos']);
            exit;
        }
        
        $productosCargados = 0;
        $erroresCarga = [];
        
        foreach ($datosProcesados as $index => $dato) {
            try {
                // Buscar el producto en la base de datos
                $stmt = $conn->prepare("
                    SELECT p.ID_Producto, p.Nombre_Producto, p.Precio_Venta, p.Precio_Compra,
                           s.Stock_Actual, s.Fk_Sucursal
                    FROM Productos p
                    LEFT JOIN Stock s ON p.ID_Producto = s.Fk_Producto AND s.Fk_Sucursal = ?
                    WHERE p.Codigo_Barras = ?
                ");
                
                $fkSucursal = $_SESSION['Fk_Sucursal'] ?? 1; // Obtener de sesión
                $stmt->bind_param("is", $fkSucursal, $dato['Clave']);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $producto = $result->fetch_assoc();
                    
                    // Crear objeto artículo para la función agregarArticulo
                    $articulo = [
                        'id' => $producto['ID_Producto'],
                        'codigo' => $dato['Clave'],
                        'descripcion' => $dato['Nombre'] ?: $producto['Nombre_Producto'],
                        'cantidad' => $dato['Conteo fisico'],
                        'existencia' => $producto['Stock_Actual'] ?: 0,
                        'precio' => $producto['Precio_Venta'] ?: 0,
                        'preciocompra' => $producto['Precio_Compra'] ?: 0,
                        'tipoAjuste' => $tipoAjuste,
                        'anaquel' => $anaquel,
                        'repisa' => $repisa,
                        'comentario' => $dato['Observaciones']
                    ];
                    
                    // Agregar a la tabla (esto se manejará en el frontend)
                    $productosCargados++;
                } else {
                    $erroresCarga[] = "Producto con clave '{$dato['Clave']}' no encontrado en la sucursal";
                }
            } catch (Exception $e) {
                $erroresCarga[] = "Error al procesar producto '{$dato['Clave']}': " . $e->getMessage();
            }
        }
        
        echo json_encode([
            'success' => true,
            'cantidad' => $productosCargados,
            'errores' => $erroresCarga,
            'datos' => $datosProcesados // Enviar datos para que el frontend los procese
        ]);
    }
    
} catch (Exception $e) {
    // Limpiar archivo temporal en caso de error
    if (file_exists($rutaArchivo)) {
        unlink($rutaArchivo);
    }
    
    echo json_encode([
        'success' => false, 
        'message' => 'Error al procesar el archivo: ' . $e->getMessage()
    ]);
}
?>
