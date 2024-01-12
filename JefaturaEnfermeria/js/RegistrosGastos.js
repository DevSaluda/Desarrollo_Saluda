function RegistroGastos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/RegistroGastos.php","",function(data){
      $("#TableGastosSuc").html(data);
    })

  }
  
  
  
  RegistroGastos();