function CargaHorarios(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/Horarios.php","",function(data){
      $("#HorariosCampanas").html(data);
    })
  
  }
  
  
  
  CargaHorarios();

  
