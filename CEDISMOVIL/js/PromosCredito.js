function PromosCreditos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/PromosCreditos.php","",function(data){
      $("#TablePromosCreditos").html(data);
    })

  }
  
  
  
  PromosCreditos();