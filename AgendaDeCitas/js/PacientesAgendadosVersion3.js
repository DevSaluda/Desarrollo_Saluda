function CargaAgenda(){


    $.post("https://saludapos.com/ControldecitasV2/Consultas/AgendaDePacientesNuevosV3.php","",function(data){
      $("#PacientesAgendados").html(data);
    })
  
  }
  
  
  
  CargaAgenda();

  
