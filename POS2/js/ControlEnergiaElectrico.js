function RegistroEnergias() {


    $.post("https://controlfarmacia.com/POS2/Consultas/RegistroDeEnergia.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();