function CargaRevaloraciones() {


    $.post("https://saludapos.com/Enfermeria2/Consultas/LaboratoriosAgendados.php", function(data) {
        $("#CitasDeLaboratorio").html(data);
    })

}
CargaRevaloraciones();


