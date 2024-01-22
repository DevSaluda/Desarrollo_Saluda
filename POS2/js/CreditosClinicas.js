function CargaCreditosClinicas(){


    $.post("https://saludapos.com/POS2/Consultas/CreditosDeClinicas.php","",function(data){
      $("#tablaCreditosClinicas").html(data);
    })

  }
  
  
  
  CargaCreditosClinicas();