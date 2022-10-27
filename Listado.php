<?php
  $page_title = 'Listado';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   
   $all_lists = find_all('calculos');
   
   $datos = array() ;
   
   foreach ($all_lists as $data) {    

   $caja = find_by_id('cajas', $data['id_caja']);
   $metro = find_by_id('metroscuadrados', $data['id_metroscuadrados']);
   $flete = find_by_id('fletes', $data['id_fletes']);
   $troquelado = find_by_id('troquelados',$data['id_troquelados']);
   $empaquetado = find_by_id('empaquetados',$data['id_empaquetados']);
   $puesta = find_by_id('puestas',$data['id_puestas']);
   $onecolor = find_by_id('onecolor',$data['id_onecolor']);
   $twocolor = find_by_id('twocolor',$data['id_twocolor']);
   $pegamento = find_by_id('pegamentos',$data['id_pegamentos']);
   $pegado = find_by_id('pegados',$data['id_pegados']);
   $fecha= $data['fecha'];
   $iva = $data['iva'];
   
   array_push($datos, actualizarCalculos($data['id'],$caja,$metro,$flete,$troquelado,$empaquetado,$puesta,$onecolor,$twocolor,$pegamento,$pegado,$data['estado'],$data['costo_pliego'],$fecha,$iva));

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
        <span class="glyphicon glyphicon-th"></span>
        <span>Listado general</span>
     </strong>
       <a href="Add_listado.php" class="btn btn-info pull-right btn-sm"> Agregar nuevo</a>
    </div>
     <div class="panel-body">
    
   
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 5%;">#</th>
            <th>Caja</th>
            <th class="text-center" style="width: 10%;">Formato pliego</th>
            <th class="text-center" style="width: 10%;">Costo pliego</th>
            <th class="text-center" style="width: 10%;">Subtotal lisa</th>
            <th class="text-center" style="width: 10%;">Subtotal 1 color</th>
            <th class="text-center" style="width: 10%;">Subtotal 2 colores</th>
              <th class="text-center" style="width: 1%;">%IVA</th>
            <th class="text-center" style="width: 10%;">Subtotal lisa + %IVA </th>
            <th class="text-center" style="width: 10%;">Subtotal 1 color + %IVA </th>
            <th class="text-center" style="width: 10%;">Subtotal 2 colores + %IVA </th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($datos as $var): 
            ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           
           <?php if ( ((int) remove_junk(ucwords($var[12]))) === 0): ?>
                <td class=""><?php echo $var[1]?></td>
           <?php elseif  ( ($var[14]) === '0.425'): ?>
              <td class="label-danger"><?php echo $var[1]?></td>
           <?php else: ?>
             <td class="label-success"><?php echo $var[1]?></td>
           <?php endif; ?>
         
           
           <td class="text-center">
           
              <span class="label label-success"><?php echo remove_junk(ucwords($var[5])) ?></span>
           </td>
            
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk(ucwords($var[11])) ?></span>
           </td>
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk(ucwords($var[2])) ?></span>
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk(ucwords($var[3])) ?></span>
           </td>
         
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk(ucwords($var[4])) ?></span>
           </td>
               <td class="text-center">   
            <span class=""><?php echo remove_junk(ucwords($var[10])) ?></span>
           </td>
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk(ucwords($var[7])) ?></span>
           </td>
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk(ucwords($var[8])) ?></span>
           </td>
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk(ucwords($var[9])) ?></span>
           </td>
           <td class="text-center">
             <div class="btn-group">                
                <a href="Edit_listado.php?id=<?php echo (int)$var[0];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                 <a onClick="if(confirm('¿Borrar listado <?php echo $var[1];?>?')){delete_function(<?php echo (int)$var[0];?>,'Delete_listado.php?id=');}else{ }" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
