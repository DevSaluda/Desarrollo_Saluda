function RegistroEnergias() {


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroCombustible.php", "", function(data) {
        $("#RegistrosDeCombustibles").html(data);
    })

}



RegistroEnergias();