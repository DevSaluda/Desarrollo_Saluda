function RegistroEnergias() {


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroDeEnergia.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();