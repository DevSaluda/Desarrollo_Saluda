function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/VentasDelDiaCreditoEnfermeria.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();