function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/PedidosFarmacias.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();