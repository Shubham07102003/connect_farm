<?php
include("config.php");
include("conn.php");

include('funcCheckToken.php');



if(isset($_GET["action"])){
    $action = $_GET["action"];
    
    if($action == "login"){
        // $user = $_POST["user"];
        // $pass = $_POST["pass"];
         $json = file_get_contents('php://input');
 $obj = json_decode($json,true);
//  print_r($obj);
 
 $user = $obj["user"];
 $pass = $obj["pass"];


            $sql = "SELECT id FROM `_users` WHERE username = '$user' and password = '$pass'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        $genertatecsrf = bin2hex(openssl_random_pseudo_bytes(32));
mysqli_query($db,"INSERT INTO `tokens` (`token`) VALUES ('$genertatecsrf');");

        $ok = $genertatecsrf;

    } else {
        $error = "Your Login Name or Password is invalid";
    }
        
    }
    
    
    else if($action == "get_feed"){
        // $user = $_POST["user"];
        // $pass = $_POST["pass"];
         $json = file_get_contents('php://input');
             $obj = json_decode($json,true);
//  print_r($obj);
  $token  = $obj["token"];
//   print_r($obj);

     if(checkToken($token)){
         
            $sql = "SELECT * FROM `thingsspeak`";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $ok = $row;
    
    
     }else{
         $error = "Wrong Token Please Relogin";
     }
         
     }

        
    
    
    
    
    
    
    else{
        $error = "Action Not Defined";
    }
}else{
    $error = "No Action set";
}


if(isset($error)){
    echo json_encode(["status" => $error,"code" => 500] );
}else if(isset($ok)){
        echo json_encode(["status" => $ok,"code" => 200] );

}