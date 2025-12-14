function CargaCostos(){


    $.get("https://saludapos.com/POS2/Consultas/StockVentasProd.php","",function(data){
      $("#ProductosVenta").html(data);
    })
  
  }
  
  
  
  CargaCostos();

  