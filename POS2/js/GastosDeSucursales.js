function RegistroGastos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/GastosDeSucursales.php","",function(data){
      $("#TableGastosSuc").html(data);
    })

  }
  
  
  
  RegistroGastos();