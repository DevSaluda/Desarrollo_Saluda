function CargaCostos(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/Costos.php","",function(data){
      $("#CostosEspeciales").html(data);
    })
  
  }
  
  
  
  CargaCostos();

  
