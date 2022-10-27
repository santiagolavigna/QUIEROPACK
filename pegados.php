<?php
  $page_title = 'Lista de pegados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $data = find_all('pegados');
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
        <span>Pegados</span>
     </strong>
        <a href="add_pegados.php" class="btn btn-info pull-right btn-sm"> Agregar Pegado</a>
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Descripcion</th>
            <th class="text-center" style="width: 20%;">Precio</th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($data as $var): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($var['descripcion']))?></td>
           <td class="text-center">
              <span class="label label-success"><?php echo remove_junk(ucwords($var['precio'])) ?></span>
           </td>
           <td class="text-center">
             <div class="btn-group"> 
                 <a onClick="if(confirm('¿Borrar pegado <?php echo $var['descripcion'];?>?')){delete_function(<?php echo (int)$var['id'];?>,'Delete_pegados.php?id=');}else{ }" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
