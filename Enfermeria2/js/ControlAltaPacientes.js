function CargaAltaPacientes(){


    $.get("https://saludapos.com/Enfermeria2/Consultas/AltadePacientes.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
  
  
  CargaAltaPacientes();

  
