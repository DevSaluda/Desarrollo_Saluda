function RegistroEnergias() {


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/RegistroCombustible.php", "", function(data) {
        $("#RegistrosDeCombustibles").html(data);
    })

}



RegistroEnergias();