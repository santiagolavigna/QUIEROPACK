<?php
  $page_title = 'Agregar puestas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $data = find_all('puestas');
?>
<?php
  if(isset($_POST['Add_puestas'])){

   $req_fields = array('descripcion','precio');
   //validate_fields($req_fields);

   if(empty($errors)){
             $descripcion   = remove_junk($db->escape($_POST['descripcion']));
             $precio   = remove_junk($db->escape($_POST['precio']));
     
      
        $query = "INSERT INTO puestas (";
        $query .="descripcion,precio";
        $query .=") VALUES (";
        $query .=" '{$descripcion}', '{$precio}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Nueva puesta agregado exitosamente");
          redirect('Add_puestas.php', false);
        } else {
          //failed
          $session->msg('d',' Error al agregar la puesta.');
          redirect('Add_puestas.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Add_puestas.php',false);
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
          <span>Agregar Puesta</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="Add_puestas.php">
            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Nombre puesta">
            </div>
            <div class="form-group">
                <label for="username">Precio</label>
                <input type="number" step=".001" autocomplete="off" class="form-control" name="precio" placeholder="precio puesta" required>
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="Add_puestas" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
