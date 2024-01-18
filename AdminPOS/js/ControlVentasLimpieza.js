function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDiaCreditoLimpieza.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();