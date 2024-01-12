function CargaFechas(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/FechasVencidas.php","",function(data){
      $("#FechasCampanas").html(data);
    })
  
  }
  
  
  
  CargaFechas();

  
