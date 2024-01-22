function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
