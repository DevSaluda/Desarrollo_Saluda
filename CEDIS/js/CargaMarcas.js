function CargaMarcas(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/Marcas.php","",function(data){
      $("#TableMarcas").html(data);
    })
  
  }
  
  
  
  CargaMarcas();

  
  