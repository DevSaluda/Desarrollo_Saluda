function RegistroEnergias() {


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/RegistroDeEnergia.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();