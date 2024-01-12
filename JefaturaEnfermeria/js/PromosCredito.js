function PromosCreditos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/PromosCreditos.php","",function(data){
      $("#TablePromosCreditos").html(data);
    })

  }
  
  
  
  PromosCreditos();