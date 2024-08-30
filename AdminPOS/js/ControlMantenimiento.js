function RegistroEnergias() {


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroDeMantenimiento.php", "", function(data) {
        $("#RegistrosEnergiatabla").html(data);
    })

}



RegistroEnergias();