function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/EstadisticaVentasSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();