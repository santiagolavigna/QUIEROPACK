<?php
  $page_title = 'Editar cajas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   $pliegos = find_all('pliegos');
?>
<?php
  $caja = find_by_id('cajas',(int)$_GET['id']);
  if(!$caja){
    $session->msg("d","El registro no existe.");
    redirect('Cajas.php');
  }
?>
<?php
  if(isset($_POST['update_cajas'])){

   $req_fields = array('nombre','largo','ancho');
   //validate_fields($req_fields);
   
      
   if(empty($errors)){
            $name = remove_junk($db->escape($_POST['nombre']));
            $largo = remove_junk($db->escape($_POST['largo']));
            $ancho = remove_junk($db->escape($_POST['ancho']));
            $pliego     = remove_junk($db->escape($_POST['pl']));
       
        $query  = "UPDATE cajas SET ";
        $query .= "nombre='{$name}',largo='{$largo}',ancho='{$ancho}',pliego='{$pliego}'";
        $query .= "WHERE ID='{$db->escape($caja['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"la caja se ha actualizado! ");
          redirect('Edit_cajas.php?id='.(int)$caja['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado la caja!');
          redirect('Edit_cajas.php?id='.(int)$caja['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('Edit_cajas.php?id='.(int)$caja['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Editar Cajas</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="Edit_cajas.php?id=<?php echo (int)$caja['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre de la caja</label>
              <input type="name" class="form-control" name="nombre" value="<?php echo remove_junk(ucwords($caja['nombre'])); ?>">
        </div>
        <div class="form-group">
              <label for="name" class="control-label">Largo de la caja</label>
              <input type="name" class="form-control" name="largo" value="<?php echo remove_junk(ucwords($caja['largo'])); ?>">
        </div>
        <div class="form-group">
                <label for="name">Ancho de la caja</label>
                <input type="name" class="form-control" name="ancho" value="<?php echo remove_junk(ucwords($caja['ancho'])); ?>">
        </div>
        <div class="form-group">
                <label for="password">Pliego</label>
                <select class="form-control" name="pl" style="width: 310px;">
                <option value="<?php echo $caja['pliego'] ?>"><?php echo $caja['pliego'] ?></option>
                <?php  foreach ($pliegos as $p): ?>
                <option value="<?php echo $p['id'] ?>"><?php echo $p['cantidad'] ?></option>
                <?php endforeach; ?>
            </select> 
            </div> 
        <div class="form-group clearfix">
                <button type="submit" name="update_cajas" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
