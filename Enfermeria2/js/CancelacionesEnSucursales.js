function CargaCancelacionesSucursales(){


    $.post("https://controlfarmacia.com/Enfermeria2/Consultas/CancelacionesSucursales.php","",function(data){
      $("#CitasCanceladasSucursal").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesSucursales();

  
