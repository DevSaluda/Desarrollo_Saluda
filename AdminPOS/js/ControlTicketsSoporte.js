function RegistroEnergias() {


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroTicketSoporteModal.php", "", function(data) {
        $("#RegistrosTicketSoporteTabla").html(data);
    })

}



RegistroEnergias();