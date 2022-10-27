<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $delete_id = delete_by_id('puestas',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","puesta eliminada");
      redirect('Puestas.php');
  } else {
      $session->msg("d","Se ha producido un error en la eliminación de la puesta");
      redirect('Puestas.php');
  }
?>