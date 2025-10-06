<?php
include "../Consultas/Consultas.php";
?>
<div class="text-center">
    <div class="table-responsive">
        <table id="CitasExteriores" class="table table-hover">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Paciente</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Sucursal</th>
                    <th>Médico</th>
                    <th>Turno</th>
                    <th>Motivo Consulta</th>
                    <th>Contacto por WhatsApp</th>
                    <th>Agendado por</th>
                    <th>Agregado el</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    $('#CitasExteriores').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "stateSave":true,
        "bAutoWidth": false,
        "order": [[ 0, "desc" ]],
        "ajax": {
            "url": "https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php",
            "type": "POST"
        },
        "columns": [
            { "data": 0 },
            { "data": 1 },
            { "data": 2 },
            { "data": 3 },
            { "data": 4 },
            { "data": 5 },
            { "data": 6 },
            { "data": 7 },
            { "data": 8, "orderable": false, "searchable": false },
            { "data": 9 },
            { "data": 10 },
            { "data": 11, "orderable": false, "searchable": false }
        ],
        "lengthMenu": [[10,20,150,250,500, -1], [10,20,50,250,500, "Todos"]],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "sPaginationType": "extStyle",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "paginate": {
                "first": '<i class="fas fa-angle-double-left"></i>',
                "last": '<i class="fas fa-angle-double-right"></i>',
                "next": '<i class="fas fa-angle-right"></i>',
                "previous": '<i class="fas fa-angle-left"></i>'
            }
        },
        "drawCallback": function() {
            $(".btn-Asiste").click(function(){
                var id = $(this).data("id");
                $.post("https://saludapos.com/AgendaDeCitas/Modales/AsistenciaPacienteRevaloracion.php", 
                    "id=" + id, 
                    function(data){
                        $("#form-editExt").html(data);
                        $("#TituloExt").html("¿El paciente asistió?");
                        $("#DiExt").removeClass("modal-dialog modal-lg modal-notify modal-success");
                        $("#DiExt").addClass("modal-dialog modal-sm modal-notify modal-success");
                    });
                $('#editModalExt').modal('show');
            });
        }
    });
});
</script>

