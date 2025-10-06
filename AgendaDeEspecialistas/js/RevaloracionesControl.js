function CargaRevaloraciones(){


    $.post("https://saludapos.com/AgendaDeEspecialistas/Consultas/RevaloracionesAgendadas.php","",function(data){
      $("#CitasDeRevaloracion").html(data);
    })

  }
  
  
  
  CargaRevaloraciones();


