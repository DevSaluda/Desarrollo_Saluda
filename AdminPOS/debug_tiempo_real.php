<?php
// Debug en tiempo real del sistema
echo "<h2>Debug en Tiempo Real</h2>";

// Simular la carga del archivo CSV
$archivo = 'test_diagnostico.csv';

if (!file_exists($archivo)) {
    echo "<p style='color: red;'>Error: No se encontró el archivo $archivo</p>";
    echo "<p>Por favor, crea el archivo CSV con el contenido:</p>";
    echo "<pre>";
    echo "Clave,Nombre,Stock,Conteo Físico,Diferencia,Observaciones\n";
    echo "JERINGA-AZUL,Jeringa Azul 10ml,75,98,23,Test de diferencia positiva\n";
    echo "JERINGA-ROJA,Jeringa Roja 5ml,50,45,-5,Test de diferencia negativa\n";
    echo "JERINGA-VERDE,Jeringa Verde 20ml,100,100,0,Test de diferencia cero\n";
    echo "</pre>";
    exit;
}

echo "<h3>Archivo encontrado: $archivo</h3>";

// Leer el archivo línea por línea
$lineas = file($archivo, FILE_IGNORE_NEW_LINES);
echo "<h3>Contenido del archivo:</h3>";
echo "<pre>";
foreach ($lineas as $i => $linea) {
    echo "Línea $i: " . htmlspecialchars($linea) . "\n";
}
echo "</pre>";

// Procesar la primera fila de datos
if (count($lineas) > 1) {
    $headers = str_getcsv($lineas[0]);
    $datos = str_getcsv($lineas[1]);
    
    echo "<h3>Headers detectados:</h3>";
    echo "<pre>";
    print_r($headers);
    echo "</pre>";
    
    echo "<h3>Datos de la primera fila:</h3>";
    echo "<pre>";
    print_r($datos);
    echo "</pre>";
    
    // Crear array asociativo
    $fila = array_combine($headers, $datos);
    
    echo "<h3>Fila procesada:</h3>";
    echo "<pre>";
    print_r($fila);
    echo "</pre>";
    
    // Procesar cada campo
    echo "<h3>Procesamiento de campos:</h3>";
    
    $clave = trim($fila['Clave']);
    $nombre = trim($fila['Nombre']);
    $stock = (float)$fila['Stock'];
    $conteoFisico = (float)$fila['Conteo Físico'];
    $diferencia = (float)$fila['Diferencia'];
    $observaciones = trim($fila['Observaciones']);
    
    echo "<ul>";
    echo "<li><strong>Clave:</strong> '$clave' (tipo: " . gettype($clave) . ")</li>";
    echo "<li><strong>Nombre:</strong> '$nombre' (tipo: " . gettype($nombre) . ")</li>";
    echo "<li><strong>Stock:</strong> '$fila[Stock]' → $stock (tipo: " . gettype($stock) . ")</li>";
    echo "<li><strong>Conteo Físico:</strong> '$fila[Conteo Físico]' → $conteoFisico (tipo: " . gettype($conteoFisico) . ")</li>";
    echo "<li><strong>Diferencia:</strong> '$fila[Diferencia]' → $diferencia (tipo: " . gettype($diferencia) . ")</li>";
    echo "<li><strong>Observaciones:</strong> '$observaciones' (tipo: " . gettype($observaciones) . ")</li>";
    echo "</ul>";
    
    // Verificar si la diferencia es correcta
    $diferenciaCalculada = $conteoFisico - $stock;
    
    echo "<h3>Verificación de la diferencia:</h3>";
    echo "<ul>";
    echo "<li><strong>Diferencia del Excel:</strong> $diferencia</li>";
    echo "<li><strong>Diferencia calculada:</strong> $conteoFisico - $stock = $diferenciaCalculada</li>";
    echo "<li><strong>¿Coinciden?</strong> " . ($diferencia == $diferenciaCalculada ? 'SÍ' : 'NO') . "</li>";
    echo "</ul>";
    
    // Simular el cálculo del frontend
    $stockSistema = 61; // Simular stock del sistema
    $conteoNecesario = $stockSistema + $diferencia;
    $diferenciaFinal = $conteoNecesario - $stockSistema;
    
    echo "<h3>Simulación del frontend:</h3>";
    echo "<ul>";
    echo "<li><strong>Stock del sistema:</strong> $stockSistema</li>";
    echo "<li><strong>Diferencia del Excel:</strong> $diferencia</li>";
    echo "<li><strong>Cálculo:</strong> $stockSistema + $diferencia = $conteoNecesario</li>";
    echo "<li><strong>Diferencia final:</strong> $conteoNecesario - $stockSistema = $diferenciaFinal</li>";
    echo "</ul>";
    
    // Verificar si produce el error
    if ($conteoNecesario == 38 && $diferenciaFinal == -23) {
        echo "<p style='color: red; font-weight: bold;'>¡PROBLEMA IDENTIFICADO! El sistema está produciendo el error esperado.</p>";
    } else {
        echo "<p style='color: green; font-weight: bold;'>El sistema está funcionando correctamente.</p>";
    }
    
} else {
    echo "<p style='color: red;'>Error: No hay suficientes líneas en el archivo</p>";
}

echo "<h3>Instrucciones para debuggear:</h3>";
echo "<ol>";
echo "<li>Sube el archivo <code>test_diagnostico.csv</code> a tu sistema</li>";
echo "<li>Revisa los logs del servidor para ver qué valores está leyendo</li>";
echo "<li>Compara los valores con los mostrados aquí</li>";
echo "<li>Si los valores son diferentes, el problema está en la lectura del archivo</li>";
echo "<li>Si los valores son iguales, el problema está en el cálculo</li>";
echo "</ol>";
?>
