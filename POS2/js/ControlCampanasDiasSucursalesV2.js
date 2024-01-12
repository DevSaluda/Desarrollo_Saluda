function CargaCitasEnSucursal(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CitasEnSucursalDias.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
