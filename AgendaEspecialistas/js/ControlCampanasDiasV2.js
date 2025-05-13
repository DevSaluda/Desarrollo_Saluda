function CargaPacientesAgendaV2(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/CampanasDiasV2.php","",function(data){
      $("#TablaCampanasV2").html(data);
    })
  
  }
  
  
  
  CargaPacientesAgendaV2();
