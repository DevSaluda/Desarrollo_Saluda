<?php
// Test específico para el caso real de la jeringa azul
echo "<h2>Test Caso Real - Jeringa Azul</h2>";

// Datos exactos del array que recibiste
$datosArray = [
    'Clave' => '7506022300782',
    'Nombre' => 'JERINGA DE AZUL PLASTICO 3ML 23G/25MM',
    'Stock' => 75,
    'Conteo Físico' => 98,
    'Diferencia' => -23, // ← Este es el problema
    'Observaciones' => '',
    'StockDelExcel' => true
];

echo "<h3>Datos del array recibido:</h3>";
echo "<pre>";
print_r($datosArray);
echo "</pre>";

// Análisis del problema
echo "<h3>Análisis del problema:</h3>";
echo "<ul>";
echo "<li><strong>Stock:</strong> {$datosArray['Stock']}</li>";
echo "<li><strong>Conteo Físico:</strong> {$datosArray['Conteo Físico']}</li>";
echo "<li><strong>Diferencia recibida:</strong> {$datosArray['Diferencia']}</li>";
echo "<li><strong>Diferencia correcta:</strong> {$datosArray['Conteo Físico']} - {$datosArray['Stock']} = " . ($datosArray['Conteo Físico'] - $datosArray['Stock']) . "</li>";
echo "</ul>";

// Simular el cálculo del frontend
$stockSistema = 61; // Stock actual del sistema
$diferenciaRecibida = $datosArray['Diferencia']; // -23 (incorrecto)
$diferenciaCorrecta = $datosArray['Conteo Físico'] - $datosArray['Stock']; // +23 (correcto)

echo "<h3>Simulación del frontend:</h3>";
echo "<h4>Con la diferencia incorrecta (-23):</h4>";
$conteoIncorrecto = $stockSistema + $diferenciaRecibida;
$diferenciaFinalIncorrecta = $conteoIncorrecto - $stockSistema;
echo "<ul>";
echo "<li><strong>Conteo necesario:</strong> $stockSistema + $diferenciaRecibida = $conteoIncorrecto</li>";
echo "<li><strong>Diferencia final:</strong> $conteoIncorrecto - $stockSistema = $diferenciaFinalIncorrecta</li>";
echo "</ul>";

echo "<h4>Con la diferencia correcta (+23):</h4>";
$conteoCorrecto = $stockSistema + $diferenciaCorrecta;
$diferenciaFinalCorrecta = $conteoCorrecto - $stockSistema;
echo "<ul>";
echo "<li><strong>Conteo necesario:</strong> $stockSistema + $diferenciaCorrecta = $conteoCorrecto</li>";
echo "<li><strong>Diferencia final:</strong> $conteoCorrecto - $stockSistema = $diferenciaFinalCorrecta</li>";
echo "</ul>";

// Verificar si coincide con tu problema
if ($conteoIncorrecto == 38 && $diferenciaFinalIncorrecta == -23) {
    echo "<p style='color: red; font-weight: bold;'>¡CONFIRMADO! Este es exactamente tu problema.</p>";
} else {
    echo "<p style='color: green; font-weight: bold;'>No coincide con tu problema.</p>";
}

echo "<h3>Diagnóstico:</h3>";
echo "<p><strong>El problema está en el backend PHP.</strong> Está enviando -23 en lugar de +23.</p>";

echo "<h3>Posibles causas:</h3>";
echo "<ol>";
echo "<li><strong>Problema en la lectura del Excel:</strong> El valor 23 se está leyendo como -23</li>";
echo "<li><strong>Problema en el cálculo:</strong> La fórmula está invirtiendo el signo</li>";
echo "<li><strong>Problema en la codificación:</strong> Caracteres ocultos en el archivo</li>";
echo "</ol>";

echo "<h3>Recomendaciones:</h3>";
echo "<ol>";
echo "<li><strong>Revisar los logs del servidor</strong> para ver qué está leyendo del Excel</li>";
echo "<li><strong>Verificar el archivo CSV</strong> para asegurar que no hay caracteres ocultos</li>";
echo "<li><strong>Probar con un archivo CSV simple</strong> con solo la jeringa azul</li>";
echo "</ol>";

echo "<h3>Archivo CSV de prueba:</h3>";
echo "<p>Crea un archivo CSV con este contenido exacto:</p>";
echo "<pre>";
echo "Clave,Nombre,Stock,Conteo Físico,Diferencia,Observaciones\n";
echo "7506022300782,JERINGA DE AZUL PLASTICO 3ML 23G/25MM,75,98,23,Test\n";
echo "</pre>";

echo "<p>Y súbelo al sistema para ver qué logs genera.</p>";
?>
