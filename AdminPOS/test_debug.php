<?php
// Archivo de prueba para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Probando lectura de CSV...\n";

$archivo = 'ejemplo_inventario_corregido.csv';
if (file_exists($archivo)) {
    $data = [];
    if (($handle = fopen($archivo, "r")) !== FALSE) {
        while (($fila = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $data[] = $fila;
        }
        fclose($handle);
    }
    
    echo "Headers: " . json_encode($data[0]) . "\n";
    echo "Fila 1: " . json_encode($data[1]) . "\n";
    
    // Buscar Conteo Físico
    $headers = array_map('trim', $data[0]);
    $indiceConteo = -1;
    foreach ($headers as $index => $header) {
        if (stripos($header, 'conteo') !== false && stripos($header, 'fisico') !== false) {
            $indiceConteo = $index;
            break;
        }
    }
    
    echo "Índice de Conteo Físico: $indiceConteo\n";
    if ($indiceConteo >= 0) {
        echo "Valor en fila 1: '" . $data[1][$indiceConteo] . "'\n";
        echo "Valor convertido: " . (float)$data[1][$indiceConteo] . "\n";
    }
} else {
    echo "Archivo no encontrado: $archivo\n";
}
?>
