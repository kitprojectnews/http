<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
</head>
<body>
<?php
session_start();
// if (!isset($_SESSION['user_num'])) 
// {
//     header('Location:./index.html');
// }


$user = $_POST["user"];
$pass = $_POST["pass"];

$hostName='localhost';
$dbuserName='msr';
$passWord='Qwer!234';
$dbName='test';

// Create connection
$conn = mysqli_connect($hostName, $dbuserName, $passWord, $dbName);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$hashpw = base64_encode(hash('sha256', $pass, true));

$sql = "SELECT u_num, u_id, u_active, u_update, r_sel, r_update FROM test.account WHERE u_id = '$user' and u_pw = '$hashpw'";
$result = $conn->query($sql);

// $result->fetch_assoc();
//  echo $row["u_id"];

if ($result->num_rows != 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        $_SESSION['u_num'] = $row["u_num"];
        $_SESSION['u_id']  = $row["u_id"];
        $_SESSION['u_active'] = $row["u_active"];
        $_SESSION['u_update'] = $row["u_update"];
        $_SESSION['r_sel']    = $row["r_sel"];
        $_SESSION['r_update'] = $row["r_update"];


        $conn->close();
        
        Header("Location:../default.php");
    }
} 
else {
    $conn->close();
    echo " <script>alert('USERNAME 또는 PASSWORD 틀림'); history.back(); </script>";
}


?>
</body>
</html>