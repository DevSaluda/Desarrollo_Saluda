function CargaAltaPacientes(){


    $.get("https://controlfarmacia.com/Enfermeria2/Consultas/AltadePacientes.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
  
  
  CargaAltaPacientes();

  
