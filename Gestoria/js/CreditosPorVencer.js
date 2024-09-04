function CargaCreditosPorVencer(){


    $.post("https://saludapos.com/POS2/Consultas/CreditosPorVencer.php","",function(data){
      $("#tablaCreditosPorVencer").html(data);
    })

  }
  
  
  
  CargaCreditosPorVencer();