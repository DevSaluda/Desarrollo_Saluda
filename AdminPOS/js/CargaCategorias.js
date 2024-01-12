function CargaCategorias(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Categorias.php","",function(data){
      $("#TableCategorias").html(data);
    })
  
  }
  
  
  
  CargaCategorias();

  
  