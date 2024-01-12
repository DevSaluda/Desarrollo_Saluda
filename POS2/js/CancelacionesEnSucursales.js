function CargaCancelacionesSucursales(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CancelacionesSucursales.php","",function(data){
      $("#CitasCanceladasSucursal").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesSucursales();

  
