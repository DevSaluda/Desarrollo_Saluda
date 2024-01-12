function CargaCitasEnSucursal(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/CitasEnSucursal.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
