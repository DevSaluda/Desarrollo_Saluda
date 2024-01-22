function CargaCitasEnSucursal(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/CitasEnSucursalDias.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
