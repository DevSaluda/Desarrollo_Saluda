function CargaCampanas(){


    $.get("https://controlfarmacia.com/Enfermeria2/Consultas/CampanasSucursal.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
