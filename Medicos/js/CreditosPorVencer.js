function CargaCreditosPorVencer(){


    $.post("https://saludapos.com/AdminPOS/Consultas/CreditosPorVencer.php","",function(data){
      $("#tablaCreditosPorVencer").html(data);
    })

  }
  
  
  
  CargaCreditosPorVencer();