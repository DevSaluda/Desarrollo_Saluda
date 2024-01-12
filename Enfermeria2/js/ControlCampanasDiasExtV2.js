function CargaCitasEnSucursalExt(){


    $.post("https://controlfarmacia.com/Enfermeria2/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
