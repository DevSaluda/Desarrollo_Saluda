function CargaAgenda(){


    $.post("https://controlfarmacia.com/POS2/Consultas/AgendaDePacientesNuevosV3.php","",function(data){
      $("#PacientesAgendados").html(data);
    })
  
  }
  
  
  
  CargaAgenda();

  
