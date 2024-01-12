function   CargaAltaPacientes(){


    $.post("https://controlconsulta.com/Enfermeria2/Consultas/DataPacientes.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  CargaAltaPacientes();

  

  
