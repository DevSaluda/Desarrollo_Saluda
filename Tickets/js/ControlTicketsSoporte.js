function RegistroEnergias() {


    $.post("https://saludapos.com/Tickets/Consultas/RegistroTicketSoporte.php", "", function(data) {
        $("#resultadoTicket").html(data);
    })

}



RegistroEnergias();