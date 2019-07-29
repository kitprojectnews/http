<?php
include "php/dbconn.php";
// session_start();
// if (!isset($_SESSION['user_num'])) 
// {
//     header('Location:./index.html');
// }


$user = "qwe";
$pass = "123";

// $hostName='localhost';
// $dbuserName='msr';
// $passWord='Qwer!234';
// $dbName='test';

// // Create connection
// $conn = mysqli_connect($hostName, $dbuserName, $passWord, $dbName);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
$hashpw = base64_encode(hash('sha256', $pass, true));
echo $hashpw."<br>";
$sql = "INSERT INTO test.account (u_id, u_pw, u_active, u_update, r_sel, r_update) VALUES ( '$user','$hashpw', 1, 1, 1, 1)";

if ($conn->query($sql) == TRUE) {
    echo "ok<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>