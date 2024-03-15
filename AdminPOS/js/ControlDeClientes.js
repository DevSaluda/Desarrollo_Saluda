function CargaVentasDelDia(){


    $.post("https://saludapos.com/saludapos.com/Consultas/DatosDeClientes.php","",function(data){
      $("#ListaDeClientes").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();