function CargaCitasEnSucursal(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/CitasEnSucursalDias.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
