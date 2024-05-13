function CargaRevaloraciones() {


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/LaboratoriosAgendados.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();


