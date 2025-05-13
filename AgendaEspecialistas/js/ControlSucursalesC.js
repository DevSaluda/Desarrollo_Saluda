function CargaSucursalesC(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/SucursalesC.php","",function(data){
      $("#SucursalesC").html(data);
    })
  
  }
  
  
  
  CargaSucursalesC();

  
