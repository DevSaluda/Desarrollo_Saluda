function RegistroEnergias() {


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/RegistroCombustible.php", "", function(data) {
        $("#RegistrosDeCombustibles").html(data);
    })

}



RegistroEnergias();