function  StockPorSucursales(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/VistaAjustesInventarios.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();