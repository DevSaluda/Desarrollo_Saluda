function CargaCitasLabs() {


    $.get("https://controlfarmacia.com/POS2/Consultas/AgendadeLaboratorios.php", "", function(data) {
        $("#PacientesLabs").html(data);
    })

}



CargaCitasLabs();