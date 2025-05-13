function CargaCostos(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/CostosVencidos.php","",function(data){
      $("#CostosEspeciales").html(data);
    })
  
  }
  
  
  
  CargaCostos();

  
