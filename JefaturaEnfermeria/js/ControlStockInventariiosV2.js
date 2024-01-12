function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/InventariosDescarga.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();