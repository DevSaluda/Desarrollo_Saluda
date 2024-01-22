function CargaCreditosFinalizados(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CreditosFinalizados.php","",function(data){
      $("#tablaCreditosFinalizados").html(data);
    })

  }
  
  
  
  CargaCreditosFinalizados();