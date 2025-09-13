<?php
// Debug específico para el sistema real
echo "<h2>Debug del Sistema Real</h2>";

// Simular exactamente lo que está pasando en tu sistema
echo "<h3>Simulación del problema real:</h3>";

// Datos que tienes en el Excel
$stockExcel = 75;
$conteoExcel = 98; // Calculado: 75 + 23 = 98
$diferenciaExcel = 23; // Valor en el Excel (sin signo)

// Stock actual del sistema
$stockSistema = 61;

echo "<p><strong>Datos del Excel:</strong></p>";
echo "<ul>";
echo "<li>Stock: $stockExcel</li>";
echo "<li>Conteo Físico: $conteoExcel</li>";
echo "<li>Diferencia: $diferenciaExcel (23 sin signo)</li>";
echo "</ul>";

echo "<p><strong>Stock del sistema:</strong> $stockSistema</p>";

// Cálculo correcto
$conteoCorrecto = $stockSistema + $diferenciaExcel;
$diferenciaCorrecta = $conteoCorrecto - $stockSistema;

echo "<p><strong>Cálculo correcto:</strong></p>";
echo "<ul>";
echo "<li>Conteo necesario: $stockSistema + $diferenciaExcel = $conteoCorrecto</li>";
echo "<li>Diferencia final: $conteoCorrecto - $stockSistema = $diferenciaCorrecta</li>";
echo "</ul>";

// Cálculo incorrecto (lo que está pasando)
$diferenciaIncorrecta = -23; // El sistema está leyendo -23
$conteoIncorrecto = $stockSistema + $diferenciaIncorrecta;
$diferenciaFinalIncorrecta = $conteoIncorrecto - $stockSistema;

echo "<p><strong>Cálculo incorrecto (lo que está pasando):</strong></p>";
echo "<ul>";
echo "<li>Diferencia leída: $diferenciaIncorrecta (en lugar de +23)</li>";
echo "<li>Conteo necesario: $stockSistema + $diferenciaIncorrecta = $conteoIncorrecto</li>";
echo "<li>Diferencia final: $conteoIncorrecto - $stockSistema = $diferenciaFinalIncorrecta</li>";
echo "</ul>";

echo "<h3>Diagnóstico:</h3>";
echo "<p style='color: red;'><strong>El problema está en que el sistema está leyendo la diferencia como -23 en lugar de +23</strong></p>";

echo "<h3>Posibles causas específicas:</h3>";
echo "<ol>";
echo "<li><strong>Problema en la lectura del CSV:</strong> El valor 23 se está leyendo como -23</li>";
echo "<li><strong>Problema en la codificación:</strong> Caracteres ocultos o encoding incorrecto</li>";
echo "<li><strong>Problema en la conversión de tipos:</strong> (float) está interpretando mal el valor</li>";
echo "<li><strong>Problema en el cálculo del backend:</strong> La fórmula está invirtiendo el signo</li>";
echo "</ol>";

echo "<h3>Test de diagnóstico:</h3>";

// Test con diferentes valores para ver cuál produce el resultado incorrecto
$testValores = [
    '23' => 23,
    ' 23 ' => 23,
    '23.0' => 23.0,
    '23,0' => 23.0,
    '+23' => 23,
    '-23' => -23,
    '23.00' => 23.0,
    '23,00' => 23.0
];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Valor Original</th><th>Valor Parseado</th><th>Conteo Necesario</th><th>Diferencia Final</th><th>¿Produce Error?</th></tr>";

foreach ($testValores as $original => $parseado) {
    $conteo = $stockSistema + $parseado;
    $diferencia = $conteo - $stockSistema;
    $produceError = ($conteo == 38 && $diferencia == -23);
    $color = $produceError ? 'red' : 'green';
    
    echo "<tr style='background-color: $color;'>";
    echo "<td>'$original'</td>";
    echo "<td>$parseado</td>";
    echo "<td>$conteo</td>";
    echo "<td>$diferencia</td>";
    echo "<td>" . ($produceError ? 'SÍ' : 'NO') . "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h3>Recomendaciones para debuggear:</h3>";
echo "<ol>";
echo "<li><strong>Revisar los logs del servidor:</strong> Buscar las líneas que dicen 'Diferencia - Valor original' y 'Diferencia - Valor convertido'</li>";
echo "<li><strong>Verificar el archivo CSV:</strong> Abrir con un editor de texto para ver si hay caracteres ocultos</li>";
echo "<li><strong>Probar con diferentes formatos:</strong> Cambiar el valor 23 por +23 en el Excel</li>";
echo "<li><strong>Verificar la codificación:</strong> Guardar el CSV como UTF-8</li>";
echo "</ol>";

echo "<h3>Archivo de prueba para tu sistema:</h3>";
echo "<p>Crea un archivo CSV con este contenido exacto:</p>";
echo "<pre>";
echo "Clave,Nombre,Stock,Conteo Físico,Diferencia,Observaciones\n";
echo "JERINGA-AZUL,Jeringa Azul 10ml,75,98,23,Test de diferencia positiva\n";
echo "</pre>";

echo "<p>Y súbelo al sistema para ver qué logs genera.</p>";
?>
