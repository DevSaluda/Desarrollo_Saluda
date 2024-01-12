function CargaCitasEnSucursal(){


    $.post("https://controlconsulta.com/CEnfermeria/Consultas/CitasEnSucursal.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    })
  
  }
  
  
  
  CargaCitasEnSucursal();

  
