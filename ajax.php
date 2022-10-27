<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
  ?>


<?php
 // setting value dolar
   $html = '';    
   if(isset($_POST['dolar_value']) && strlen($_POST['dolar_value']))
   {
     
       $dolar = $_POST['dolar_value'];
       
       if(update_dolar($dolar)){
           $html = "true";
       }else{
           $html = "false";
       }
       
       echo $html;
   }
?>

<?php
 // Auto suggetion cajas
    $html = '';
            
   if(isset($_POST['caja_name']) && strlen($_POST['caja_name']))
   {
     $cajas = find_cajas_by_title($_POST['caja_name']);    
 
     if($cajas){
        foreach ($cajas as $cl):
           $html .= "<li class=\"list-group-item\">";
           $html .= $cl['id']." ".$cl['nombre'];
           $html .= "</li>";
         endforeach;
      } else {
        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'No encontrado';
        $html .= "</li>";

      }
      echo json_encode($html);
 
   }
   
   if(isset($_POST['pliego_name']) && strlen($_POST['pliego_name']))
   {
     $pl = find_pliegos_by_title($_POST['pliego_name']);    
    
     if($pl){
        foreach ($pl as $cl):
           $html .= "<li class=\"list-group-item\">";
           $html .= $cl['id']." ".$cl['cantidad'];
           $html .= "</li>";
         endforeach;
      } else {
        $html .= '<li onClick=\"fill(\''.addslashes().'\')\" class=\"list-group-item\">';
        $html .= 'No encontrado';
        $html .= "</li>";

      }
      echo json_encode($html);
 
   }
   
   
 ?>
 <?php
 // find all clients
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_clients_info_by_title($product_title)){
        foreach ($results as $result) {

          $html .= "<tr>";

          $html .= "<td id=\"s_name\">".$result['name']."</td>";
          $html .= "<input type=\"hidden\" name=\"s_id\" value=\"{$result['id']}\">";
          $html  .= "<td>";
          

        }
    } else {
        $html ='<tr><td>El cliente no se encuentra registrado en la base de datos</td></tr>';
    }

    echo json_encode($html);
  }
 ?>
