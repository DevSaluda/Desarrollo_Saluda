function CargaCategorias(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/Categorias.php","",function(data){
      $("#TableCategorias").html(data);
    })
  
  }
  
  
  
  CargaCategorias();

  
  