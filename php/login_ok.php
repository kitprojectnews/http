<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
</head>
<body>
<?php
include "dbconn.php";

//How to use - 세션 확인 + 활성 유저 여부 + 각각 필요한 권한
session_start();
// if (!isset($_SESSION['user_num']))//세션 확인
// {
//     header('Location:../index.html');
// }
// if(!$_SESSION['u_active'])//활성 유저 여부 
// {
//     echo " <script>alert('비활성화된 사용자입니다. '); history.back(); </script>";
// }
// if(!$_SESSION['u_update'])//유저 관리권한 여부
// {
//     echo " <script>alert('접근권한이 없습니다. '); history.back(); </script>";
// }
// if(!$_SESSION['r_sel'])//룰 확인 여부
// {
//     echo " <script>alert('접근권한이 없습니다. '); history.back(); </script>";
// }
// if(!$_SESSION['r_update'])//룰 추가 수정 삭제 가능 여부
// {
//     echo " <script>alert('접근권한이 없습니다. '); history.back(); </script>";
// }

$user = $_POST["user"];
$pass = $_POST["pass"];

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