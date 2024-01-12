function CargaCitasEnSucursalExt(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
