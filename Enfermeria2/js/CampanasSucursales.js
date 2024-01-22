function CargaCitasEnSucursal(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/CitasEnSucursal.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
