<?php
// Test para verificar el cálculo de diferencias
echo "<h2>Test de Cálculo de Diferencias</h2>";

// Simular datos del Excel
$datosExcel = [
    ['Clave' => 'PAPE-0014', 'Stock' => 100, 'Conteo Físico' => 120, 'Diferencia' => 20],
    ['Clave' => 'PAPE-0015', 'Stock' => 50, 'Conteo Físico' => 45, 'Diferencia' => -5],
    ['Clave' => 'PAPE-0016', 'Stock' => 200, 'Conteo Físico' => 200, 'Diferencia' => 0],
    ['Clave' => 'PAPE-0017', 'Stock' => 100, 'Conteo Físico' => 120, 'Diferencia' => 0], // Sin diferencia específica
];

// Simular stock actual del sistema
$stockSistema = 150;

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Clave</th><th>Stock Excel</th><th>Conteo Excel</th><th>Diferencia Excel</th><th>Stock Sistema</th><th>Conteo Necesario</th><th>Diferencia Final</th></tr>";

foreach ($datosExcel as $dato) {
    $stockExcel = $dato['Stock'];
    $conteoExcel = $dato['Conteo Físico'];
    $diferenciaExcel = $dato['Diferencia'];
    
    // Si no hay diferencia específica, calcularla
    if ($diferenciaExcel == 0 && $stockExcel != 0 && $conteoExcel != 0) {
        $diferenciaExcel = $conteoExcel - $stockExcel;
    }
    
    // Calcular conteo necesario
    $conteoNecesario = $stockSistema + $diferenciaExcel;
    
    // Evitar negativos
    if ($conteoNecesario < 0) {
        $conteoNecesario = 0;
    }
    
    // Calcular diferencia final
    $diferenciaFinal = $conteoNecesario - $stockSistema;
    
    echo "<tr>";
    echo "<td>{$dato['Clave']}</td>";
    echo "<td>$stockExcel</td>";
    echo "<td>$conteoExcel</td>";
    echo "<td>$diferenciaExcel</td>";
    echo "<td>$stockSistema</td>";
    echo "<td>$conteoNecesario</td>";
    echo "<td>$diferenciaFinal</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Explicación:</h3>";
echo "<ul>";
echo "<li><strong>Diferencia Excel:</strong> Conteo Físico - Stock Excel</li>";
echo "<li><strong>Conteo Necesario:</strong> Stock Sistema + Diferencia Excel</li>";
echo "<li><strong>Diferencia Final:</strong> Conteo Necesario - Stock Sistema (debe ser igual a Diferencia Excel)</li>";
echo "</ul>";
?>
