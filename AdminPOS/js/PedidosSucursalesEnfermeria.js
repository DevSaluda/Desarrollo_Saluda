function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/PedidosFarmacias.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();