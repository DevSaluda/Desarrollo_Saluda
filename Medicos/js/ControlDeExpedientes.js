function CargaExpedientes(){


    $.post("https://saludapos.com/Medicos/Consultas/DatosDeExpedientes.php","",function(data){
      $("#ListaDeClientes").html(data);
    })

  }
  
  
  
  CargaExpedientes();