function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/StockCedis.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();