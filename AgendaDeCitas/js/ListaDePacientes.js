function CargaDatadePX(){


    $.get("https://saludapos.com/AgendaDeCitas/Consultas/DataPacientesGeneral.php","",function(data){
      $("#DataPacientes").html(data);
    })
  
  }
  
  
  CargaDatadePX();

  
