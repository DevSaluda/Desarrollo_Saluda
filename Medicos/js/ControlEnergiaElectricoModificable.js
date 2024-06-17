function RegistroEnergias() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/RegistroDeEnergiaSeleccionable.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();