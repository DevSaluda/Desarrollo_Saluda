function RegistroGastos(){


    $.post("https://saludapos.com/POS2/Consultas/GastosDeSucursales.php","",function(data){
      $("#TableGastosSuc").html(data);
    })

  }
  
  
  
  RegistroGastos();