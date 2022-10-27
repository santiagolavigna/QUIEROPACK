<?php
  $page_title = 'Agregar pegamento';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $data = find_all('pegamentos');
?>
<?php
  if(isset($_POST['Add_pegamento'])){

   $req_fields = array('descripcion','precio_kilo');
   //validate_fields($req_fields);

   if(empty($errors)){
             $descripcion   = remove_junk($db->escape($_POST['descripcion']));
             $precio_kilo   = remove_junk($db->escape($_POST['precio_kilo']));
             $cantidad = remove_junk($db->escape($_POST['cantidad']));
             $porcentaje = remove_junk($db->escape($_POST['porcentaje']));
     
      
        $query = "INSERT INTO pegamentos (";
        $query .="descripcion,precio_dolar,precio_kilo,cantidad,porcentaje";
        $query .=") VALUES (";
        $query .=" '{$descripcion}','99','{$precio_kilo}','{$cantidad}','{$porcentaje}'";
        $query .=")";
        
        if($db->query($query)){
          //sucess
          $session->msg('s'," Nuevo pegamento agregado exitosamente");
          redirect('Add_pegamentos.php', false);
        } else {
          //failed
          $session->msg('d',' Error al agregar el pegamento.');
          redirect('Add_pegamentos.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Add_pegamentos.php',false);
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
          <span>Agregar pegamento</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="Add_pegamentos.php">
            <div class="form-group">
                <label for="name">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Nombre pegamento">
            </div>
            <div class="form-group">
                <label for="username">Precio kg (USD)</label>
                <input type="number" step=".001" autocomplete="off" class="form-control" name="precio_kilo" placeholder="precio de 1 kg en dolares" required>
            </div>
             <div class="form-group">
                <label for="">Cantidad kg</label>
                <input type="number" step=".001" autocomplete="off" class="form-control" name="cantidad" placeholder="cantidad de kg" required>
            </div>
                <div class="form-group">
                <label for="">Porcentaje</label>
                <input type="number" step=".001" autocomplete="off" class="form-control" name="porcentaje" placeholder="porcentaje" required>
            </div> 
            <div class="form-group clearfix">
              <button type="submit" name="Add_pegamento" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
