function CargaSucursalesH(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/SucursalesH.php","",function(data){
      $("#SucursalesH").html(data);
    })
  
  }
  
  
  
  CargaSucursalesH();

  
