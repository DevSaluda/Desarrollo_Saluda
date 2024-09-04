function CargaCostos(){


    $.get("https://controlfarmacia.com/POS2/Consultas/StockVentasProd.php","",function(data){
      $("#ProductosVenta").html(data);
    })
  
  }
  
  
  
  CargaCostos();

  