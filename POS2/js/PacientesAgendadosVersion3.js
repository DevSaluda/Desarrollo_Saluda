function CargaAgenda(){


    $.post("https://saludapos.com/POS2/Consultas/AgendaDePacientesNuevosV3.php","",function(data){
      $("#PacientesAgendados").html(data);
    })
  
  }
  
  
  
  CargaAgenda();

  
