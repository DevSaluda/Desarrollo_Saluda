function  CargaCreditosVencidos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CreditosVencidos.php","",function(data){
      $("#tablaCreditosVencidos").html(data);
    })

  }
  
  
  
  CargaCreditosVencidos();