function CargaCitasEnSucursalExt(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
