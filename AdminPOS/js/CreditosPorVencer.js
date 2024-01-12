function CargaCreditosPorVencer(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CreditosPorVencer.php","",function(data){
      $("#tablaCreditosPorVencer").html(data);
    })

  }
  
  
  
  CargaCreditosPorVencer();