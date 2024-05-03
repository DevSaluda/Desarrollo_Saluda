function CargaVentasDelDia(){


    $.post("https://saludapos.com/ControlDental/Consultas/VentasDelDiaPorTicketsCredito.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();