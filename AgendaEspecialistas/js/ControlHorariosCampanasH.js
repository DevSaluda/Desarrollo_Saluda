function CargaHorariosH(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/HorariosH.php","",function(data){
      $("#HorariosCampanas").html(data);
    })
  
  }
  
  
  
  CargaHorariosH();

  
