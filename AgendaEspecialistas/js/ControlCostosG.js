function CargaCostos(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/CostosG.php","",function(data){
      $("#CostosEspeciales").html(data);
    })
  
  }
  
  
  
  CargaCostos();

  
