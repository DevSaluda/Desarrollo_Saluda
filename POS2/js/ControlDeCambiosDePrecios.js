function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CambiosDePrecios.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  StockPorSucursales();