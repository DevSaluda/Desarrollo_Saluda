function CargaRevaloraciones() {


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/LaboratoriosAgendado.php", "", function(data) {
        $("#CitasDeLaboratorio").html(data);
    })

}
CargaRevaloraciones();


