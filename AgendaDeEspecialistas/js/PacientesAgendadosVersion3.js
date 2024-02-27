function CargaAgenda(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/AgendaDePacientesNuevosV3.php","",function(data){
      $("#PacientesAgendados").html(data);
    })
  
  }
  
  
  
  CargaAgenda();

  
