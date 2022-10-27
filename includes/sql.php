<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }else{
       return false;
   }
}


function find_all_changes_precio($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM `cambios_precio` ORDER by identificacion, nombre");
   }else{
       return false;
   }
}

function find_all_changes_calculos($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." ORDER BY id_caja, fecha ASC");
   }else{
       return false;
   }
}

/*insertar en la tabla historica cambios_precio*/

function guardarcambios($table,$precio_anterior,$precio_nuevo,$date,$identificacion){
    
    global $db;
          $query  = "INSERT INTO cambios_precio(";
          $query .="`nombre`,`identificacion`, `precio_anterior`, `precio_modificado`, "
             . "`fecha`";
          $query .=") VALUES (";
          $query .="'{$table}','{$identificacion}', '{$precio_anterior}', '{$precio_nuevo}',"
                 . "'{$date}')";
          if($db->query($query)){
              return true;
          }else{
              return false;
          }
    
    
}


/* update dolar */

/*insertar en la tabla historica cambios_precio*/

function update_dolar($dolar){
    
    global $db;
          $query  = "UPDATE `dolar` SET `precio`='{$dolar}' WHERE id = '99'";
          if($db->query($query)){
              return "true";
          }else{
              return "false";
          }
    
    
}


/*actualizar calculos*/

function updateCalculos($formato_pliego,$costo_pliego,$subtotal_lisa,$subtotal_uncolor,$subtotal_doscolores,$date,$idcalculo){
    
    
      global $db;
          $query  = "UPDATE calculos SET(";
          $query .="`formato_pliego`, `costo_pliego`, `sub_lisa`, "
             . "`sub_onecolor`, `sub_twocolor`, `fecha`";
          $query .=") VALUES (";
          $query .="'{$formato_pliego}', '{$costo_pliego}', '{$subtotal_lisa}',"
                 . "'{$subtotal_uncolor}', '{$subtotal_doscolores}', '{$date}'";
          $query .=") WHERE calculos.id = '{$idcalculo}'";
            
          if($db->query($query)){
              
          }else{
              
          }
    
          
         
    
}

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function getdata_calculos() {
   global $db;
   if(tableExists('calculos'))
   {
     return find_by_sql("SELECT calculos.id id,cajas.nombre nombre, calculos.formato_pliego pliego, "
             . "calculos.sub_lisa sublisa, calculos.sub_onecolor subonecolor, "
             . "calculos.sub_twocolor subtwocolor FROM `calculos` INNER JOIN `cajas` "
             . "on cajas.id = calculos.id_caja INNER JOIN `empaquetados` "
             . "on empaquetados.id = calculos.id_empaquetados INNER JOIN `fletes` "
             . "on fletes.id = calculos.id_fletes INNER JOIN `metroscuadrados` "
             . "on metroscuadrados.id = calculos.id_metroscuadrados INNER JOIN `onecolor` "
             . "on onecolor.id = calculos.id_onecolor INNER JOIN `puestas` "
             . "on puestas.id = calculos.id_puestas INNER JOIN `troquelados` "
             . "on troquelados.id = calculos.id_troquelados INNER JOIN `twocolor` "
             . "ON twocolor.id = calculos.id_twocolor");
   } else {
       return false;
   }
}

/* devuelve los precios del listado, buscando por id  */
function getPrecios_calculos($id){
    global $db;
   if(tableExists('calculos'))
   {
      //. "IF(pegamentos.id IS NULL,'0',pegamentos.id) AS id_pegamentos,IF(pegamentos.precio IS NULL,'0',pegamentos.precio) AS pegamentos_price, "
     //   . "IF(pegados.id IS NULL,'0',pegados.id) AS id_pegados,IF(pegados.precio IS NULL,'0',pegados.precio) AS pegados_price "
       
          $sql = $db->query(
               "SELECT cajas.nombre nombre, metroscuadrados.precio metro_price, "
             . "metroscuadrados.nombre metro_nombre, "
             . "fletes.precio flete_price, troquelados.precio troquelado_price, "
             . "empaquetados.precio empaquetado_price, puestas.precio puesta_price,"
             . "onecolor.precio onecolor_price, twocolor.precio twocolor_price,"
             . "calculos.costo_pliego costo_pliego, calculos.iva iva, calculos.estado estado, metroscuadrados.id id_metro,"
             . "fletes.id id_flete, troquelados.id id_troquelado, empaquetados.id id_empaquetado,"
             . "puestas.id id_puesta, onecolor.id id_onecolor, twocolor.id id_twocolor, pegados.id id_pegados, pegados.precio pegados_price,"
             . "pegamentos.id id_pegamentos,pegamentos.precio_kilo precio_kilo, pegamentos.cantidad pegamento_cantidad, pegamentos.porcentaje porcentaje "             
             . " FROM `calculos` INNER JOIN `cajas` "
             . "on cajas.id = calculos.id_caja INNER JOIN `empaquetados` "
             . "on empaquetados.id = calculos.id_empaquetados INNER JOIN `fletes` "
             . "on fletes.id = calculos.id_fletes INNER JOIN `metroscuadrados` "
             . "on metroscuadrados.id = calculos.id_metroscuadrados INNER JOIN `onecolor` "
             . "on onecolor.id = calculos.id_onecolor INNER JOIN `puestas` "
             . "on puestas.id = calculos.id_puestas INNER JOIN `troquelados` "
             . "on troquelados.id = calculos.id_troquelados INNER JOIN `twocolor` "
             . "ON twocolor.id = calculos.id_twocolor "
             . "LEFT JOIN `pegamentos` "
             . "ON pegamentos.id = calculos.id_pegamentos "
             . "LEFT JOIN `pegados` "
             . "ON pegados.id = calculos.id_pegados "
             . "WHERE calculos.id ='{$id}'");
             
            
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return false;
              
   } else {
       return false;
   }
    
}

/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/*  Function for Find data from pay by id_pay
/*--------------------------------------------------------------*/

function find_pay_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_pay='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  

      
            if(tableExists($table))
         {
          $sql = "DELETE FROM ".$db->escape($table);
          $sql .= " WHERE id=". $db->escape($id);
          $sql .= " LIMIT 1";
          
          $db->query($sql);
          

        
          return ($db->affected_rows() === 1) ? true : false;
         }
      

   
}


/*--------------------------------------------------------------*/
/* Function for Delete data from pay by id
/*--------------------------------------------------------------*/
function delete_pay_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id_pay=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}



/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    /*$sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }*/
        
    if(($username === 'gonzalo@quieropack' && $password==='0800') || ($username === 'edgardo@quieropack' && $password==='0800')){
        return $username;
    }
    
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     /*global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','Este nivel de usaurio esta inactivo!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;
        */
     }
   
   
   /* findind all cajas */
   
   function find_cajas_by_title($cajas_name){
     global $db;  
     $c_name = remove_junk($db->escape($cajas_name));
     $sql = "SELECT id, nombre, largo, ancho FROM cajas WHERE nombre like '%$c_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

   function find_pliegos_by_title($pliegos){
     global $db;  
     $p_name = remove_junk($db->escape($pliegos));
     $sql = "SELECT id, cantidad FROM pliegos WHERE cantidad like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }
 
?>
