function CargaCitasEnSucursal(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursalDias.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
