function CargaPacientes(){


    $.get("https://saludapos.com/ServiciosEspecializados/Consultas/Pacientes.php","",function(data){
      $("#TablaPacientes").html(data);
    })
  
  }
  
  
  
  CargaPacientes();

  
