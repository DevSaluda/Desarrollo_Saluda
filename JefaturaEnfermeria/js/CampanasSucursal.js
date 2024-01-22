function CargaCampanas(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/CampanasSucursal.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
