function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
