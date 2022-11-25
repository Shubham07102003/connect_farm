<?php

// $servername = "localhost";
// $username = "goyalinf_sap_tes";
// $password = "@Anu2240013";
// $dbname = "goyalinf_sap_test";


//real
$servername = "localhost";
$username = "u182278162_1sec";
$password = "@Anu123456";
$dbname = "u182278162_1sec";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?> 