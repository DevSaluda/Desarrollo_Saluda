function CargaCitasEnSucursalExt(){


    $.post("https://controlfarmacia.com/Enfermeria2/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
