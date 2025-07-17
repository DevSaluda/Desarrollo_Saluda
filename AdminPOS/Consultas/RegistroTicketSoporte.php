<script>
$(document).ready(function() {
    var tabla = $('#Tickets').DataTable({
        "bProcessing": true,
        "ordering": true,
        "stateSave": true,
        "bAutoWidth": false,
        "order": [[0, "desc"]],
        "ajax": {
            "url": "https://saludapos.com/AdminPOS/Consultas/RegistroTicketSoporteArray.php",
            "dataSrc": "aaData"
        },
        "columns": [
    { "data": "Id_Ticket" },
    { "data": "No_Ticket" },
    { "data": "Sucursal" },
    { "data": "Reportado_Por" },
    { "data": "Fecha_Registro" },
    { "data": "Problematica" },
    { "data": "DescripcionProblematica" },
    { "data": "Solucion" },
    { "data": "Estatus" },
    { "data": "Asignado" },
    { "data": "TipoTicket" },
    {
        "data": null,
        "render": function(data, type, row) {
            // Se asume que usuarioActual es global y contiene el nombre del usuario logueado
            let acciones = '';
            if (!row.Asignado || row.Asignado === '' || row.Asignado === null) {
                acciones += `<button class='btn btn-success btn-sm asignar-btn' data-id='${row.Id_Ticket}'>Revisar</button> `;
                acciones += `<button class='btn btn-info btn-sm cambiar-tipo' data-id='${row.Id_Ticket}' data-tipo='Mantenimiento'>Mandar a Mantenimiento</button>`;
            } else if (row.Asignado === usuarioActual) {
                acciones += `<button class='btn btn-primary btn-sm solucion-btn' data-id='${row.Id_Ticket}' data-toggle='modal' data-target='#SolucionModal'>Marcar Solución</button>`;
            }
            return acciones;
        }
    }
],

        "lengthMenu": [[10, 20, 150, 250, 500, -1], [10, 20, 50, 250, 500, "Todos"]],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando..."
        },
        responsive: true
    });

    // Evento para los botones de cambio de tipo
    $('#Tickets').on('click', '.cambiar-tipo', function() {
        var idTicket = $(this).data('id');
        var tipo = $(this).data('tipo');
        $.ajax({
            url: 'https://saludapos.com/AdminPOS/Consultas/ActualizarTipoTicket.php',
            type: 'POST',
            data: { Id_Ticket: idTicket, TipoTicket: tipo },
            success: function(response) {
                tabla.ajax.reload(null, false); // Refresca la tabla sin cambiar de página
            },
            error: function() {
                alert('Error al actualizar el tipo de ticket.');
            }
        });
    });

    // Evento para asignar ticket al usuario actual
    $('#Tickets').on('click', '.asignar-btn', function() {
        var idTicket = $(this).data('id');
        $.ajax({
            url: 'https://saludapos.com/AdminPOS/Consultas/AsignarTicket.php',
            type: 'POST',
            data: { Id_Ticket: idTicket, Asignado: usuarioActual },
            success: function(response) {
                tabla.ajax.reload(null, false);
            },
            error: function() {
                alert('Error al asignar el ticket.');
            }
        });
    });

    // Evento para abrir modal de solución
    var ticketActual = null;
    $('#Tickets').on('click', '.solucion-btn', function() {
        ticketActual = $(this).data('id');
        // Aquí puedes mostrar el modal y usar ticketActual para guardar la solución luego
    });
});
</script>

<div class="text-center">
    <div class="table-responsive">
        <table id="Tickets" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No. Ticket</th>
                    <th>Sucursal</th>
                    <th>Reportado Por</th>
                    <th>Fecha de Registro</th>
                    <th>Problemática</th>
                    <th>Descripción</th>
                    <th>Solución</th>
                    <th>Estatus</th>
                    <th>Asignado</th>
                    <th>Tipo de Ticket</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
