<?php
// Simulación del procesamiento del Excel para la jeringa azul
echo "<h2>Simulación del Procesamiento del Excel</h2>";

// Simular los datos que vienen del Excel
$filaExcel = [
    'Clave' => 'JERINGA-AZUL',
    'Nombre' => 'Jeringa Azul 10ml',
    'Stock' => '75',
    'Conteo Físico' => '98',
    'Diferencia' => '23', // 23 sin signo en el Excel
    'Observaciones' => 'Test de diferencia positiva'
];

echo "<h3>Datos originales del Excel:</h3>";
echo "<pre>";
print_r($filaExcel);
echo "</pre>";

// Simular el procesamiento del backend
$dato = [];
$dato['Clave'] = trim($filaExcel['Clave']);
$dato['Nombre'] = trim($filaExcel['Nombre']);
$dato['Stock'] = (float)$filaExcel['Stock'];
$dato['Conteo Físico'] = (float)$filaExcel['Conteo Físico'];
$dato['Diferencia'] = (float)$filaExcel['Diferencia'];

echo "<h3>Datos procesados por el backend:</h3>";
echo "<pre>";
print_r($dato);
echo "</pre>";

// Simular el cálculo de diferencia si no está especificada
if ($dato['Diferencia'] == 0 && $dato['Stock'] != 0 && $dato['Conteo Físico'] != 0) {
    $dato['Diferencia'] = $dato['Conteo Físico'] - $dato['Stock'];
    echo "<p><strong>Diferencia calculada:</strong> {$dato['Conteo Físico']} - {$dato['Stock']} = {$dato['Diferencia']}</p>";
} else {
    echo "<p><strong>Diferencia del Excel:</strong> {$dato['Diferencia']}</p>";
}

// Simular el procesamiento del frontend
$stockSistema = 61;
$diferenciaExcel = $dato['Diferencia'];
$conteoNecesario = $stockSistema + $diferenciaExcel;

echo "<h3>Procesamiento del frontend:</h3>";
echo "<ul>";
echo "<li><strong>Stock Sistema:</strong> $stockSistema</li>";
echo "<li><strong>Diferencia Excel:</strong> $diferenciaExcel</li>";
echo "<li><strong>Cálculo:</strong> $stockSistema + $diferenciaExcel = $conteoNecesario</li>";
echo "<li><strong>Diferencia Final:</strong> $conteoNecesario - $stockSistema = " . ($conteoNecesario - $stockSistema) . "</li>";
echo "</ul>";

// Test con diferentes valores de diferencia
echo "<h3>Test con diferentes valores de diferencia:</h3>";
$testDiferencias = [23, -23, 0, '23', '-23', '+23'];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Diferencia Original</th><th>Tipo</th><th>Valor Parseado</th><th>Conteo Necesario</th><th>Diferencia Final</th></tr>";

foreach ($testDiferencias as $diff) {
    $valorParseado = (float)$diff;
    $conteo = $stockSistema + $valorParseado;
    $diferenciaFinal = $conteo - $stockSistema;
    
    echo "<tr>";
    echo "<td>$diff</td>";
    echo "<td>" . gettype($diff) . "</td>";
    echo "<td>$valorParseado</td>";
    echo "<td>$conteo</td>";
    echo "<td>$diferenciaFinal</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Análisis del problema:</h3>";
echo "<p>Si tu sistema está mostrando Conteo=38 y Diferencia=-23, entonces:</p>";
echo "<ul>";
echo "<li>El valor '23' del Excel se está interpretando como -23</li>";
echo "<li>O hay algún problema en la conversión de tipos</li>";
echo "<li>O hay algún problema en la codificación del archivo</li>";
echo "</ul>";

echo "<h3>Recomendaciones:</h3>";
echo "<ol>";
echo "<li>Revisar los logs del servidor para ver qué valor está leyendo del Excel</li>";
echo "<li>Verificar la codificación del archivo CSV/Excel</li>";
echo "<li>Probar con diferentes formatos de diferencia en el Excel</li>";
echo "<li>Verificar que no haya caracteres ocultos en la celda</li>";
echo "</ol>";
?>
