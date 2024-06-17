function  CargaCreditosVencidos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/CreditosVencidos.php","",function(data){
      $("#tablaCreditosVencidos").html(data);
    })

  }
  
  
  
  CargaCreditosVencidos();