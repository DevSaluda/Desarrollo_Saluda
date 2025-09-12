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
if (!in_array($extension, ['xlsx', 'xls', 'csv'])) {
    echo json_encode(['success' => false, 'message' => 'El archivo debe ser de tipo Excel (.xlsx, .xls) o CSV']);
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
    $data = [];
    
    if ($extension === 'csv') {
        // Procesar CSV
        $data = procesarCSV($rutaArchivo);
    } else {
        // Procesar Excel usando la librería existente
        $data = procesarExcel($rutaArchivo);
    }
    
    // Eliminar archivo temporal
    unlink($rutaArchivo);
    
    if (empty($data)) {
        echo json_encode(['success' => false, 'message' => 'El archivo está vacío o no se pudo procesar']);
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
        
        // Marcar que el stock viene del Excel (puede ser de fecha pasada)
        $dato['StockDelExcel'] = true;
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
        
        echo json_encode([
            'success' => true,
            'cantidad' => count($datosProcesados),
            'errores' => $errores,
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

// Función para procesar CSV
function procesarCSV($rutaArchivo) {
    $data = [];
    if (($handle = fopen($rutaArchivo, "r")) !== FALSE) {
        while (($fila = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[] = $fila;
        }
        fclose($handle);
    }
    return $data;
}

// Función para procesar Excel usando la librería existente
function procesarExcel($rutaArchivo) {
    // Usar la librería SpreadsheetReader que ya tienes instalada
    require_once '../vendor/SpreadsheetReader.php';
    
    $Reader = new SpreadsheetReader($rutaArchivo);
    $data = [];
    
    foreach ($Reader as $Row) {
        $data[] = $Row;
    }
    
    return $data;
}
?>
