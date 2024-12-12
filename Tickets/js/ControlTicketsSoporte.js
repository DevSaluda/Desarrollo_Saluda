function RegistroSoporte() {


    $.post("https://saludapos.com/Tickets/Consultas/RegistroTicketSoporte.php", "", function(data) {
        $("#RegistrosTicketSoporteTabla").html(data);
    })

}



RegistroSoporte();