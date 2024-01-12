function CargaCreditosPorVencer(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/CreditosPorVencer.php","",function(data){
      $("#tablaCreditosPorVencer").html(data);
    })

  }
  
  
  
  CargaCreditosPorVencer();