<?php
  $page_title = 'Editar listado';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $cajas = find_all('cajas');
  $metros = find_all('metroscuadrados');
  $fletes = find_all('fletes');
  $troquelados = find_all('troquelados');
  $empaquetados = find_all('empaquetados');
  $puestas = find_all('puestas');
  $onecolor = find_all('onecolor');
  $twocolor = find_all('twocolor');
  $pegamentos = find_all('pegamentos');
  $pegados = find_all('pegados');
  
  $datos_actuales = getPrecios_calculos((int)$_GET['id']);
  
  
  $d = find_all('dolar');
    //get dolar value
    foreach($d as $dat){
        $dolar = $dat['precio'];
        break;
    }
  
  
?>
<?php
  $list = find_by_id('calculos',(int)$_GET['id']);
  
  if(!$list){
    $session->msg("d","El registro no existe.");
    redirect('Listado.php');
  }
?>
<?php
  if(isset($_POST['update_listado'])){

      
   if(empty($errors)){
       //**************************
         $c_pliego = $datos_actuales['costo_pliego'];
         if($_POST['cp'] !== ""){
         $c_pliego = ($_POST['cp']);
         }
         
         $metro      = remove_junk($db->escape($_POST['me']));
         $flete      = remove_junk($db->escape($_POST['fl']));
         $troquelado = remove_junk($db->escape($_POST['tr']));
         $empaquetado= remove_junk($db->escape($_POST['em']));
         $puesta     = remove_junk($db->escape($_POST['pu']));
         $uncolor    = remove_junk($db->escape($_POST['oc']));
         $doscolores = remove_junk($db->escape($_POST['tc']));
         $pegamento  = remove_junk($db->escape($_POST['pega']));
         $pegado    = remove_junk($db->escape($_POST['p']));
         $iva       = remove_junk($db->escape($_POST['iva']));
         $date       = make_date();
       
        $query  = "UPDATE calculos SET ";
        $query .= "id_metroscuadrados='{$metro}',id_fletes='{$flete}',"
        . "id_troquelados='{$troquelado}',id_empaquetados='{$empaquetado}',"
        . "id_puestas='{$puesta}',id_onecolor='{$uncolor}',"
        . "id_twocolor='{$doscolores}',"
        . "id_pegamentos='{$pegamento}',"
        . "id_pegados='{$pegado}',costo_pliego='{$c_pliego}',fecha='{$date}',iva='{$iva}'";
        $query .= " WHERE ID='{$db->escape($list['id'])}'";
        $result = $db->query($query);
        if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Listado actualizado! ");
          
          
           $query  = "INSERT INTO cambios_listado (";
            $query .= "id_calculo,id_caja,id_metroscuadrados,id_fletes,id_troquelados,id_empaquetados,id_puestas,id_onecolor,id_twocolor,id_pegamentos,id_pegados,costo_pliego,fecha,estado)"
                    . " VALUES ('{$db->escape($list['id'])}','{$db->escape($list['id_caja'])}','{$metro}','{$flete}','{$troquelado}','{$empaquetado}','{$puesta}','{$uncolor}','{$doscolores}','{$pegamento}','{$pegado}','{$c_pliego}','{$date}','{$db->escape($list['estado'])}')";
             $result = $db->query($query);
             
          redirect('Edit_listado.php?id='.(int)$list['id'], false);
        } else {
          //failed
          $session->msg('d','No se ha actualizado el listado!');
          redirect('Edit_listado.php?id='.(int)$list['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('Edit_listado.php?id='.(int)$list['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Editar Listado</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="Edit_listado.php?id=<?php echo (int)$list['id'];?>" class="clearfix">
        <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                        <label for="cajas_cj">Caja</label>
                        <div class="input-group">
                            <span type="text" name="title_caja"><?php echo $datos_actuales['nombre'] ?></span>
                        </div>
  
                            <label for="cajas_cj">Metros</label>
                          <select class="form-control" name="me" style="width: 300px;" required="">
                               <option value="<?php echo $datos_actuales['id_metro'] ?>"><?php echo $datos_actuales['metro_nombre'] ?></option>
                             <?php  foreach ($metros as $m): ?>
                               <option value="<?php echo $m['id'] ?>"><?php echo $m['nombre'] ?></option>
                             <?php endforeach; ?>
                          </select> 
                   
                  
                        <label for="cajas_cj">Flete</label>
                    <select class="form-control" name="fl" style="width: 300px;" required="">
                      <option value="<?php echo $datos_actuales['id_flete'] ?>"><?php echo $datos_actuales['flete_price'] ?></option>
                    <?php  foreach ($fletes as $f): ?>
                      <option value="<?php echo $f['id'] ?>"><?php echo $f['precio'] ?></option>
                    <?php endforeach; ?>
                    </select> 
              
                   
                        <label for="cajas_cj">Troquelado</label>
                    <select class="form-control" name="tr" style="width: 300px;" required="">
                      <option value="<?php echo $datos_actuales['id_troquelado'] ?>"><?php echo $datos_actuales['troquelado_price'] ?></option>
                    <?php  foreach ($troquelados as $t): ?>
                      <option value="<?php echo $t['id'] ?>"><?php echo $t['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                    
                        <label for="cajas_cj">Empaquetado</label>
                    <select class="form-control" name="em" style="width: 300px;" required="">
                      <option value="<?php echo $datos_actuales['id_empaquetado'] ?>"><?php echo $datos_actuales['empaquetado_price'] ?></option>
                    <?php  foreach ($empaquetados as $em): ?>
                      <option value="<?php echo $em['id'] ?>"><?php echo $em['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                        
                        <label for="cajas_cj">Puesta</label>
                    <select class="form-control" name="pu" style="width: 300px;" required="">
                      <option value="<?php echo $datos_actuales['id_puesta'] ?>"><?php echo $datos_actuales['puesta_price'] ?></option>
                    <?php  foreach ($puestas as $pu): ?>
                      <option value="<?php echo $pu['id'] ?>"><?php echo $pu['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                        
                        <label for="cajas_cj">$ Un color</label>
                    <select class="form-control" name="oc" style="width: 300px;" required="">
                      <option value="<?php echo $datos_actuales['id_onecolor'] ?>"><?php echo $datos_actuales['onecolor_price'] ?></option>
                    <?php  foreach ($onecolor as $oc): ?>
                      <option value="<?php echo $oc['id'] ?>"><?php echo $oc['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                        
                        <label for="cajas_cj">$ Dos colores</label>
                    <select class="form-control" name="tc" style="width: 300px;" required="">
                      <option value="<?php echo $datos_actuales['id_twocolor'] ?>"><?php echo $datos_actuales['twocolor_price'] ?></option>
                    <?php  foreach ($twocolor as $tc): ?>
                      <option value="<?php echo $tc['id'] ?>"><?php echo $tc['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                        
                          
                        <label for="cajas_cj">$ Pegamento</label>
                    <select class="form-control" name="pega" style="width: 300px;" >
                        <option value="<?php echo $datos_actuales['id_pegamentos'] ?>"><?php echo get_precio_pegamento($datos_actuales['precio_kilo'],$dolar,$datos_actuales['pegamento_cantidad'],$datos_actuales['porcentaje']) ?></option>
                    <?php  foreach ($pegamentos as $tc): ?>
                      <option value="<?php echo $tc['id'] ?>"><?php echo get_precio_pegamento($tc['precio_kilo'],$dolar,$tc['cantidad'],$tc['porcentaje']) ?></option>
                    <?php endforeach; ?>
                    </select>
                        
                          
                        <label for="cajas_cj">$ Pegado</label>
                    <select class="form-control" name="p" style="width: 300px;" >
                      <option value="<?php echo $datos_actuales['id_pegados'] ?>"><?php echo $datos_actuales['pegados_price'] ?></option>
                    <?php  foreach ($pegados as $tc): ?>
                      <option value="<?php echo $tc['id'] ?>"><?php echo $tc['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                      <br>
                        <?php if($datos_actuales['estado'] === '1') : ?>
                        <label for="pliego">Pliego</label>
                        <input type="text" class="form-control" name="cp" autocomplete="off" placeholder="<?php echo $datos_actuales['costo_pliego'] ?>" disabled="">
                         <?php else : ?>
                        <label for="pliego">Pliego</label>
                        <input type="text" class="form-control" name="cp" autocomplete="off" placeholder="<?php echo $datos_actuales['costo_pliego'] ?>">
                        <?php endif; ?>
                        
                          <br>
                           <label for="iva_listado">IVA %</label>
                        <div class="input-group">
                            <input type="number" step=".01" name="iva" value="<?php echo $datos_actuales['iva'] ?>"></input>
                        </div>
                        
                           <div>
                               <br>
                           </div>
                        
                         <div class="form-group clearfix">
                           <button type="submit" name="update_listado" class="btn btn-info">Actualizar</button>
                         </div>
                        
                   </div> 
                </div>
              </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
