function CargaAgenda(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/AgendaDePacientesNuevosV3.php","",function(data){
      $("#PacientesAgendados").html(data);
    })
  
  }
  
  
  
  CargaAgenda();

  
