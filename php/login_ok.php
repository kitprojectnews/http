<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
</head>
<body>
<?php
// session_start();
// if (!isset($_SESSION['user_num'])) 
// {
//     header('Location:./index.php');
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
$sql = "SELECT u_num, u_id, u_pw FROM test.account WHERE u_id = '$user' and u_pw = sha2('$pass', 256)";
$result = $conn->query($sql);

// $result->fetch_assoc();
//  echo $row["u_id"];

if ($result->num_rows != 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        $_SESSION['user_id'] = $user;
        $_SESSION['user_num'] = $row["u_num"];
        $conn->close();
        Header("Location:../defult.php");
    }
} 
else {
    $conn->close();
    echo " <script>alert('USERNAME 또는 PASSWORD 틀림'); history.back(); </script>";
}


?>

</body>
</html>