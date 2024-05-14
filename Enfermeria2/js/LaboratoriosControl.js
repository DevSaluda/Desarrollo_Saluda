function CargaRevaloraciones() {


    $.post("https://saludapos.com/Enfermeria2/Consultas/LaboratoriosAgendado.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();


