function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/CortesDeCajaReimpresiones.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();