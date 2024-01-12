function CargaAgenda(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/AgendaDePacientesNuevosV3.php","",function(data){
      $("#PacientesAgendados").html(data);
    })
  
  }
  
  
  
  CargaAgenda();

  
