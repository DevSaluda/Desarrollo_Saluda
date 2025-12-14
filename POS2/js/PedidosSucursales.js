function CargaVentasDelDia(){


    $.post("https://saludapos.com/POS2/Consultas/PedidosFarmacias.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();