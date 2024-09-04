function  Traspasos(){


    $.post("https://saludapos.com/POS2/Consultas/StockTraspasos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  Traspasos();