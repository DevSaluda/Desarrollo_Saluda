<?php
// Test específico para el caso de la jeringa azul
echo "<h2>Test Caso Específico - Jeringa Azul</h2>";

// Datos del caso específico
$stockExcel = 75;
$diferenciaExcel = 23; // +23 (23 sin signo en el Excel)
$stockSistema = 61;

echo "<h3>Datos del caso:</h3>";
echo "<ul>";
echo "<li><strong>Stock Excel:</strong> $stockExcel</li>";
echo "<li><strong>Diferencia Excel:</strong> +$diferenciaExcel (23 sin signo)</li>";
echo "<li><strong>Stock Sistema:</strong> $stockSistema</li>";
echo "</ul>";

// Calcular conteo físico del Excel
$conteoExcel = $stockExcel + $diferenciaExcel;
echo "<p><strong>Conteo Físico del Excel:</strong> $stockExcel + $diferenciaExcel = $conteoExcel</p>";

// Calcular conteo necesario para mantener la diferencia
$conteoNecesario = $stockSistema + $diferenciaExcel;
echo "<p><strong>Conteo Necesario:</strong> $stockSistema + $diferenciaExcel = $conteoNecesario</p>";

// Calcular diferencia final
$diferenciaFinal = $conteoNecesario - $stockSistema;
echo "<p><strong>Diferencia Final:</strong> $conteoNecesario - $stockSistema = $diferenciaFinal</p>";

echo "<h3>Verificación:</h3>";
if ($diferenciaFinal == $diferenciaExcel) {
    echo "<p style='color: green;'><strong>✅ CORRECTO:</strong> La diferencia se mantiene igual (+$diferenciaExcel)</p>";
} else {
    echo "<p style='color: red;'><strong>❌ ERROR:</strong> La diferencia no se mantiene. Esperado: +$diferenciaExcel, Obtenido: $diferenciaFinal</p>";
}

echo "<h3>Tabla de resultados:</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Concepto</th><th>Valor</th></tr>";
echo "<tr><td>Stock Excel</td><td>$stockExcel</td></tr>";
echo "<tr><td>Conteo Excel</td><td>$conteoExcel</td></tr>";
echo "<tr><td>Diferencia Excel</td><td>+$diferenciaExcel</td></tr>";
echo "<tr><td>Stock Sistema</td><td>$stockSistema</td></tr>";
echo "<tr><td>Conteo Necesario</td><td>$conteoNecesario</td></tr>";
echo "<tr><td>Diferencia Final</td><td>$diferenciaFinal</td></tr>";
echo "</table>";

echo "<h3>Debug del problema:</h3>";
echo "<p>Si el sistema está mostrando Conteo=38 y Diferencia=-23, entonces:</p>";
echo "<ul>";
echo "<li>El sistema está interpretando la diferencia como -23 en lugar de +23</li>";
echo "<li>O está calculando: 61 + (-23) = 38</li>";
echo "<li>Esto sugiere que hay un problema en la interpretación del signo de la diferencia</li>";
echo "</ul>";

echo "<h3>Posibles causas:</h3>";
echo "<ol>";
echo "<li><strong>Problema en la lectura del Excel:</strong> El valor 23 se está leyendo como -23</li>";
echo "<li><strong>Problema en el cálculo del backend:</strong> La fórmula está invirtiendo el signo</li>";
echo "<li><strong>Problema en el frontend:</strong> JavaScript está invirtiendo el signo</li>";
echo "<li><strong>Problema en la codificación:</strong> Caracteres especiales o encoding</li>";
echo "</ol>";

echo "<h3>Test de diferentes escenarios:</h3>";

// Test con diferentes formatos de diferencia
$formatosDiferencia = [
    '23' => 23,
    '+23' => 23,
    '-23' => -23,
    ' 23 ' => 23,
    '23.0' => 23.0,
    '23,0' => 23.0
];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Formato en Excel</th><th>Valor parseado</th><th>Resultado</th></tr>";

foreach ($formatosDiferencia as $formato => $valorEsperado) {
    $valorParseado = (float)$formato;
    $resultado = $stockSistema + $valorParseado;
    $color = ($valorParseado == $valorEsperado) ? 'green' : 'red';
    
    echo "<tr>";
    echo "<td>'$formato'</td>";
    echo "<td>$valorParseado</td>";
    echo "<td style='color: $color;'>$resultado</td>";
    echo "</tr>";
}

echo "</table>";
?>
