function UltimosregistrosStock(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/UltimosRegistrosEnStockPorUsuario.php","",function(data){
      $("#UltimasInserciones").html(data);
    })
  
  }
  
  
  
  UltimosregistrosStock();

  
  