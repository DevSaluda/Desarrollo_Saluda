function CargaMarcas(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Marcas.php","",function(data){
      $("#TableMarcas").html(data);
    })
  
  }
  
  
  
  CargaMarcas();

  
  