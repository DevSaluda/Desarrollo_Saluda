function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/StockSucursalesV2.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();