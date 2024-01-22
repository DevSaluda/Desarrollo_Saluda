function CargaCancelacionesSucursales(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/CancelacionesSucursales.php","",function(data){
      $("#CitasCanceladasSucursal").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesSucursales();

  
