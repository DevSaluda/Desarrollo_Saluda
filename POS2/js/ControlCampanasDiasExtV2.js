function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
