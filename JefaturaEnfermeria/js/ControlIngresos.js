function IngresosProductos(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/IngresosProductos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })
  
  }
  
  
  IngresosProductos();

  
