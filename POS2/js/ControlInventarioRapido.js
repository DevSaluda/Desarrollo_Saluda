function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/InventarioRapidoResultados.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();