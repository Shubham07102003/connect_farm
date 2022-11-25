<?php



include('conn.php');
 $json = file_get_contents('php://input');
 $obj = json_decode($json,true);



  if(!empty($token)){
    $id = $obj['token'];

  }else{
  $id = $_POST['token'];
  }


   $db = new mysqli($servername, $username, $password, $dbname);
      if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}else{
    //echo 'success';
}
      //Check For The Query and Give Result
      $port = '3306';
      
      		$db = new PDO('mysql:host=' . $servername.';dbname=' . $dbname.';port=' . $port . ';charset=utf8', $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		
   $data = $db->prepare( 'SELECT token FROM tokens WHERE token = (:id) LIMIT 1;' );
        $data->bindParam( ':id', $id, PDO::PARAM_INT );
        $data->execute();
        $row = $data->fetch();

        // Make sure only 1 result is returned
        if( $data->rowCount() == 1 ) {
           $data1 = ['success'=>1];
         }else{
         	$data1 = ['success'=>0];
         }


echo json_encode($data1);
?>

