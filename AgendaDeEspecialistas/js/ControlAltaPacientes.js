function CargaAltaPacientes(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/AltadePacientes.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
   
  
  CargaAltaPacientes();

  
