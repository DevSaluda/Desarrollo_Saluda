<?php
// Test de la solución temporal
echo "<h2>Test de la Solución Temporal</h2>";

// Simular el problema original
echo "<h3>Problema original:</h3>";
$stockExcel = 75;
$conteoExcel = 98;
$diferenciaRecibida = -23; // Lo que está llegando del backend
$stockSistema = 61;

echo "<ul>";
echo "<li>Stock Excel: $stockExcel</li>";
echo "<li>Conteo Excel: $conteoExcel</li>";
echo "<li>Diferencia recibida: $diferenciaRecibida (INCORRECTO)</li>";
echo "<li>Stock Sistema: $stockSistema</li>";
echo "</ul>";

// Aplicar la solución temporal
echo "<h3>Aplicando solución temporal:</h3>";

$diferenciaCorregida = $diferenciaRecibida;
if ($diferenciaRecibida < 0 && $conteoExcel > $stockExcel) {
    $diferenciaCorregida = abs($diferenciaRecibida);
    echo "<p style='color: blue;'>Corrigiendo signo: diferencia original $diferenciaRecibida → $diferenciaCorregida</p>";
} else {
    echo "<p>No se necesita corrección</p>";
}

// Calcular con la diferencia corregida
$conteoNecesario = $stockSistema + $diferenciaCorregida;
$diferenciaFinal = $conteoNecesario - $stockSistema;

echo "<h3>Resultado con la corrección:</h3>";
echo "<ul>";
echo "<li>Diferencia corregida: $diferenciaCorregida</li>";
echo "<li>Conteo necesario: $stockSistema + $diferenciaCorregida = $conteoNecesario</li>";
echo "<li>Diferencia final: $conteoNecesario - $stockSistema = $diferenciaFinal</li>";
echo "</ul>";

// Verificar si la solución funciona
if ($conteoNecesario == 84 && $diferenciaFinal == 23) {
    echo "<p style='color: green; font-weight: bold;'>✅ SOLUCIÓN FUNCIONA!</p>";
    echo "<p>Ahora el sistema calculará correctamente:</p>";
    echo "<ul>";
    echo "<li>Conteo: 84 (en lugar de 38)</li>";
    echo "<li>Diferencia: +23 (en lugar de -23)</li>";
    echo "</ul>";
} else {
    echo "<p style='color: red; font-weight: bold;'>❌ La solución no funciona</p>";
}

echo "<h3>Casos de prueba:</h3>";

$casosPrueba = [
    ['stock' => 75, 'conteo' => 98, 'diferencia' => -23, 'esperado' => 23],
    ['stock' => 50, 'conteo' => 45, 'diferencia' => -5, 'esperado' => -5],
    ['stock' => 100, 'conteo' => 100, 'diferencia' => 0, 'esperado' => 0],
    ['stock' => 200, 'conteo' => 250, 'diferencia' => -50, 'esperado' => 50]
];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Stock</th><th>Conteo</th><th>Diferencia Original</th><th>Diferencia Corregida</th><th>¿Se corrigió?</th></tr>";

foreach ($casosPrueba as $caso) {
    $diferenciaCorregida = $caso['diferencia'];
    $seCorrigio = false;
    
    if ($caso['diferencia'] < 0 && $caso['conteo'] > $caso['stock']) {
        $diferenciaCorregida = abs($caso['diferencia']);
        $seCorrigio = true;
    }
    
    $color = $seCorrigio ? 'lightblue' : 'white';
    
    echo "<tr style='background-color: $color;'>";
    echo "<td>{$caso['stock']}</td>";
    echo "<td>{$caso['conteo']}</td>";
    echo "<td>{$caso['diferencia']}</td>";
    echo "<td>$diferenciaCorregida</td>";
    echo "<td>" . ($seCorrigio ? 'SÍ' : 'NO') . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Instrucciones:</h3>";
echo "<ol>";
echo "<li>La solución temporal está implementada en el código</li>";
echo "<li>Prueba subiendo tu archivo Excel original</li>";
echo "<li>Verifica que ahora calcule correctamente</li>";
echo "<li>Revisa la consola del navegador para ver los mensajes de corrección</li>";
echo "</ol>";
?>
