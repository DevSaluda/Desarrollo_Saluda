function  TicketsRechazados(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/CancelacionesTicketsRechazados.php","",function(data){
      $("#TicketsRechazadosTable").html(data);
    })

  }
  
  
  
  TicketsRechazados();