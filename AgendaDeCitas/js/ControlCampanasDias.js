function CargaPacientesAgenda(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/CampanasDias.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaPacientesAgenda();
