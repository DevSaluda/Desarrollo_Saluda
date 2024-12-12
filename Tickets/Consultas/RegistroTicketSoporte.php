<div class="text-center">
    <h3>Consulta el estado de tu ticket</h3>
    <form id="formConsultaTicket">
        <label for="numeroTicket">Ingresa tu No. de Ticket:</label>
        <input type="text" id="numeroTicket" name="numeroTicket" class="form-control" placeholder="Ejemplo: 12345" required>
        <button type="submit" class="btn btn-primary mt-3">Consultar</button>
    </form>
    <div id="resultadoTicket" class="mt-4">
        <!-- Aquí se mostrará el resultado de la consulta -->
    </div>
</div>

<script>
$(document).ready(function() {
    $("#formConsultaTicket").on("submit", function(event) {
        event.preventDefault();
        var numeroTicket = $("#numeroTicket").val();

        if (numeroTicket.trim() === "") {
            alert("Por favor, ingresa un número de ticket válido.");
            return;
        }

        // Realiza una petición AJAX para obtener los datos del ticket
        $.ajax({
            url: "https://saludapos.com/Tickets/Consultas/RegistroTicketSoporte.php",
            type: "GET",
            data: { No_Ticket: numeroTicket },
            dataType: "json",
            success: function(data) {
                if (data && data.Estatus) {
                    // Mostrar los datos del ticket
                    $("#resultadoTicket").html(`
                        <div class="card">
                            <div class="card-header">Estado del Ticket No. ${data.No_Ticket}</div>
                            <div class="card-body">
                                <p><strong>Sucursal:</strong> ${data.Sucursal}</p>
                                <p><strong>Reportado Por:</strong> ${data.Reportado_Por}</p>
                                <p><strong>Fecha de Registro:</strong> ${data.Fecha_Registro}</p>
                                <p><strong>Problemática:</strong> ${data.Problematica}</p>
                                <p><strong>Descripción:</strong> ${data.DescripcionProblematica}</p>
                                <p><strong>Solución:</strong> ${data.Solucion || "Sin solución aún"}</p>
                                <p><strong>Estatus:</strong> ${data.Estatus}</p>
                            </div>
                        </div>
                    `);
                } else {
                    // Si no se encuentra el ticket
                    $("#resultadoTicket").html(`
                        <div class="alert alert-warning" role="alert">
                            No se encontró información para el ticket No. ${numeroTicket}.
                        </div>
                    `);
                }
            },
            error: function() {
                $("#resultadoTicket").html(`
                    <div class="alert alert-danger" role="alert">
                        Ocurrió un error al consultar el ticket. Por favor, intenta de nuevo más tarde.
                    </div>
                `);
            }
        });
    });
});
</script>
