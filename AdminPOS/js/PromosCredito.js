function PromosCreditos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/PromosCreditos.php","",function(data){
      $("#TablePromosCreditos").html(data);
    })

  }
  
  
  
  PromosCreditos();