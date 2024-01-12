function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/CEDISMOVIL/Consultas/StockSucursalesV3.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();