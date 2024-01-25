function CargaCategorias(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Categorias.php","",function(data){
      $("#TableCategorias").html(data);
    })
  
  }
  
  
  
  CargaCategorias();

  
  