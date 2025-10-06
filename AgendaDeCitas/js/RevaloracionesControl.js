function CargaRevaloraciones(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadasVista.php","",function(data){
      $("#RevaloracionesAgendadas").html(data);
    })

  }
  
  
  
  CargaRevaloraciones();

function CargaRevaloraciones() {


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();


