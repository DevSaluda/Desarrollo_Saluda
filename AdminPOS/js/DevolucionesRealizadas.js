
function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/DevolucionesDelMes.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
 
  CargaVentasDelDia();