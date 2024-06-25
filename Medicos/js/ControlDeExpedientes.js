function CargaExpedientes(){


    $.post("https://saludapos.com/Medicos/Consultas/DatosDeExpedientes.php","",function(data){
      $("#ListaDeExpedientes").html(data);
    })

  }
  
  
  
  CargaExpedientes();