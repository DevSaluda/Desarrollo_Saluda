function  StockPorSucursales(){


    $.post("https://saludapos.com/AdminPOS/Consultas/InventariosDescarga.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();