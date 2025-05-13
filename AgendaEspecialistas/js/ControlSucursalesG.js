function CargaSucursalesG(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/SucursalesG.php","",function(data){
      $("#SucursalesG").html(data);
    })
  
  }
  
  
  
  CargaSucursalesG();

  
