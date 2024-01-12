function CargaSucursalesC(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/SucursalesC.php","",function(data){
      $("#SucursalesC").html(data);
    })
  
  }
  
  
  
  CargaSucursalesC();

  
