function CategoriasGastos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/CategoriasGastos.php","",function(data){
      $("#TableCatGastos").html(data);
    })

  }
  
  
  
  CategoriasGastos();