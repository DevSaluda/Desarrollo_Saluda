function CargaHorarios(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/HorariosV.php","",function(data){
      $("#HorariosCampanas").html(data);
    })
  
  }
  
  
  
  CargaHorarios();

  
