<?php
// Debug simple y directo
echo "<h2>Debug Simple - Identificar el Problema</h2>";

// Simular exactamente lo que está pasando
echo "<h3>1. Datos del Excel (lo que debería ser):</h3>";
$stockExcel = 75;
$conteoExcel = 98;
$diferenciaExcel = 23; // 23 sin signo en el Excel

echo "<ul>";
echo "<li>Stock: $stockExcel</li>";
echo "<li>Conteo Físico: $conteoExcel</li>";
echo "<li>Diferencia: $diferenciaExcel (23 sin signo)</li>";
echo "</ul>";

echo "<h3>2. Cálculo correcto:</h3>";
$diferenciaCorrecta = $conteoExcel - $stockExcel;
echo "<p>Diferencia correcta: $conteoExcel - $stockExcel = $diferenciaCorrecta</p>";

echo "<h3>3. Lo que está recibiendo el frontend:</h3>";
$diferenciaRecibida = -23; // Esto es lo que está llegando
echo "<p>Diferencia recibida: $diferenciaRecibida (INCORRECTO)</p>";

echo "<h3>4. Simulación del frontend:</h3>";
$stockSistema = 61;
$conteoNecesario = $stockSistema + $diferenciaRecibida;
$diferenciaFinal = $conteoNecesario - $stockSistema;

echo "<ul>";
echo "<li>Stock Sistema: $stockSistema</li>";
echo "<li>Diferencia recibida: $diferenciaRecibida</li>";
echo "<li>Conteo necesario: $stockSistema + $diferenciaRecibida = $conteoNecesario</li>";
echo "<li>Diferencia final: $conteoNecesario - $stockSistema = $diferenciaFinal</li>";
echo "</ul>";

echo "<h3>5. Diagnóstico:</h3>";
if ($conteoNecesario == 38 && $diferenciaFinal == -23) {
    echo "<p style='color: red; font-weight: bold;'>¡PROBLEMA CONFIRMADO!</p>";
    echo "<p>El sistema está enviando -23 en lugar de +23</p>";
} else {
    echo "<p style='color: green;'>No es el problema esperado</p>";
}

echo "<h3>6. Posibles causas:</h3>";
echo "<ol>";
echo "<li><strong>El Excel tiene -23 en lugar de 23</strong></li>";
echo "<li><strong>El backend está invirtiendo el signo</strong></li>";
echo "<li><strong>Hay caracteres ocultos en el CSV</strong></li>";
echo "<li><strong>Problema de codificación</strong></li>";
echo "</ol>";

echo "<h3>7. Test de diferentes valores:</h3>";

$testValores = [
    '23' => 23,
    ' 23 ' => 23,
    '23.0' => 23.0,
    '+23' => 23,
    '-23' => -23,
    '23,0' => 23.0
];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Valor en Excel</th><th>Valor parseado</th><th>Resultado</th><th>¿Produce -23?</th></tr>";

foreach ($testValores as $original => $parseado) {
    $resultado = $stockSistema + $parseado;
    $produceError = ($parseado == -23);
    $color = $produceError ? 'red' : 'green';
    
    echo "<tr style='background-color: $color;'>";
    echo "<td>'$original'</td>";
    echo "<td>$parseado</td>";
    echo "<td>$resultado</td>";
    echo "<td>" . ($produceError ? 'SÍ' : 'NO') . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>8. Solución temporal:</h3>";
echo "<p>Mientras identificamos el problema, puedes:</p>";
echo "<ol>";
echo "<li><strong>Cambiar el signo en el Excel:</strong> Poner -23 en lugar de 23</li>";
echo "<li><strong>O modificar el código:</strong> Multiplicar por -1 la diferencia</li>";
echo "</ol>";

echo "<h3>9. Archivo CSV de prueba:</h3>";
echo "<p>Crea un archivo con este contenido exacto:</p>";
echo "<pre>";
echo "Clave,Nombre,Stock,Conteo Físico,Diferencia,Observaciones\n";
echo "7506022300782,JERINGA DE AZUL PLASTICO 3ML 23G/25MM,75,98,23,Test\n";
echo "</pre>";

echo "<p>Y súbelo al sistema para ver los logs.</p>";
?>
