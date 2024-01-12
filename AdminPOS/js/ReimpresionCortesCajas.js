function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/CortesDeCajaReimpresiones.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();