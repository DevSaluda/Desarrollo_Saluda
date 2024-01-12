function CargaPacientesNuevos(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/PacientesNuevoSig.php","",function(data){
      $("#DataSignos").html(data);
    })
  
  }
  
  
  
  CargaPacientesNuevos();

  
