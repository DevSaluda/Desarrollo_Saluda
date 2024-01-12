function CargaCostosH(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/CostosH.php","",function(data){
      $("#CostosEspeciales").html(data);
    })
  
  }
  
  
  
  CargaCostosH();

  
