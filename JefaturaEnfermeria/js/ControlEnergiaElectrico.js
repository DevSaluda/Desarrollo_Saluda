function RegistroEnergias() {


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/RegistroDeEnergia.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();