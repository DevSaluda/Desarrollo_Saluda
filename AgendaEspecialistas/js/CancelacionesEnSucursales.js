function CargaCancelacionesSucursales(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/CancelacionesSucursales.php","",function(data){
      $("#CitasCanceladasSucursal").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesSucursales();

  
