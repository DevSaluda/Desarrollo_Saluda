function  Traspasos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/StockTraspasos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  Traspasos();