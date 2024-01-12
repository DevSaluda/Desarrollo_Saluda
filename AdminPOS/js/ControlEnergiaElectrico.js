function RegistroEnergias() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/RegistroDeEnergia.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();