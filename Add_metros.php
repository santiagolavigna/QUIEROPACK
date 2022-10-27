<?php
  $page_title = 'Agregar metros';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $data = find_all('metros');
?>
<?php
  if(isset($_POST['Add_metros'])){

   $req_fields = array('nombre','precio');
   //validate_fields($req_fields);

   if(empty($errors)){
            
             $nombre = remove_junk($db->escape($_POST['nombre']));   
             $precio   = remove_junk($db->escape($_POST['precio']));
     
      
        $query = "INSERT INTO metroscuadrados (";
        $query .="nombre, precio";
        $query .=") VALUES (";
        $query .=" '{$nombre}','{$precio}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Nuevo metro agregado exitosamente");
          redirect('Add_metros.php', false);
        } else {
          //failed
          $session->msg('d',' Error al agregar el metro.');
          redirect('Add_metros.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Add_metros.php',false);
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
          <span>Agregar Metro Cuadrado</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="Add_metros.php">
                <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre metro" required>
                </div>
                <div class="form-group">
                    <label for="name">Precio</label>
                    <input type="number" step=".001" autocomplete="off" class="form-control" name="precio" placeholder="precio metro" required>
                </div>
                
                
                <div class="form-group clearfix">
                  <button type="submit" name="Add_metros" class="btn btn-primary">Guardar</button>
                </div>
           </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
