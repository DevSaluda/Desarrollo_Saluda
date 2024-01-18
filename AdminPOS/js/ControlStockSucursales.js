function  StockPorSucursales(){


    $.post("https://saludapos.com/AdminPOS/Consultas/StockSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();