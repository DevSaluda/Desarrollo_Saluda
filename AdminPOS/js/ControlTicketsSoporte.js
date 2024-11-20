function RegistroEnergias() {


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroTicketSoporte.php", "", function(data) {
        $("#RegistrosTicketSoporteTabla").html(data);
    })

}



RegistroEnergias();