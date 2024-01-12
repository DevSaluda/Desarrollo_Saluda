function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/POS2/Consultas/StockSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();