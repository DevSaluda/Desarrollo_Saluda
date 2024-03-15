function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/DatosDeClientes.php","",function(data){
      $("#ListaDeClientes").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();