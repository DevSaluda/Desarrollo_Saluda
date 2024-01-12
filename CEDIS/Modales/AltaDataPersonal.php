<!-- Central Modal Medium Info -->
<div class="modal fade" id="AltaData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg modal-notify modal-primary" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Alta de personal</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos. <br>
                            De igual forma algunos campos, pueden añadirse sin que contenga datos, estos pueden editarse más tarde en la opción "editar"
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <form enctype="multipart/form-data" id="Personal">
             <label for=""><h2>DATOS PERSONALES</h2></label>
         <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombres y apellidos<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Ingresa el nombre y apellidos" maxlength="60">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Curp<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="curp" id="curp" oninput="validarInput(this)" placeholder="Ingresa la curp" maxlength="18">
    <div id="resultado"></div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">RFC <span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="rfc" id="rfc" placeholder="Ingresa el rfc" maxlength="13">
      
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha de nacimiento<span class="text-danger">*</span></label>
      <input type="date" class="form-control" name="fechan" id="fechan" >
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sexo<span class="text-danger">*</span></label>
   <select name="sexo" class="form-control"id="sexo">
<option value="">Elige un sexo</option>
<option value="Masculino">Masculino</option>
<option value="Femenino">Femenino</option>

   </select>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Estado Civil<span class="text-danger">*</span></label>
     <select name="estadoc" class="form-control" id="estadoc">
         <option value="">Elige un estado</option>
         <option value="Soltero(a)">Soltero(a)</option>  
         <option value="Casado(a)">Casado(a)</option>
         <option value="Casado(a)">Divorciado(a)</option>
         <option value="Casado(a)">Separacion en proceso judicial</option>
         <option value="">Concubinato</option>
         <option value="Viudo(a)">Viudo(a)</option>
        
     </select>
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo electronico<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="correo" id="correo" placeholder="Ingresa el correo electronico" maxlength="30">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono celular<span class="text-danger">*</span></label>
    <input type="number" class="form-control" name="tel1" id="tel1" placeholder="Ingresa el numero de telefono" maxlength="10">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono Particular</label>
      <input type="number" class="form-control" name="tel2" id=tel2 placeholder="Ingresa el numero de telefono" maxlength="10">
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Numero de seguro social<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="nss" id="nss" placeholder="Ingresa el correo electronico" maxlength="11">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Alergias<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="alergias" id="alergias" placeholder="Ingresa el numero de telefono" maxlength="50">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Tipo de sangre<span class="text-danger">*</span></label>
    <select name="sangre" class="form-control"id="sangre">
        <option value="">Elige un tipo de sangre</option>
        <option value="A+">A+</option>
        <option value="B+">B+</option>
        <option value="O+">O+</option>
        <option value="A-">A-</option>
        <option value="B-">B-</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
    </select>
    </div>
  </div>
  <br>
  <!-- FIN DATOS PERSONALES -->
  <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Calle<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="calle" id="calle" placeholder="Ingresa la calle" maxlength="5" >
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">N° exterior</label>
    <input type="text" class="form-control" name="next" id="next" placeholder="Ingresa el cruzamiento"maxlength="5">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">N° interior</label>
      <input type="text" class="form-control" name="nint" id="nint" placeholder="Ingresa el cruzamiento"maxlength="5">
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
 <label for="exampleFormControlInput1">Cruzamientos<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="cruzamientos" id="cruzamientos" placeholder="Ingresa la calle"maxlength="15">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Colonia<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Ingresa el cruzamiento" maxlength="50">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">CP<span class="text-danger">*</span></label>
      <input type="number" class="form-control" name="cp" id="cp" placeholder="Ingresa el cruzamiento" maxlength="5">
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
 <label for="exampleFormControlInput1">Estado<span class="text-danger">*</span></label>
      <select name="estado" class="form-control"id="estado" onchange="Estado();">
      <option value="">Selecciona un estado:</option>
        <?
          $query = $conn -> query ("SELECT ID_Estado,Nombre_Estado FROM Estados");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Estado].'">'.$valores[Nombre_Estado].'</option>';
          }
        ?> 
      </select>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Municipio<span class="text-danger">*</span></label>
    <select name="municipio" class="form-control"id="municipio" onchange="Municipio();" disabled = "disabled">
<option value="">Selecciona un municipio</option>
    </select>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Localidad<span class="text-danger">*</span></label>
    <select name="localidad" class="form-control"id="localidad" onchange="Localidad();" disabled = "disabled">
<option value="">Selecciona una localidad</option>
    </select>
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
 <label for="exampleFormControlInput1">Empresa<span class="text-danger">*</span></label>
 <input type="text" class="form-control"  name="empresa" id="empresa" readonly value="<?echo $row['ID_H_O_D']?>">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Folio contrato<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="folioc" id="folioc" placeholder="Ingresa el cruzamiento" maxlength="10">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha<span class="text-danger">*</span></label>
      <input type="text" class="form-control" readonly >
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
 <label for="exampleFormControlInput1">Familiar<span class="text-danger">*</span></label>
 <input type="text" class="form-control"  name="familiar1" id="familiar1" placeholder="ingresa el nombre y apellido" maxlength="50">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Parentesco<span class="text-danger">*</span></label>
    <select name="p1" class="form-control" id="p1">
    <option value="">Selecciona parentesco</option>
        <option value="Cónyuge">Cónyuge</option>
        <option value="Padre/Madre">Padre/Madre</option>
        <option value="Hijo/Hija">Hijo/Hija</option>
        <option value="Hermano/hermana">Hermano/hermana</option>
        <option value="Tío/tía">Tío/tía</option>
        <option value="Otros familiares">Otros familiares</option>
        <option value="Conocido">Conocido</option>

    </select>
  
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono<span class="text-danger">*</span></label>
      <input type="number" class="form-control" name="telf1" id="telf1"   placeholder="Ingresa el numero de telefono" maxlength="10">
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="col">
 <label for="exampleFormControlInput1">Familiar</label>
 <input type="text" class="form-control"  name="familiar2" id="familiar2" placeholder="ingresa el nombre y apellido" maxlength="50">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Parentesco</label>
    <select name="p2" class="form-control" id="p2">
    <option value="">Selecciona parentesco</option>
        <option value="Cónyuge">Cónyuge</option>
        <option value="Padre/Madre">Padre/Madre</option>
        <option value="Hijo/Hija">Hijo/Hija</option>
        <option value="Hermano/hermana">Hermano/hermana</option>
        <option value="Tío/tía">Tío/tía</option>
        <option value="Otros familiares">Otros familiares</option>
        <option value="Conocido">Conocido</option>

    </select>
  
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono</label>
      <input type="number" class="form-control" name="telf2" id="telf2"  placeholder="Ingresa el numero de telefono" maxlength="10">
    </div>
  </div>
<!-- FIN DATOS PERSONALES -->

    <input type="text" class="form-control" name="sistema" id="sistema" hidden readonly value="Punto de venta">
    <input type="text" class="form-control" name="estador" id="estador" hidden readonly >
    <input type="text" class="form-control" name="municipior" id="municipior" hidden readonly >
    <input type="text" class="form-control" name="localidadr" id="localidadr" hidden readonly >
    <input type="text" class="form-control" name="usuario" id="usuario" hidden readonly value="<?echo $row['Nombre_Apellidos']?>">

  

       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <!-- Central Modal Medium Info-->
