function CargaRevaloraciones() {


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/LaboratoriosAgendados.php", "", function(data) {
        $("#CitasDeLaboratorio").html(data);
    })

}
CargaRevaloraciones();


