<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $delete_id = delete_by_id('cajas',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","caja eliminada");
      redirect('cajas.php');
  } else {
      $session->msg("d","Se ha producido un error en la eliminación de la caja");
      redirect('cajas.php');
  }
?>
