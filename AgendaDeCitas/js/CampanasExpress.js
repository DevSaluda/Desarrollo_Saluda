function CargaCitasEnSucursalExt(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();



  
