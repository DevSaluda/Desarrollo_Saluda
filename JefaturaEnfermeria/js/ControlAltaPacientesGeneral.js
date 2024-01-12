function CargaAltaPacientes(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/AltadePacientesGeneral.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
   
  
  CargaAltaPacientes();

  
