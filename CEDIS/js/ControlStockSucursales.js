function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/StockSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();