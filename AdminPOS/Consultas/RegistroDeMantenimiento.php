<script>
$(document).ready(function() {
    var tabla = $('#Productos').DataTable({
        "bProcessing": true,
        "ordering": true,
        "stateSave": true,
        "bAutoWidth": false,
        "order": [[0, "desc"]],
        "ajax": {
            "url": "https://saludapos.com/AdminPOS/Consultas/RegistroMantenimientoArray.php",
            "dataSrc": "aaData"
        },
        "columns": [
            { "data": "Id_Registro" },
            { "data": "Registro_mantenimiento" },
            { "data": "Fecha_registro" },
            { "data": "Sucursal" },
            { "data": "Comentario" },
            { "data": "Foto", "render": function(data, type, row) {
                return data; // No es necesario modificar 'data' ya que es HTML generado por PHP
            }}
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
        <table id="Productos" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Registro de Mantenimiento</th>
                    <th>Fecha</th>
                    <th>Sucursal</th>
                    <th>Comentario</th>
                    <th>Foto</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
