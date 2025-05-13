function CargaHorarios(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/Horarios.php","",function(data){
      $("#HorariosCampanas").html(data);
    })
  
  }
  
  
  
  CargaHorarios();

  
