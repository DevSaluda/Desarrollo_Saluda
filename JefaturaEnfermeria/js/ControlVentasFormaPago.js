function CargaVentasDelDia(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/ArrayDesgloseVentasPorFormasDePago.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();