function   CargaProgramaMedicosSucursalesExt(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/ProgramacionDeSucursalesExtNuevaVersion.php","",function(data){
      $("#ProgramaSucursalesExt").html(data);
    })
  
  }
  
  
  CargaProgramaMedicosSucursalesExt();

  

  
