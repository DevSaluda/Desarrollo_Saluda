function CargaFechas(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/FechasGenerales.php","",function(data){
      $("#FechasCampanas").html(data);
    })
  
  }
  
  
  
  CargaFechas();

  
