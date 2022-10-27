<?php
  $page_title = 'cambios en listados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   
   $cambios = find_all_changes_precio('cambios_precio');
   
  /* $datos = array() ;
   
   foreach ($all_lists as $data) {    

   $caja = find_by_id('cajas', $data['id_caja']);
   $metro = find_by_id('metroscuadrados', $data['id_metroscuadrados']);
   $flete = find_by_id('fletes', $data['id_fletes']);
   $troquelado = find_by_id('troquelados',$data['id_troquelados']);
   $empaquetado = find_by_id('empaquetados',$data['id_empaquetados']);
   $puesta = find_by_id('puestas',$data['id_puestas']);
   $onecolor = find_by_id('onecolor',$data['id_onecolor']);
   $twocolor = find_by_id('twocolor',$data['id_twocolor']);
   $fecha = $data['fecha'];
   
   array_push($datos, actualizarCalculos($data['id'],$caja,$metro,$flete,$troquelado,$empaquetado,$puesta,$onecolor,$twocolor,$data['estado'],$data['costo_pliego'],$fecha));

   }
   */
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
        <span>Cambios en precios</span>
     </strong>
       
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 1%;">#</th>
             <th class="text-center" style="width: 20%;">Numero identificacion</th>
            <th class="text-center" style="width: 20%;">Elemento modificado</th>
            <th class="text-center" style="width: 15%;">Precio anterior</th>
            <th class="text-center" style="width: 15%;">Precio nuevo</th>
            <th class="text-center" style="width: 15%;">Fecha</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($cambios as $var): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td class="text-center">
              <span class="label label-danger"><?php echo remove_junk($var['identificacion']) ?></span>
           </td>
           <td class="text-center">   
            <span class=""><?php echo remove_junk($var['nombre']) ?></span>
           </td>
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk($var['precio_anterior']) ?></span>
           </td>
           <td class="text-center">   
            <span class="label label-success"><?php echo remove_junk($var['precio_modificado']) ?></span>
           </td>
            <td class="">   
                <span><?php 
                $originalDate = $var['fecha'];
                $newDate = date("d/m/Y", strtotime($originalDate));
                echo $newDate ?></span>
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
