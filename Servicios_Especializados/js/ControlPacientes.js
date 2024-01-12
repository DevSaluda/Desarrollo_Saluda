function CargaPacientes(){


    $.get("https://controlfarmacia.com/Servicios_Especializados/Consultas/Pacientes.php","",function(data){
      $("#TablaPacientes").html(data);
    })
  
  }
  
  
  
  CargaPacientes();

  
