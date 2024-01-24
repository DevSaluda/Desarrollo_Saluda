function CargaVentasDelDia(){


    $.post("https://saludapos.com/POS2/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();