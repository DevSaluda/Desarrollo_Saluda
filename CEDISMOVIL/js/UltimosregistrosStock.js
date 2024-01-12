function UltimosregistrosStock(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/UltimosRegistrosEnStockPorUsuario.php","",function(data){
      $("#UltimasInserciones").html(data);
    })
  
  }
  
  
  
  UltimosregistrosStock();

  
  