function CargaCreditosPorVencer(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CreditosPorVencer.php","",function(data){
      $("#tablaCreditosPorVencer").html(data);
    })

  }
  
  
  
  CargaCreditosPorVencer();