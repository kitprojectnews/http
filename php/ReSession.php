<?php
include "dbconn.php";

//How to use - 세션 확인 + 활성 유저 여부 + 각각 필요한 권한
session_start();
$uid = $_SESSION['u_id'];

$sql = "SELECT u_num, u_id, u_active, u_update, r_update FROM account WHERE u_id = '$uid'";
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
    }
    //$conn->close();
    if(!$_SESSION['u_active'])//활성 유저 여부 
        {
            echo " <script>alert('사용하시던 사용자가 비활성화 되었습니다.'); parent.location.href='../index.html'; </script>";            
        }
} 
else {
    $conn->close();
    echo " <script>alert('사용자를 확인해주세요'); parent.location.href='../index.html'; </script>";
}
?>
