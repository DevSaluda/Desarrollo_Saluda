function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDiaCreditoEnfermeria.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();