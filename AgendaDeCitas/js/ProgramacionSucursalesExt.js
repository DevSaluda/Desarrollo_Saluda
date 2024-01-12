function   CargaProgramaMedicosSucursalesExt(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/ProgramacionDeSucursalesExt.php","",function(data){
      $("#ProgramaSucursalesExt").html(data);
    })
  
  }
  
  
  CargaProgramaMedicosSucursalesExt();

  

  
