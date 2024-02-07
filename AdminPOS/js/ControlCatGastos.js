function CategoriasGastos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/CategoriasGastos.php","",function(data){
      $("#TableCatGastos").html(data);
    })

  }
  
  
  
  CategoriasGastos();