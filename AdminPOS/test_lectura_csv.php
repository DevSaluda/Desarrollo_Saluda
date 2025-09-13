<?php
// Test de lectura del CSV usando la misma lógica del sistema
require_once 'Consultas/ProcesarExcelInventarioSimple.php';

echo "<h2>Test de Lectura del CSV</h2>";

// Simular la carga del archivo CSV
$archivo = 'test_jeringa_azul.csv';

if (!file_exists($archivo)) {
    echo "<p style='color: red;'>Error: No se encontró el archivo $archivo</p>";
    exit;
}

echo "<h3>Contenido del archivo CSV:</h3>";
echo "<pre>";
echo htmlspecialchars(file_get_contents($archivo));
echo "</pre>";

// Simular el procesamiento usando SpreadsheetReader
try {
    require_once 'vendor/autoload.php';
    
    $reader = new SpreadsheetReader($archivo);
    $data = iterator_to_array($reader);
    
    echo "<h3>Datos leídos por SpreadsheetReader:</h3>";
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    
    // Procesar la primera fila de datos (índice 1, saltando headers)
    if (count($data) > 1) {
        $fila = $data[1];
        echo "<h3>Primera fila de datos (índice 1):</h3>";
        echo "<pre>";
        print_r($fila);
        echo "</pre>";
        
        // Simular el procesamiento de columnas
        $headers = $data[0];
        echo "<h3>Headers detectados:</h3>";
        echo "<pre>";
        print_r($headers);
        echo "</pre>";
        
        // Buscar columnas
        $columnasEncontradas = [];
        foreach (['Clave', 'Nombre', 'Stock', 'Diferencia', 'Observaciones'] as $columna) {
            $indice = array_search($columna, $headers);
            if ($indice !== false) {
                $columnasEncontradas[$columna] = $indice;
            }
        }
        
        // Buscar Conteo Físico
        foreach ($headers as $index => $header) {
            $headerNormalizado = mb_strtolower($header, 'UTF-8');
            if (mb_strpos($headerNormalizado, 'conteo') !== false && mb_strpos($headerNormalizado, 'físico') !== false) {
                $columnasEncontradas['Conteo Físico'] = $index;
                break;
            }
        }
        
        echo "<h3>Columnas encontradas:</h3>";
        echo "<pre>";
        print_r($columnasEncontradas);
        echo "</pre>";
        
        // Procesar datos
        $dato = [];
        $dato['Clave'] = isset($columnasEncontradas['Clave']) ? trim($fila[$columnasEncontradas['Clave']]) : '';
        $dato['Nombre'] = isset($columnasEncontradas['Nombre']) ? trim($fila[$columnasEncontradas['Nombre']]) : '';
        $dato['Stock'] = isset($columnasEncontradas['Stock']) ? (float)$fila[$columnasEncontradas['Stock']] : 0;
        $dato['Conteo Físico'] = isset($columnasEncontradas['Conteo Físico']) ? (float)$fila[$columnasEncontradas['Conteo Físico']] : 0;
        $dato['Diferencia'] = isset($columnasEncontradas['Diferencia']) ? (float)$fila[$columnasEncontradas['Diferencia']] : 0;
        
        echo "<h3>Datos procesados:</h3>";
        echo "<pre>";
        print_r($dato);
        echo "</pre>";
        
        // Calcular diferencia si no está especificada
        if ($dato['Diferencia'] == 0 && $dato['Stock'] != 0 && $dato['Conteo Físico'] != 0) {
            $dato['Diferencia'] = $dato['Conteo Físico'] - $dato['Stock'];
            echo "<p><strong>Diferencia calculada:</strong> {$dato['Conteo Físico']} - {$dato['Stock']} = {$dato['Diferencia']}</p>";
        }
        
        echo "<h3>Resultado final:</h3>";
        echo "<ul>";
        echo "<li><strong>Clave:</strong> {$dato['Clave']}</li>";
        echo "<li><strong>Stock:</strong> {$dato['Stock']}</li>";
        echo "<li><strong>Conteo Físico:</strong> {$dato['Conteo Físico']}</li>";
        echo "<li><strong>Diferencia:</strong> {$dato['Diferencia']}</li>";
        echo "</ul>";
        
        // Test con stock del sistema
        $stockSistema = 61;
        $conteoNecesario = $stockSistema + $dato['Diferencia'];
        echo "<p><strong>Con stock del sistema ($stockSistema):</strong> $stockSistema + {$dato['Diferencia']} = $conteoNecesario</p>";
        
    } else {
        echo "<p style='color: red;'>Error: No hay datos en el archivo</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error al leer el archivo: " . $e->getMessage() . "</p>";
}
?>
