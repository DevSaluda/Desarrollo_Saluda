function CategoriasGastos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CategoriasGastos.php","",function(data){
      $("#TableCatGastos").html(data);
    })

  }
  
  
  
  CategoriasGastos();