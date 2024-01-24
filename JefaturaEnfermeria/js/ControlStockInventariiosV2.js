function  StockPorSucursales(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/InventariosDescarga.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();