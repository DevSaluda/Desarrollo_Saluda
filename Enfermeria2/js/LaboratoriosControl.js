function CargaLaboratorios() {


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/laboratoriosAgendados.php", "", function(data) {
        $("#CargaCitasLabs").html(data);
    })

}



CargaLaboratorios();