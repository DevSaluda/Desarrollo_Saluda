function RegistroGastos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/RegistroGastos.php","",function(data){
      $("#TableGastosSuc").html(data);
    })

  }
  
  
  
  RegistroGastos();