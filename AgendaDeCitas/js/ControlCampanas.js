function CargaCampanas(){


    $.get("https://saludapos.com/AgendaDeCitas/Consultas/Campanas.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
