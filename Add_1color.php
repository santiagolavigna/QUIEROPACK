<?php
  $page_title = 'Agregar un color';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $data = find_all('onecolor');
?>
<?php
  if(isset($_POST['Add_1color'])){

   $req_fields = array('precio');
   //validate_fields($req_fields);

   if(empty($errors)){
             $precio   = remove_junk($db->escape($_POST['precio']));
     
      
        $query = "INSERT INTO onecolor (";
        $query .="precio";
        $query .=") VALUES (";
        $query .=" '{$precio}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Nuevo color agregado exitosamente");
          redirect('Add_1color.php', false);
        } else {
          //failed
          $session->msg('d',' Error al agregar el color.');
          redirect('Add_1color.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Add_1color.php',false);
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
          <span>Agregar un color</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="Add_1color.php">
            <div class="form-group">
                <label for="name">Precio</label>
                <input type="number" step=".001" autocomplete="off" class="form-control" name="precio" placeholder="precio color" required>
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="Add_1color" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
