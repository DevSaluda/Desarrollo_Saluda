function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
