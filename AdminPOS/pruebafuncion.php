<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Total</title>
</head>
<body>
    <table>
        <tr>
            <td class="cantidad">
                <input class="form-control cantidad-vendida-input" style="font-size: 0.75rem !important;" type="number" name="Contabilizado[]" value="0" onchange="calcularDiferencia(this)" />
            </td>
            <td class="cantidad">
                <input class="form-control cantidad-vendida-input" style="font-size: 0.75rem !important;" type="number" name="Contabilizado[]" value="0" onchange="calcularDiferencia(this)" />
            </td>
        </tr>
    </table>
    <input type="number" class="form-control" id="resultadopiezas" name="resultadepiezas[]" readonly value="0" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para actualizar el total
            function updateTotal() {
                var total = 0;
                var inputs = document.querySelectorAll('.cantidad-vendida-input');
                console.log('Inputs actuales:', inputs);

                // Recorre todos los inputs y suma sus valores
                inputs.forEach(function(input) {
                    var value = parseFloat(input.value);
                    console.log('Valor del input:', value);
                    if (!isNaN(value)) {
                        total += value;
                    }
                });

                // Actualiza el input con id "resultadopiezas" con el total calculado
                console.log('Total calculado:', total);
                document.getElementById('resultadopiezas').value = total;
            }

            // Añade un event listener a cada input para escuchar cambios
            function addInputListeners() {
                var inputs = document.querySelectorAll('.cantidad-vendida-input');
                inputs.forEach(function(input) {
                    input.addEventListener('input', updateTotal);
                });
            }

            // Observer para detectar cambios en el DOM y agregar event listeners a nuevos inputs
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1 && node.querySelectorAll) {
                            var newInputs = node.querySelectorAll('.cantidad-vendida-input');
                            newInputs.forEach(function(input) {
                                input.addEventListener('input', updateTotal);
                            });
                        }
                    });
                    updateTotal(); // Actualizar el total si se agrega un nuevo nodo
                });
            });

            // Configura el observer para observar cambios en el body
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });

            // Añade event listeners a los inputs existentes al cargar la página
            addInputListeners();

            // Llama a updateTotal al cargar la página por si ya hay valores predefinidos
            updateTotal();
        });
    </script>
</body>
</html>
