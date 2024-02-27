function CargaCampanasH(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/HistorialCitas.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanasH();

  
