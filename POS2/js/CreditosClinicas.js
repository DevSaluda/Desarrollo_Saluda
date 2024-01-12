function CargaCreditosClinicas(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CreditosDeClinicas.php","",function(data){
      $("#tablaCreditosClinicas").html(data);
    })

  }
  
  
  
  CargaCreditosClinicas();