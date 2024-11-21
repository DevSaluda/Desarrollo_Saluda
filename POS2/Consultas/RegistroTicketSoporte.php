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
    { "data": "Estatus" }
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
                </tr>
            </thead>
        </table>
    </div>
</div>
