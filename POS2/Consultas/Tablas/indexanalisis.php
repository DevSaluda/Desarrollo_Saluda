
<? if ($resultset->num_rows > 0) { ?>
       
       <div class="table-responsive">
           <table id="Sucursales" class="table">
          
               <thead>
                   
                   <tr>
                   
                       <th>Fecha</th>
                       <th>Hora cita</th>
                     <th>Analisis</th>
                     <th>estudio</th>
                     <th>Nombre</th>
                     <th>Estado cita</th>
                   
                         
                   </tr>
               </thead>
               <?php while ($tabla = $resultset->fetch_assoc()) { ?>
          
              <td>  <?echo $tabla['Fecha'];?></td>
              <td>  <?echo date("g:i a",strtotime($tabla['Hora_cita']))?></td>
              <td>   <?echo $tabla['Nombre_analisis'];?> </td>
              <td>  <?echo $tabla['Nombre_estudio'];?></td>
              <td>  <?echo $tabla['Nombre_solicitante'];?></td>
              <td  > <button class="btn" style='background-color:<?echo $tabla['Estado_cita'];?>' ></button></td>
           
              
              
             
                   </tr>
                   <? } ?>
           </table>
           <? } ?>
          