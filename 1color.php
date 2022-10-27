<?php
  $page_title = 'Lista de un color';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $data = find_all('onecolor');
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>1 Color</span>
     </strong>
        <a href="Add_1color.php" class="btn btn-info pull-right btn-sm"> Agregar Color</a>
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 20px;">#</th>
            <th class="text-center" style="width: 50%;">Precio</th>
            <th class="text-center" style="width: 10px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($data as $var): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td class="text-center">
              <span class="label label-success"><?php echo remove_junk(ucwords($var['precio'])) ?></span>
           </td>
           <td class="text-center">
             <div class="btn-group">
                 <a href="Edit_1color.php?id=<?php echo (int)$var['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
                  </a>
                 <a onClick="if(confirm('¿Borrar color <?php echo $var['precio'];?>?')){delete_function(<?php echo (int)$var['id'];?>,'Delete_1color.php?id=');}else{ }" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>

