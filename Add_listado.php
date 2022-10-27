<?php
  $page_title = 'Agregar listado';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_lists = find_all('calculos');
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
  
  
  $d = find_all('dolar');  
  //get dolar value
    foreach($d as $dat){
        $dolar = $dat['precio'];
        break;
    }
  
?>


<?php
if(isset($_POST['Add_listado'])){
     
   //$req_fields = array('title_cl','motivo','price','getclient' ); 
   //validate_fields($req_fields);
   
   if(empty($errors)){
         
         $c_pliego = ($_POST['cp']);
         $caja_id    = ($_POST['getcaja']) ;  
         $metro      = remove_junk($db->escape($_POST['me']));
         $flete      = remove_junk($db->escape($_POST['fl']));
         $troquelado = remove_junk($db->escape($_POST['tr']));
         $empaquetado= remove_junk($db->escape($_POST['em']));
         $puesta     = remove_junk($db->escape($_POST['pu']));
         $uncolor    = remove_junk($db->escape($_POST['oc']));
         $doscolores = remove_junk($db->escape($_POST['tc']));
         $pegamento  = remove_junk($db->escape($_POST['pega']));
         $pegado    = remove_junk($db->escape($_POST['p']));
         $date       = make_date();
         
         
         
         if($c_pliego === ""){
         $estado = 1;
         }else
             {
            $estado = 0;
             }
       
         if($pegamento === ""){
             $pegamento = 0;
         }    
         if($pegado === ""){
             $pegado = 0;
         }   
    
     $query  = "INSERT INTO calculos (";
     $query .=" `id_caja`, `id_metroscuadrados`, `id_fletes`, `id_troquelados`, `id_empaquetados`, "
             . "`id_puestas`, `id_onecolor`, `id_twocolor`,`id_pegamentos`,`id_pegados`, `costo_pliego`, `fecha`, `estado`";
     $query .=") VALUES (";
     $query .=" '{$caja_id}', '{$metro}', '{$flete}', "
             . "'{$troquelado}', '{$empaquetado}', '{$puesta}', '{$uncolor}',"
             . "'{$doscolores}','{$pegamento}','{$pegado}', '{$c_pliego}', '{$date}', '{$estado}'";
     $query .=")";
     
     if($db->query($query)){
          
       
        $session->msg('s',"El listado se agrego correctamente. ");
       
        redirect('Listado.php',false);
         
        }else {
            $session->msg('d',' Error al agregar el listado en la base de datos.');
            redirect('Listado.php',false);
          }

   
     } else {
       $session->msg('d',' Error general al agregar el listado.');
       redirect('Listado.php',false);
     }
    
   }

 

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Listado</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="Add_listado.php" class="clearfix" id="sug-form-list">
              <div class="form-group">
                <div class="input-group">
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                        <label for="cajas_cj">Caja</label>
                        <div class="input-group">
                            <input type="text" id="sug_input_list" data-id="" autocomplete="off" class="form-control" name="title_caja"  placeholder="Buscar caja" required="" style="width: 410px;">
                        </div>
                        <div id="result" class="list-group"></div>
                  </div>
                   <input type="hidden" id="setcaja" name="getcaja" display="none"></input>
                   <div></div>
                   <div></div>
                   <div></div>
                   <select class="form-control" name="me" style="width: 400px;" required="">
                      <option value="">Seleccionar metro</option>
                    <?php  foreach ($metros as $m): ?>
                      <option value="<?php echo $m['id'] ?>"><?php echo $m['nombre'] ?></option>
                    <?php endforeach; ?>
                    </select> 
                    <select class="form-control" name="fl" style="width: 400px;" required="">
                      <option value="">Seleccionar $ flete</option>
                    <?php  foreach ($fletes as $f): ?>
                      <option value="<?php echo $f['id'] ?>"><?php echo $f['precio'] ?></option>
                    <?php endforeach; ?>
                    </select> 
                    <select class="form-control" name="tr" style="width: 400px;" required="">
                      <option value="">Seleccionar $ troquelado</option>
                    <?php  foreach ($troquelados as $t): ?>
                      <option value="<?php echo $t['id'] ?>"><?php echo $t['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                    <select class="form-control" name="em" style="width: 400px;" required="">
                      <option value="">Seleccionar $ empaquetado</option>
                    <?php  foreach ($empaquetados as $em): ?>
                      <option value="<?php echo $em['id'] ?>"><?php echo $em['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                    <select class="form-control" name="pu" style="width: 400px;" required="">
                      <option value="">Seleccionar $ puesta</option>
                    <?php  foreach ($puestas as $pu): ?>
                      <option value="<?php echo $pu['id'] ?>"><?php echo $pu['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                    <select class="form-control" name="oc" style="width: 400px;" required="">
                      <option value="">Seleccionar $ 1 color</option>
                    <?php  foreach ($onecolor as $oc): ?>
                      <option value="<?php echo $oc['id'] ?>"><?php echo $oc['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                    <select class="form-control" name="tc" style="width: 400px;" required="">
                      <option value="">Seleccionar $ 2 colores</option>
                    <?php  foreach ($twocolor as $tc): ?>
                      <option value="<?php echo $tc['id'] ?>"><?php echo $tc['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                   <select class="form-control" name="pega" style="width: 400px;">
                      <option value="">Seleccionar pegamento</option>
                    <?php  foreach ($pegamentos as $var): ?>
                      <option value="<?php echo $var['id'] ?>"><?php echo get_precio_pegamento(remove_junk(ucwords($var['precio_kilo'])),$dolar,remove_junk(ucwords($var['cantidad'])),remove_junk(ucwords($var['porcentaje']))) ?></option>
                    <?php endforeach; ?>
                    </select>
                   <select class="form-control" name="p" style="width: 400px;">
                      <option value="">Seleccionar Pegado</option>
                    <?php  foreach ($pegados as $tc): ?>
                      <option value="<?php echo $tc['id'] ?>"><?php echo $tc['precio'] ?></option>
                    <?php endforeach; ?>
                    </select>
                   
                   <div></div>
                   <div></div>
                   <div></div>
                    <div class="col-md-6">
                      <label for="pliego">Pliego</label>
                      <input type="text" class="form-control" name="cp" autocomplete="off" placeholder="¿Costo de pliego? Omitir si es calculado">
                    </div>
                </div>
              </div>

              <button type="submit" name="Add_listado" class="btn btn-danger">Confirmar</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
