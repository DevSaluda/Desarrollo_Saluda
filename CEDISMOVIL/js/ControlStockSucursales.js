function  StockPorSucursales(){


    $.post("https://saludapos.com/CEDISMOVIL/Consultas/StockSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();