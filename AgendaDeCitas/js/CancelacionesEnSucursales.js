function CargaCancelacionesSucursales(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/CancelacionesSucursales.php","",function(data){
      $("#CitasCanceladasSucursal").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesSucursales();

  
