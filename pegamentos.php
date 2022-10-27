<?php
  $page_title = 'Lista de empaquetados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $data = find_all('pegamentos');
  $d = find_all('dolar');
  
  //get dolar value
    foreach($d as $dat){
        $dolar = $dat['precio'];
        break;
    }

  
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
       <span class="glyphicon glyphicon-usd pull-left"></span>   
         <span class="pull-left">Precio Dolar Actual :   &nbsp;&nbsp;</span>
      <button name="update_dolar" class="btn btn-success pull-right">Actualizar precio dolar</button>
      &nbsp;&nbsp;
        <input class="pull-left" name="value_dolar" value="<?php echo $dolar ?>">
         </strong>
     
    </div>
        
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Pegamentos</span>
     </strong>
        <a href="Add_pegamentos.php" class="btn btn-info pull-right btn-sm"> Agregar Pegamento</a>
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Descripcion</th>
            <th class="text-center" style="width: 20%;">Precio por kg</th>
             <th class="text-center" style="width: 20%;">cantidad (kg)</th>
              <th class="text-center" style="width: 20%;">porcentaje %</th>
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
              <span class="label label-success"><?php echo "USD " . remove_junk(ucwords($var['precio_kilo'])) ?></span>
           </td>
            <td class="text-center">
              <span class="label label-success"><?php echo remove_junk(ucwords($var['cantidad'])) ?></span>
           </td>
            <td class="text-center">
              <span class="text-center"><?php echo remove_junk(ucwords($var['porcentaje'])) . "%" ?></span>
           </td>
           <td class="text-center">
              <span class="label label-success"><?php echo get_precio_pegamento(remove_junk(ucwords($var['precio_kilo'])),$dolar,remove_junk(ucwords($var['cantidad'])),remove_junk(ucwords($var['porcentaje']))) ?></span>
           </td>
           <td class="text-center">
             <div class="btn-group"> 
                <a onClick="if(confirm('¿Borrar pegamento <?php echo $var['descripcion'];?>?')){delete_function(<?php echo (int)$var['id'];?>,'Delete_pegamentos.php?id=');}else{ }" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
             
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
