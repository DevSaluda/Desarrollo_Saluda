function PromosCreditos(){


    $.post("https://saludapos.com/ControlDental/Consultas/PromosCreditos.php","",function(data){
      $("#TablePromosCreditos").html(data);
    })

  }
  
  
  
  PromosCreditos();