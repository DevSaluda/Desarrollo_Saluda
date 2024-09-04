function CargaTicketsDia(){


    $.post("https://controlfarmacia.com/POS2/Consultas/TicketsEnPanelVentas.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaTicketsDia();