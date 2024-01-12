function CargaCitasEnSucursalExt(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
