function CargaCategorias(){


    $.get("https://saludapos.com/AdminPOS/Consultas/Categorias.php","",function(data){
      $("#TableCategorias").html(data);
    })
  
  }
  
  
  
  CargaCategorias();

  
  