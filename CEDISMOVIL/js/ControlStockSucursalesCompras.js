function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/StockSucursalesCompras.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();