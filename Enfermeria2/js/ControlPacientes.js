function CargaPacientes(){


    $.get("https://saludapos.com/Enfermeria2/Consultas/Pacientes.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
  
  
  CargaPacientes();

  
