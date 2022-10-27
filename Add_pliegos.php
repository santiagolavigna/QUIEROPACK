<?php
  $page_title = 'Agregar pliego';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $data = find_all('pliegos');
?>
<?php
  if(isset($_POST['Add_pliegos'])){

   $req_fields = array('pliego');
   //validate_fields($req_fields);

   if(empty($errors)){
             $cantidad   = remove_junk($db->escape($_POST['pliego']));
     
      
        $query = "INSERT INTO pliegos (";
        $query .="id,cantidad";
        $query .=") VALUES (";
        $query .=" '{$cantidad}','{$cantidad}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Nuevo pliego agregado exitosamente");
          redirect('Add_pliegos.php', false);
        } else {
          //failed
          $session->msg('d',' Error al agregar el pliego.');
          redirect('Add_pliegos.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Add_pliegos.php',false);
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
          <span>Agregar Pliego</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="Add_pliegos.php">
            <div class="form-group">
                <label for="name">Cantidad</label>
                <input type="number"  step=".001" autocomplete="off" class="form-control" name="pliego" placeholder="cantidad pliego" required>
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="Add_pliegos" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
