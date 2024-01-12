function CargaCostos(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/Costos.php","",function(data){
      $("#CostosEspeciales").html(data);
    })
  
  }
  
  
  
  CargaCostos();

  
