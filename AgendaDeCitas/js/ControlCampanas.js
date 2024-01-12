function CargaCampanas(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/Campanas.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
