function CargaRevaloraciones() {


    $.post("https://saludapos.com/Enfermeria2/Consultas/LaboratoriosAgendado.php", "", function(data) {
        $("#CitasDeLaboratorio").html(data);
    })

}
CargaRevaloraciones();


