function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/VentasDelDiaCreditoLimpieza.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();