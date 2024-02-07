function UltimosregistrosStock(){


    $.get("https://saludapos.com/AdminPOS/Consultas/UltimosRegistrosEnStockPorUsuario.php","",function(data){
      $("#UltimasInserciones").html(data);
    })
  
  }
  
  
  
  UltimosregistrosStock();

  
  