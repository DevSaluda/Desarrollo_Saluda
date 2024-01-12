function UltimosregistrosStock(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/UltimosRegistrosEnStockPorUsuario.php","",function(data){
      $("#UltimasInserciones").html(data);
    })
  
  }
  
  
  
  UltimosregistrosStock();

  
  