function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/AgendaDeEspecialistas/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
