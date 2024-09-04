function   CargaAltaPacientes(){


    $.post("https://controlfarmacia.com/POS2/Consultas/DataPacientes.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  CargaAltaPacientes();

  

  
