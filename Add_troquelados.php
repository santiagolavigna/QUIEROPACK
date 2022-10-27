<?php
  $page_title = 'Agregar troquelados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $data = find_all('troquelados');
?>
<?php
  if(isset($_POST['Add_troquelados'])){

   $req_fields = array('descripcion','precio');
   //validate_fields($req_fields);

   if(empty($errors)){
             $descripcion   = remove_junk($db->escape($_POST['descripcion']));
             $precio   = remove_junk($db->escape($_POST['precio']));
     
      
        $query = "INSERT INTO troquelados (";
        $query .="descripcion,precio";
        $query .=") VALUES (";
        $query .=" '{$descripcion}', '{$precio}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Nuevo troquelado agregado exitosamente");
          redirect('Add_troquelados.php', false);
        } else {
          //failed
          $session->msg('d',' Error al agregar el troquelado.');
          redirect('Add_troquelados.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Add_troquelados.php',false);
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
          <span>Agregar Troquelado</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="Add_troquelados.php">
            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Nombre troquelado">
            </div>
            <div class="form-group">
                <label for="username">Precio</label>
                <input type="number" step=".001" autocomplete="off" class="form-control" name="precio" placeholder="precio troquelado" required>
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="Add_troquelados" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
