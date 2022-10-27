<?php
  $page_title = 'Editar 1 color';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $fletes = find_by_id('onecolor',(int)$_GET['id']);
  if(!$fletes){
    $session->msg("d","El registro no existe.");
    redirect('1color.php');
  }
?>
<?php
  if(isset($_POST['update_1color'])){

   //$req_fields = array('nombre','largo','ancho','pl');
   //validate_fields($req_fields);
   
      
   if(empty($errors)){
            $prec = remove_junk($db->escape($_POST['precio']));
       
        $query  = "UPDATE onecolor SET ";
        $query .= "precio='{$prec}'";
        $query .= " WHERE ID='{$db->escape($fletes['id'])}'";
        $result = $db->query($query);
        if($result && $db->affected_rows() === 1){
          //sucess
         
             $table = '1 color' ;
            $precio_anterior = $fletes['precio'];
            $id = $fletes['id'];
            $precio_nuevo = $prec;
            $date = make_date();
            
            if(guardarcambios($table, $precio_anterior, $precio_nuevo, $date,$id)){
                $session->msg('s',"un color se ha actualizado! ");
            }else{
              $session->msg('d',"Error interno...");
            }
          
          
          
          redirect('Edit_1color.php?id='.(int)$fletes['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el color!');
          redirect('Edit_1color.php?id='.(int)$fletes['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('Edit_1color.php?id='.(int)$fletes['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Editar 1 color</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="Edit_1color.php?id=<?php echo (int)$fletes['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Precio de un color</label>
              <input type="name" class="form-control" name="precio" value="<?php echo remove_junk(ucwords($fletes['precio'])); ?>">
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update_1color" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
