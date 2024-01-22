function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/VistaAjustesInventarios.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();