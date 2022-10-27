<?php
  $page_title = 'Agregar Cajas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $data = find_all('cajas');  
  $pliegos = find_all('pliegos');
?>
<?php
  if(isset($_POST['Add_cajas'])){

   $req_fields = array('Nombre','largo','ancho','pliego');
   //validate_fields($req_fields);

   if(empty($errors)){
             $name   = remove_junk($db->escape($_POST['Nombre']));
             $largo   = remove_junk($db->escape($_POST['largo']));
             $ancho   = remove_junk($db->escape($_POST['ancho']));                
             $pliego     = remove_junk($db->escape($_POST['pl']));
     
      
        $query = "INSERT INTO cajas (";
        $query .="nombre,largo,ancho,pliego";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$largo}', '{$ancho}','{$pliego}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Nueva caja agregada exitosamente");
          redirect('Add_cajas.php', false);
        } else {
          //failed
          $session->msg('d',' Error al agregar la caja.');
          redirect('Add_cajas.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Add_cajas.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar caja</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="Add_cajas.php">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" autocomplete="off" class="form-control" name="Nombre" placeholder="Nombre caja" required>
            </div>
            <div class="form-group">
                <label for="username">Largo</label>
                <input type="number" step=".001" autocomplete="off" class="form-control" name="largo" placeholder="Largo caja" required>
            </div>
            <div class="form-group">
                <label for="password">Ancho</label>
                 <input type="number" step=".001" autocomplete="off" class="form-control" name="ancho" placeholder="Ancho caja" required>
            </div> 
            <div class="form-group">
                <label for="password">Pliego</label>
                <select class="form-control" name="pl" style="width: 400px;" required="">
                <option value="">Seleccionar un pliego</option>
                <?php  foreach ($pliegos as $p): ?>
                <option value="<?php echo $p['id'] ?>"><?php echo $p['cantidad'] ?></option>
                <?php endforeach; ?>
            </select> 
            </div>                          
            <div class="form-group clearfix">
              <button type="submit" name="Add_cajas" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
