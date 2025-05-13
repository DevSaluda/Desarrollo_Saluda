function CargaCampanas(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/CampanasViejas.php","",function(data){
      $("#TableCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
