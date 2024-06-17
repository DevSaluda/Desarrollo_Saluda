function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/ControlDental/Consultas/CitasEnSucursalDeMiAgenda.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();



  
