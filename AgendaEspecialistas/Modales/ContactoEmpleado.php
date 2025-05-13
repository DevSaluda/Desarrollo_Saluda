<?
include "../Consultas/db_connection.php";
include "../Consultas/Sesion.php";
include "../Consultas/Consultas.php";
$user_id=null;
$sql1= "SELECT * FROM `PersonalPOS` WHERE Pos_ID= ".$_POST["id"];
$query = $conn->query($sql1);
$Especialidades = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialidades=$r;
  break;
}

  }
  
?>

<? if($Especialidades!=null):?>

    <div class="container">
    <label for="exampleFormControlInput1"><h2>Datos de contacto </h2></label>
  <div class="row">
    <div class="col"> 
      <label for="exampleFormControlInput1">Empleado</label> <br>
      <i class="fas fa-id-card-alt"></i> <br>
        <? echo $Especialidades->Nombre_Apellidos; ?>  </div>
    <div class="col"> <label for="exampleFormControlInput1">Telefono</label> <br>
    <i class="fas fa-phone"></i> <br>
      <a href="tel:+<? echo $Especialidades->Telefono; ?>"> <? echo $Especialidades->Telefono; ?> </a>
    </div>
    <div class="w-100"></div> <br>
    <div class="col"> <label for="exampleFormControlInput1">Whatsapp</label> <br>
    <i class="fab fa-whatsapp"></i> <br>
      <a href="https://api.whatsapp.com/send/?phone=%2B52<? echo $Especialidades->Telefono; ?>"> <? echo $Especialidades->Telefono; ?> </a>  </div>
    <div class="col"> <label for="exampleFormControlInput1">Correo</label> <br>
    <i class="fas fa-envelope-square"></i> <br>
      <a href="mailto:<? echo $Especialidades->Correo_Electronico; ?>"> <? echo $Especialidades->Correo_Electronico; ?></a>  </div>
    
  </div> <br>

 
       
       
   
   
<? else:?>
<p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>