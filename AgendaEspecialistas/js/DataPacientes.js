function   CargaAltaPacientes(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/DataPacientes.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  CargaAltaPacientes();

  

  
