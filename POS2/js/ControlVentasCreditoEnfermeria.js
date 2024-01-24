function CargaVentasDelDia(){


    $.post("https://saludapos.com/POS2/Consultas/VentasDelDiaCredito.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();