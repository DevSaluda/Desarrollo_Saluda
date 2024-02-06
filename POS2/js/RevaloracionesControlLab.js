function CargaCitasLabs() {


    $.get("https://saludapos.com/POS2/Consultas/AgendadeLaboratorios.php", "", function(data) {
        $("#PacientesLabs").html(data);
    })

}



CargaCitasLabs();