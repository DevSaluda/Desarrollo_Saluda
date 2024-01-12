function   CargaProgramaMedicosSucursales(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/ProgramacionDeSucursales.php","",function(data){
      $("#ProgramaSucursales").html(data);
    })
  
  }
  
  
  CargaProgramaMedicosSucursales();

  

  
