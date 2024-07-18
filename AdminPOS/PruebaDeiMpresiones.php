<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Documento para Imprimir</title>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printArea, #printArea * {
                visibility: visible;
            }
            #printArea {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
    <div id="printArea">
        <!-- Aquí se coloca el contenido que deseas imprimir -->
        <h1>Reporte de Ventas</h1>
        <p>Fecha: 2024-07-18</p>
        <table border="1">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Producto A</td>
                    <td>2</td>
                    <td>$50.00</td>
                </tr>
                <tr>
                    <td>Producto B</td>
                    <td>1</td>
                    <td>$30.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <button id="printButton">Imprimir</button>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            // Lógica para imprimir
            window.print();

            // Enviar la solicitud AJAX al servidor
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'registrar_impresion.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log('Impresión registrada con éxito');
                }
            };
            xhr.send('estado=exito');
        });
    </script>
</body>
</html>
