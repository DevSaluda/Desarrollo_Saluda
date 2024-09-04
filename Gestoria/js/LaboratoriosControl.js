function CargaRevaloraciones() {


    $.post("https://saludapos.com/POS2/Consultas/LaboratoriosAgendados.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();


