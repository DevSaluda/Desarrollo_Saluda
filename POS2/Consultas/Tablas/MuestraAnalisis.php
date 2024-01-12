
<? if ($resultset->num_rows > 0) { ?>
       
       <div class="table">
           <table id="Analisis" class="table">
          
               <thead>
                   
                   <tr>
                   
                       <th>#-ID</th>
                       <th>Nombre Analisis</th>
                    
                   
                         
                   </tr>
               </thead>
               <?php while ($tabla = $resultset->fetch_assoc()) { ?>
          
              <td>  <?echo $tabla['ID_Analisis'];?></td>
            
              <td>  <?echo $tabla['Nombre_analisis'];?></td>
             
           
              
              
             
                   </tr>
                   <? } ?>
           </table>
           <? } ?>
          