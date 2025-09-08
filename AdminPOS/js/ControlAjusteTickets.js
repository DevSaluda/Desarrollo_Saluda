/**
 * JavaScript para el control de ajuste de tickets
 * Desarrollo_Saluda/AdminPOS/js/ControlAjusteTickets.js
 */

function CargaAjusteTickets(){
    $.post("https://saludapos.com/AdminPOS/Consultas/ConsultaAjusteTickets.php","",function(data){
        $("#TableAjusteTickets").html(data);
    })
}

$(document).ready(function() {
    // Cargar la tabla inicial
    CargaAjusteTickets();
});
