function CargaAltaPacientes(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/AltadePacientes.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
   
  
  CargaAltaPacientes();

  
