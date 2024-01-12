function  CargaCreditosVencidos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/CreditosVencidos.php","",function(data){
      $("#tablaCreditosVencidos").html(data);
    })

  }
  
  
  
  CargaCreditosVencidos();