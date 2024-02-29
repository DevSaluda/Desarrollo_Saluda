function CargaHorarios(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/HorariosG.php","",function(data){
      $("#HorariosCampanas").html(data);
    })
  
  }
  
  
  
  CargaHorarios();

  
