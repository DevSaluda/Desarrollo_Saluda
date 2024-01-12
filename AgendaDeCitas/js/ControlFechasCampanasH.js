function CargaFechasH(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/FechasH.php","",function(data){
      $("#FechasCampanas").html(data);
    })
  
  }
  
  
  
  CargaFechasH();

  
