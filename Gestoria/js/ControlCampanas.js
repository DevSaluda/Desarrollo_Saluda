function CargaCampanas(){


    $.get("https://controlfarmacia.com/POS/Consultas/CampanasF.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
