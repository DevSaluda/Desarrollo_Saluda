function CargaVentasDelDia(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/VentasDelDiaFormaPago.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();