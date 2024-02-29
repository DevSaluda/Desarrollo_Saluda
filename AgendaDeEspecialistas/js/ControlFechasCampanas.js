function CargaFechas(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/Fechas.php","",function(data){
      $("#FechasCampanas").html(data);
    })
  
  }
  
  
  
  CargaFechas();

  
