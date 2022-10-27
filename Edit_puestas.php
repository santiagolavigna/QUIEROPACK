<?php
  $page_title = 'Editar puestas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $emp = find_by_id('puestas',(int)$_GET['id']);
  if(!$emp){
    $session->msg("d","El registro no existe.");
    redirect('Puestas.php');
  }
?>
<?php
  if(isset($_POST['update_puestas'])){

   //$req_fields = array('nombre','largo','ancho','pl');
   //validate_fields($req_fields);
   
      
   if(empty($errors)){
            $desc = remove_junk($db->escape($_POST['descripcion']));
            $prec = remove_junk($db->escape($_POST['precio']));
       
        $query  = "UPDATE puestas SET ";
        $query .= "descripcion='{$desc}',precio='{$prec}'";
        $query .= " WHERE ID='{$db->escape($emp['id'])}'";
        $result = $db->query($query);
        if($result && $db->affected_rows() === 1){
          //sucess
         
            $table = 'puestas' ;
            $precio_anterior = $emp['precio'];
             $id = $emp['id'];
            $precio_nuevo = $prec;
            $date = make_date();
            
            if(guardarcambios($table, $precio_anterior, $precio_nuevo, $date,$id)){
               $session->msg('s',"Puestas se ha actualizado! ");
            }else{
              $session->msg('d',"Error interno...");
            }
          
          
          
          redirect('Edit_puestas.php?id='.(int)$emp['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado la puesta!');
          redirect('Edit_puestas.php?id='.(int)$emp['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('Edit_puestas.php?id='.(int)$emp['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Editar Puestas</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="Edit_puestas.php?id=<?php echo (int)$emp['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Descripcion de puesta</label>
              <input type="text" class="form-control" name="descripcion" value="<?php echo remove_junk(ucwords($emp['descripcion'])); ?>">
        </div>
        <div class="form-group">
              <label for="name" class="control-label">Precio</label>
              <input type="name" class="form-control" name="precio" value="<?php echo remove_junk(ucwords($emp['precio'])); ?>">
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update_puestas" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
