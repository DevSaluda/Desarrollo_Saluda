function CargaCitasEnSucursal(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/CitasEnSucursal.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
