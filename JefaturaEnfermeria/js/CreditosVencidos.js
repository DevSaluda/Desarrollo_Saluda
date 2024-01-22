function  CargaCreditosVencidos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CreditosVencidos.php","",function(data){
      $("#tablaCreditosVencidos").html(data);
    })

  }
  
  
  
  CargaCreditosVencidos();