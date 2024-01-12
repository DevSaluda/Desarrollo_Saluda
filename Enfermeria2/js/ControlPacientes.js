function CargaPacientes(){


    $.get("https://controlfarmacia.com/Enfermeria2/Consultas/Pacientes.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
  
  
  CargaPacientes();

  
