function  TicketsRechazados(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CancelacionesTicketsRechazados.php","",function(data){
      $("#TicketsRechazadosTable").html(data);
    })

  }
  
  
  
  TicketsRechazados();