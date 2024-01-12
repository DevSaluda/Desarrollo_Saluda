function CargaPacientes(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/PacientesV2.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  
  CargaPacientes();

  
