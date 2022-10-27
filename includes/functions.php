<?php
 $errors = array();
 
 
 
 /* get precio pegamentos */
 
 
   
  function get_precio_pegamento ($precio_kilo, $precio_dolar, $cantidad, $porcentaje)
	{
                $porcentaje = number_format(($porcentaje / 100)+1,2);
                $precio = ($precio_kilo * 
                        $precio_dolar * 
                        $cantidad 
                        * $porcentaje) / 1000 ;
                
                
		return number_format($precio,4);
	}

 /*--------------------------------------------------------------*/
 /* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." No puede estar en blanco.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg =''){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key}\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= remove_junk(first_character($value));
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}
/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*--------------------------------------------------------------*/
function total_price($totals){
   $sum = 0;
   $sub = 0;
   foreach($totals as $total ){
     $sum += $total['total_saleing_price'];
     $sub += $total['total_buying_price'];
     $profit = $sum - $sub;
   }
   return array($sum,$profit);
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
     if($str)
      return date('d/m/Y g:i:s a', strtotime($str));
     else
      return null;
  }
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date(){
   return strftime("%Y-%m-%d %X", time());
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creting random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}

/*--------------------------------------------------------------*/
/* Function for write variable to a file in desktop output.txt
/*--------------------------------------------------------------*/
function writeToFile($data){
$my_file = 'C:\Users\usuario\Desktop\output.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
fwrite($handle, $data);
}


function porcentaje($cantidad,$porciento,$decimales){
return number_format($cantidad*$porciento/100 ,$decimales);
}



/*Antes de mostrar el listado, recalcular por si hay cambios en alguna tabla foranea
*/
function actualizarCalculos($idcalculo,$caja,$metro,$flete,$troquelado,$empaquetado,$puesta,$onecolor,$twocolor,$pegamento,$pegado,$estado,$costo,$fecha,$iva){
            
    
         $d = find_all('dolar');
  
        //get dolar value
          foreach($d as $dat){
              $dolar = $dat['precio'];
              break;
          }
    
    
         $flete_precio = 0;
         $troquelado_precio = 0;
         $empaquetado_precio = 0;
         $puesta_precio = 0;
         $oncecolor_precio = 0;
         $twocolor_precio = 0;
         $caja_pliego = 0 ;
         $costo_pliego = 0;
         $formato_pliego = "";  
         $costo_pliego = 0.01;
         $precio_pegamento = 0;

    
       $pliego = find_by_id('pliegos', $caja['pliego']);
                $caja_largo = $caja['largo'] ;
                $caja_ancho = $caja['ancho'];
                
                $metro_precio = $metro['precio'];
    
               
        if($estado === '1'){
            $costo_pliego = ( $caja_largo * $caja_ancho * $metro_precio );
        }else{
           $costo_pliego = $costo;       
        }
        
        
        $caja_pliego = $caja['pliego'];
        
        $precio_pegamento = get_precio_pegamento($pegamento['precio_kilo'],$dolar,$pegamento['cantidad'],$pegamento['porcentaje']) ;
       
   
        
         $subtotal_lisa = number_format(((($costo_pliego) + ($precio_pegamento) + ($pegado['precio']) + ($flete['precio']) + ($puesta['precio']) + ($troquelado['precio']) + ($empaquetado['precio']))/$caja_pliego),3);
         
 
        
         $subtotal_uncolor = number_format((($subtotal_lisa) + ($onecolor['precio'])),3);
         $subtotal_doscolores = number_format((($subtotal_lisa) + ($twocolor['precio'])),3);
         
         
         //agrego los 3 subtotales + iva
         
         $iva_lisa = porcentaje($subtotal_lisa, $iva, 3);
         $iva_uncolor = porcentaje($subtotal_uncolor, $iva, 3);
         $iva_doscolores = porcentaje($subtotal_doscolores, $iva, 3);
         
         $lisa_suma_iva = $subtotal_lisa + $iva_lisa ;
         $uncolor_suma_iva = $subtotal_uncolor + $iva_uncolor;
         $doscolores_suma_iva = $subtotal_doscolores + $iva_doscolores;                 
         
         
         $formato_pliego = "$caja_largo" . " X " . "$caja_ancho" . " X " . "$caja_pliego" ;
         
         $array = array($idcalculo,$caja['nombre'],$subtotal_lisa, $subtotal_uncolor, $subtotal_doscolores, $formato_pliego,$fecha,$lisa_suma_iva,$uncolor_suma_iva,$doscolores_suma_iva,$iva,$costo_pliego,$costo,$caja['ancho'],$caja['largo']);
         
    return $array;     
    
}

?>
