
function CargaVentasDelDia(){


  $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDia.php","",function(data){
    $("#RegistrosHuellas").html(data);
  })

}


CargaVentasDelDia();