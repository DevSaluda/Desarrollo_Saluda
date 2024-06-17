function  StockPorSucursales(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VistaAjustesInventarios.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();