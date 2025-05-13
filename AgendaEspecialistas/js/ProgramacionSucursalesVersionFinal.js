function   CargaProgramaMedicosSucursalesExt(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/ProgramacionDeSucursalesExtNuevaVersion.php","",function(data){
      $("#ProgramaSucursalesExt").html(data);
    })
  
  }
  
  
  CargaProgramaMedicosSucursalesExt();

  

  
