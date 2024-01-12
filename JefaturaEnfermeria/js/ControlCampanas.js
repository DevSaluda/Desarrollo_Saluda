function CargaCampanas(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/Campanas.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanas();

  
