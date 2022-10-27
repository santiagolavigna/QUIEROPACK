<?php
  $page_title = 'Lista de puestas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $data = find_all('puestas');
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
        <span>Puestas</span>
     </strong>
        <a href="Add_puestas.php" class="btn btn-info pull-right btn-sm"> Agregar Puesta</a>
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
                 <a href="Edit_puestas.php?id=<?php echo (int)$var['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
                </a>
                 <a onClick="if(confirm('¿Borrar puesta <?php echo $var['descripcion'];?>?')){delete_function(<?php echo (int)$var['id'];?>,'Delete_puestas.php?id=');}else{ }" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
