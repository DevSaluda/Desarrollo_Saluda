function  StockPorSucursales(){


    $.post("https://saludapos.com/POS2/Consultas/CambiosDePrecios.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  StockPorSucursales();