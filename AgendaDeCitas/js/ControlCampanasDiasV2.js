function CargaPacientesAgendaV2(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/CampanasDiasV2.php","",function(data){
      $("#TablaCampanasV2").html(data);
    })
  
  }
  
  
  
  CargaPacientesAgendaV2();
