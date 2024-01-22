function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
