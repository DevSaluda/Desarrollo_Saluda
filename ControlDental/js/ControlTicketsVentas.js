function CargaVentasDelDia(){


    $.post("https://saludapos.com/ControlDental/Consultas/VentasDelDiaPorTickets.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();