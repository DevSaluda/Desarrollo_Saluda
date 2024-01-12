function CargaCitasEnSucursal(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CitasEnSucursal.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
