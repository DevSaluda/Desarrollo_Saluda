function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/ControlDental/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();



  
