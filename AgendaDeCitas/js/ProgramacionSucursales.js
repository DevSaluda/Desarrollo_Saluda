function   CargaProgramaMedicosSucursales(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/ProgramacionDeSucursales.php","",function(data){
      $("#ProgramaSucursales").html(data);
    })
  
  }
  
  
  CargaProgramaMedicosSucursales();

  

  
