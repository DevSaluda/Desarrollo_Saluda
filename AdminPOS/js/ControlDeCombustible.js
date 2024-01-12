function RegistroEnergias() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/RegistroCombustible.php", "", function(data) {
        $("#RegistrosDeCombustibles").html(data);
    })

}



RegistroEnergias();