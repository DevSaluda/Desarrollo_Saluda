function CargaCampanas(){


    $.get("https://saludapos.com/Enfermeria2/Consultas/CampanasSucursal.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
