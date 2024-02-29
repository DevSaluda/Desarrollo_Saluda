function CargaSucursales(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/Sucursales.php","",function(data){
      $("#SucursalesEspecialistas").html(data);
    })
  
  }
  
  
  
  CargaSucursales();

  
