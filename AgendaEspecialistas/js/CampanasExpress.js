function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();



  
