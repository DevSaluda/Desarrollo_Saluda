function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/InventariosDescarga.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();