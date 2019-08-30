<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
</head>
<body>
<?php
include "dbconn.php";

//How to use - 세션 확인 + 활성 유저 여부 + 각각 필요한 권한
session_start();
$user = $_POST["user"];
$pass = $_POST["pass"];

$hashpw = base64_encode(hash('sha256', $pass, true));

$sql = "SELECT u_num, u_id, u_active, u_update, r_update FROM test.account WHERE u_id = '$user' and u_pw = '$hashpw'";
$result = $conn->query($sql);

if ($result->num_rows != 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        $_SESSION['u_num'] = $row["u_num"];
        $_SESSION['u_id']  = $row["u_id"];
        $_SESSION['u_active'] = $row["u_active"];
        $_SESSION['u_update'] = $row["u_update"];
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
