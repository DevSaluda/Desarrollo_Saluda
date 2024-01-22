function CargaVentasDelDia(){


    $.post("https://saludapos.com/POS2/Consultas/VentasDelDiaDesgloseEnfermeria.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();