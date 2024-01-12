function CargaCategorias(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Categorias.php","",function(data){
      $("#TableCategorias").html(data);
    })
  
  }
  
  
  
  CargaCategorias();

  
  