function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/VistaAjustesInventarios.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();