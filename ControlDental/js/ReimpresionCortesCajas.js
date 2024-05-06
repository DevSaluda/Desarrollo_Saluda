function CargaVentasDelDia(){


  $.post("https://saludapos.com/ControlDental/Consultas/CortesDeCajaReimpresiones.php","",function(data){
    $("#TableVentasDelDia").html(data);
  })

}



CargaVentasDelDia();