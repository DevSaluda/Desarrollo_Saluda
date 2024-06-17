function CargaVentasDelDia(){


    $.post("https://saludapos.com/ControlDental/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();