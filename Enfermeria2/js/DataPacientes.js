function   CargaAltaPacientes(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/DataPacientes.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  CargaAltaPacientes();

  

  
