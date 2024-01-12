function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/StockEntradas.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();