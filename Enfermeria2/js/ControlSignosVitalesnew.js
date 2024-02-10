function CargaPacientesNuevos(){


    $.get("https://saludapos.com/Enfermeria2/Consultas/PacientesNuevoSig.php","",function(data){
      $("#DataSignos").html(data);
    })
  
  }
  
  
  
  CargaPacientesNuevos();

  
