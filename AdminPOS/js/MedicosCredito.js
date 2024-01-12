function MedicosCreditos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/MedicosCreditos.php","",function(data){
      $("#TableMedicosCreditos").html(data);
    })

  }
  
  
  
  MedicosCreditos();