$(".btn-edit").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/CortesDeCaja.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").html("Corte de caja");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-info");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-warning");
    });
    $('#editModal').modal('show');
});


$(".btn-cancelacion").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/SolicitarCancelacion.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").html("Solicitar cancelación");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-warning");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-info");
    });
    $('#editModal').modal('show');
});