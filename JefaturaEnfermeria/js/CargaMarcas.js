function CargaMarcas(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Marcas.php","",function(data){
      $("#TableMarcas").html(data);
    })
  
  }
  
  
  
  CargaMarcas();

  
  