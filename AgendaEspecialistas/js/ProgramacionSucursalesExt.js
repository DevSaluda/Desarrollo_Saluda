function   CargaProgramaMedicosSucursalesExt(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/ProgramacionDeSucursalesExt.php","",function(data){
      $("#ProgramaSucursalesExt").html(data);
    })
  
  }
  
  
  CargaProgramaMedicosSucursalesExt();

  

  
