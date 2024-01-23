function CargaVentasDelDia(){


    $.post("https://saludapos.com/POS2/Consultas/InventarioRapidoResultados.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();