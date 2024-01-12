function  TicketsRechazados(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/CancelacionesTicketsRechazados.php","",function(data){
      $("#TicketsRechazadosTable").html(data);
    })

  }
  
  
  
  TicketsRechazados();