function CargaCitasEnSucursal(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursal.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
