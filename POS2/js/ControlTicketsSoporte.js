function RegistroEnergias() {


    $.post("https://saludapos.com/POS2/Consultas/RegistroTicketSoporte.php", "", function(data) {
        $("#RegistrosTicketSoporteTabla").html(data);
    })

}



RegistroEnergias();