function CargaVentasDelDia(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/CortesDeCajaReimpresiones.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();