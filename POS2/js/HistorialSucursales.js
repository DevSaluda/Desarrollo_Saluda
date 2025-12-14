function CargaSucursalesH(){


    $.get("https://saludapos.com/Controldecitas/Consultas/SucursalesH.php","",function(data){
      $("#SucursalesH").html(data);
    })
  
  }
  
  
  
  CargaSucursalesH();

  
