function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/AgendaDeEspecialistas/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();



  
