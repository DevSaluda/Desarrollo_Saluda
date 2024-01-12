function RegistroGastos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/RegistroGastos.php","",function(data){
      $("#TableGastosSuc").html(data);
    })

  }
  
  
  
  RegistroGastos();