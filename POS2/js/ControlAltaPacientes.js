function CargaAltaPacientes(){


    $.get("https://controlfarmacia.com/POS2/Consultas/AltadePacientes.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
  
  
  CargaAltaPacientes();

  
