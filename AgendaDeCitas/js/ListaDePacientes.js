function CargaDatadePX(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/DataPacientesGeneral.php","",function(data){
      $("#DataPacientes").html(data);
    })
  
  }
  
  
  CargaDatadePX();

  
