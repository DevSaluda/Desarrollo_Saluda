
function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/OrdenesPedidos.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
 
  CargaVentasDelDia();