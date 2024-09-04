function RegistroEnergias() {


    $.post("https://saludapos.com/POS2/Consultas/RegistroDeEnergia.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();