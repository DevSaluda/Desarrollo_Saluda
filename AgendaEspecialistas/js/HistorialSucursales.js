function CargaSucursalesH(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/SucursalesH.php","",function(data){
      $("#SucursalesH").html(data);
    })
  
  }
  
  
  
  CargaSucursalesH();

  
