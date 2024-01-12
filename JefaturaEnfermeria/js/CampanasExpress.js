function CargaCitasEnSucursalExt(){


    $.post("https://controlconsulta.com/CEnfermeria/Consultas/CitasEnSucursalExt.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursalExt();



  
